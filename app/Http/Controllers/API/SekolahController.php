<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    protected $sekolah;
    public function __construct(Sekolah $sekolah)
    {
        $this->sekolah = $sekolah;
    }

    public function index() {
        $data = $this->sekolah->all();
        return $this->success($data, 'Data Sekolah retrieved successfully.');
    }
}
