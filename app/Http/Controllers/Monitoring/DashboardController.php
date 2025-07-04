<?php

namespace App\Http\Controllers\Monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;


class DashboardController extends BaseController
{
    public function index()
    {
        return view('dashboard_monitoring.index');
    }

    public function show()
    {
        return view('dashboard_monitoring.detail');
    }
}
