<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\Datasets;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class DatasetController extends Controller
{
    protected $datasets;
    public function __construct(Dataset $datasets)
    {
        $this->datasets = new BaseService($datasets);
    }

    public function index()
    {
        $data = $this->datasets->Query()->paginate();
        return $this->success($data, 'Data Datasets retrieved successfully.');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_data' => 'required|string|max:255',
            'nama_opd' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'model_class' => 'nullable|string|max:255|unique:datasets,model_class',
            'status' => 'in:aktif,tidak aktif'
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', $validator->errors());
        }

        $slug = Str::slug($request->nama_data);
        $request->merge(['slug' => $slug]);

        $data = $this->datasets->Query()->create($request->all());
        return $this->success($data, 'Data Datasets created successfully.');
    }
}
