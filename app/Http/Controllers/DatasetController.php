<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\DatasetRiwayat;
use App\Models\Datasets;
use App\Models\DatasetsHistories;
use App\Services\BaseService;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    protected $datasets;
    protected $datasetsHistories;
    public function __construct(Dataset $datasets, DatasetRiwayat $datasetsHistories)
    {
        $this->datasets = new BaseService($datasets);
        $this->datasetsHistories = new BaseService($datasetsHistories);
    }

    // public function index()
    // {
    //     if (\request()->ajax()) {
    //         $dataset = $this->datasets->Query();
    //         $data['table'] = $dataset->paginate();
    //         return view('datasets._data_table_datasets', $data);
    //     }
    //     return view('datasets.index');
    // }

    public function index()
    {
        if (request()->ajax()) {
            $dataset = $this->datasets
                ->Query()
                ->with(['latestVerifiedVersion']) // optional: eager load
                ->whereHas('histories', function ($query) {
                    $query->where('status', 'publish');
                })
                ->paginate();

            return view('dataset._data_table_dataset', ['table' => $dataset]);
        }

        return view('dataset.index');
    }

    public function show($slug)
    {
        $dataset = $this->datasets->Query()->where('slug', $slug)->firstOrFail();

        // Cek apakah dataset punya model class
        if (!$dataset->model_class || !class_exists($dataset->model_class)) {
            abort(404, 'Model class tidak ditemukan');
        }

        // Ambil nama model
        $modelClass = $dataset->model_class;

        // Ambil data dari versi terbaru yang disetujui
        $latestVersion = $this->datasetsHistories->Query()->where('dataset_id', $dataset->id)
            ->where('status', 'publish')
            ->latest('verified_at')
            ->first();

        if (!$latestVersion) {
            return redirect()->route('datasets.index')->with('error', 'Tidak ada versi yang disetujui untuk dataset ini.');
        }

        // Ambil data dari tabel data terkait
        // Ambil data dari tabel data terkait
        $records = $modelClass::where('dataset_riwayat_id', $latestVersion->id)
            ->get();

        return view('dataset.show', compact('dataset', 'latestVersion', 'records'));
    }
}
