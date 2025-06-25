<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BantuanController extends Controller
{
    public function index()
    {
       return view('bantuan.index');
    }

    public function tentang()
    {
       return view('bantuan.tentang-open-data');
    }
}
