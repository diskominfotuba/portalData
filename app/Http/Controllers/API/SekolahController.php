<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\DatasetRiwayat;
use App\Models\Datasets;
use App\Models\DatasetsHistories;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Sekolah;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class SekolahController extends Controller
{
    protected $sekolah;
    protected $desa;
    protected $kecamatan;
    protected $datasets;
    protected $datasetsHistories;
    public function __construct(Sekolah $sekolah, Desa $desa, Kecamatan $kecamatan, Dataset $datasets, DatasetRiwayat $datasetsHistories)
    {
        $this->sekolah = new BaseService($sekolah);
        $this->desa = new BaseService($desa);
        $this->kecamatan = new BaseService($kecamatan);
        $this->datasets = new BaseService($datasets);
        $this->datasetsHistories = new BaseService($datasetsHistories);
    }

    public function index()
    {
        $data = $this->sekolah->Query()->paginate();
        return $this->success($data, 'Data Sekolah retrieved successfully.');
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

        $dataset = $this->datasets->Query()->where('model_class', Sekolah::class)->first();

        $userId = '0023efe1-4733-46d9-83e2-0af09531809c';
        $userNamaOpd = 'Dinas Pendidikan';

        $allDesas = $this->desa->Query()->get();
        $allKecamatans = $this->kecamatan->Query()->get();

        // Buat versi baru
        $latestHistory = $this->datasetsHistories->Query()
            ->where('dataset_id', $dataset->id)
            ->where('nama_opd', $userNamaOpd)
            ->latest()
            ->first();

        if (!$latestHistory) {
            $latestVersion = 0;
        } else {
            $latestVersion = $latestHistory->versi;
        }

        if ($latestHistory) {
            if ($latestHistory->status == 'diajukan' || $latestHistory->status == 'direview' || $latestHistory->status == 'ditolak') {
                return $this->error('Anda sudah mengajukan versi terbaru. Silakan tunggu verifikasi sebelum mengajukan lagi.');
            }
        }

        $newVersion = $this->datasetsHistories->Query()->create([
            'dataset_id'     => $dataset->id,
            'nama_opd'         => $userNamaOpd,
            'uploader_id'    => $userId,
            'versi'       =>  $latestVersion + 1,
            'status'         => 'diajukan',
        ]);

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
                    $this->sekolah->Query()->create(
                        [
                            'npsn' => $rowData['NPSN'],
                            'dataset_riwayat_id' => $newVersion->id,
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

        return $this->success(null, 'Import berhasil dan data dikirim untuk diverifikasi.');
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
