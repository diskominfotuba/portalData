<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class SekolahController extends Controller
{
    protected $sekolah;
    public function __construct(Sekolah $sekolah)
    {
        $this->sekolah = new BaseService($sekolah);
    }

    public function index()
    {
        $data = $this->sekolah->Query()->all();
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

        foreach ($sheets as $sheetIndex => $sheet) {
            if (empty($sheet)) continue;

            $header = array_shift($sheet);

            foreach ($sheet as $rowIndex => $row) {
                if (count($header) !== count($row)) {
                    return $this->error("Header and row column count mismatch on sheet index {$sheetIndex}, row {$rowIndex}.", $row);
                }

                $rowData = array_combine($header, $row);

                try {
                    $this->sekolah->Query()->updateOrCreate(
                        ['npsn' => $rowData['npsn']],
                        [
                            'nama_sekolah'     => $rowData['Nama Satuan Pendidikan'],
                            'bentuk_pendidikan' => $rowData['Bentuk Pendidikan'],
                            'status_sekolah'   => $rowData['Status Sekolah'],
                            'alamat'           => $rowData['Alamat'],
                            'desa'             => $rowData['Desa'],
                            'kecamatan'        => $rowData['Kecamatan'],
                        ]
                    );
                } catch (\Throwable $th) {
                    return $this->error("Failed to import data on sheet index {$sheetIndex}, row {$rowIndex}.", $th->getMessage());
                }
            }
        }

        return $this->success(null, 'Data imported successfully from all sheets.');
    }
}
