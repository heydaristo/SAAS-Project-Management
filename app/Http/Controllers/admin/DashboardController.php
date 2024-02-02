<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Charts\RevenueChart;
use App\Models\TransactionAdmin;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(RevenueChart $revenueChart)
    {
        // revenue summary
        $revenueSummaryThreeMonths = TransactionAdmin::where('status', 'PAID')
            ->where('date', '>=', Carbon::now()->subMonth(3))
            ->sum('amount');

        $revenueSummaryThirtyDays = TransactionAdmin::where('status', 'PAID')
            ->where('date', '>=', Carbon::now()->subDays(30))
            ->sum('amount');

        $revenueSummarySevenDays = TransactionAdmin::where('status', 'PAID')
            ->where('date', '>=', Carbon::now()->subDays(7))
            ->sum('amount');

        return view('admin.dashboard', [
            'revenueSummaryThreeMonths' => $revenueSummaryThreeMonths,
            'revenueSummaryThirtyDays' => $revenueSummaryThirtyDays,
            'revenueSummarySevenDays' => $revenueSummarySevenDays,
            'revenueChartThreeMonths' => $revenueChart->ThreeMonths(),
            'revenueChartThirtyDays' => $revenueChart->ThirtyDays(),
            'revenueChartSevenDays' => $revenueChart->SevenDays(),]);
    }
}
