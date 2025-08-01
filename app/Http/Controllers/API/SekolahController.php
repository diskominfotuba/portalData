<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Sekolah;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class SekolahController extends Controller
{
    protected $sekolah;
    protected $desa;
    protected $kecamatan;
    public function __construct(Sekolah $sekolah, Desa $desa, Kecamatan $kecamatan)
    {
        $this->sekolah = new BaseService($sekolah);
        $this->desa = new BaseService($desa);
        $this->kecamatan = new BaseService($kecamatan);
    }

    public function index()
    {
        $data = $this->sekolah->Query()->paginate();
        return $this->success($data, 'Data Sekolah retrieved successfully.');
    }

    public function importJson(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'json_file' => 'required|file|mimes:json,txt',
        ]);

        if ($validator->fails()) {
            return $this->error('File JSON is required and must be a valid file.', $validator->errors());
        }

        $file = $request->file('json_file');

        try {
            $jsonContent = file_get_contents($file->getRealPath());
            $sekolahs = json_decode($jsonContent, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->error('Format JSON tidak valid.', ['errors' => ['json_file' => 'Format JSON tidak valid.']]);
            }
        } catch (\Exception $e) {
            return $this->error('Tidak dapat membaca file.', ['errors' => ['json_file' => 'Tidak dapat membaca file.']]);
        }

        DB::beginTransaction();
        try {
            foreach ($sekolahs as $sekolahData) {
                if (!isset($sekolahData['npsn'])) {
                    continue;
                }

                Sekolah::updateOrCreate(
                    [
                        'npsn' => $sekolahData['npsn']
                    ],
                    [
                        'latitude' => $sekolahData['latitude'] ?? null,
                        'longitude' => $sekolahData['longitude'] ?? null,
                    ]
                );
            }

            DB::commit();

            return $this->success(null, 'Data sekolah berhasil diimpor!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('Terjadi kesalahan saat proses impor ke database.', ['errors' => ['json_file' => 'Terjadi kesalahan saat proses impor ke database.']]);
        }
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx'
        ]);

        if ($validator->fails()) {
            return $this->error('File is required and must be an xlsx file.', $validator->errors());
        }

        $sheets = Excel::toArray([], $file);

        $allDesas = $this->desa->Query()->get();
        $allKecamatans = $this->kecamatan->Query()->get();

        foreach ($sheets as $sheet) {
            if (empty($sheet)) continue;

            $header = array_shift($sheet);

            foreach ($sheet as $row) {
                if (count($header) !== count($row)) {
                    return $this->error("Header-row mismatch", $row);
                }

                $rowData = array_combine($header, $row);

                $inputDesa = $rowData['Desa'] ?? '';
                $inputKecamatan = $rowData['Kecamatan'] ?? '';

                $desa = $this->findClosestMatch($inputDesa, $allDesas, 'nama_desa');
                $kecamatan = $this->findClosestMatch($inputKecamatan, $allKecamatans, 'nama_kecamatan');

                if (!$desa || !$kecamatan) {
                    return $this->error('Tidak bisa mencocokkan desa/kecamatan', [
                        'desa_input' => $inputDesa,
                        'kecamatan_input' => $inputKecamatan,
                    ]);
                }

                try {
                    $this->sekolah->Query()->updateOrCreate(
                        ['npsn' => $rowData['NPSN']],
                        [
                            'nama_sekolah'      => $rowData['Nama Satuan Pendidikan'],
                            'bentuk_pendidikan' => $rowData['Bentuk Pendidikan'],
                            'status_sekolah'    => $rowData['Status Sekolah'],
                            'alamat'            => $rowData['Alamat'],
                            'desa_id'           => $desa->id,
                            'kecamatan_id'      => $kecamatan->id,
                        ]
                    );
                } catch (\Throwable $th) {
                    return $this->error('Gagal import data.', $th->getMessage());
                }
            }
        }

        return $this->success(null, 'Import berhasil dari semua sheet.');
    }

    // fungsi untuk normalisasi nama desa dan kecamatan
    private function normalize($string)
    {
        return Str::of($string)
            ->lower()                // kecil semua huruf
            ->replace(['-', '_'], ' ')
            ->replaceMatches('/\s+/', ' ') // hapus spasi ganda
            ->slug('')               // hilangkan semua spasi
            ->toString();            // convert ke string biasa
    }

    private function findClosestMatch($input, $collection, $field)
    {
        $inputNorm = $this->normalize($input);
        $bestMatch = null;
        $highestSimilarity = 0;

        foreach ($collection as $item) {
            $candidate = $this->normalize($item->$field);
            similar_text($inputNorm, $candidate, $percent);

            if ($percent > $highestSimilarity && $percent >= 80) { // ambil kemiripan ≥ 80%
                $highestSimilarity = $percent;
                $bestMatch = $item;
            }
        }

        return $bestMatch;
    }
}
