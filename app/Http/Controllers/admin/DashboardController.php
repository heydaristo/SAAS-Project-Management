<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Charts\RevenueChart;

class DashboardController extends Controller
{
    public function index(RevenueChart $revenueChart)
    {
        return view('admin.dashboard', ['revenueChart' => $revenueChart->build()]);
    }
}
