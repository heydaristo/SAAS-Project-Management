<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Charts\RevenueChart;
use App\Charts\FreelanceChart;
use App\Charts\ActiveUserChart;
use App\Models\TransactionAdmin;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(RevenueChart $revenueChart, FreelanceChart $freelanceChart, ActiveUserChart $activeUserChart)
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

        // freelance summary
        $freelanceSummaryThreeMonths = User::where('id_role', 3)
            ->where('created_at', '>=', Carbon::now()->subMonth(3))
            ->count();

        $freelanceSummaryThirtyDays = User::where('id_role', 3)
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->count();

        $freelanceSummarySevenDays = User::where('id_role', 3)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->count();

        $useractive3months = User::where('last_activity', '>=', now()->subMonth(3))->count();
        $useractive30days = User::where('last_activity', '>=', now()->subMonth(1))->count();
        $useractive7days = User::where('last_activity', '>=', now()->subDays(7))->count();
        $useractive15minutes = User::where('last_activity', '>=', now()->subMinutes(15))->count();

        return view('admin.dashboard', [
            'revenueSummaryThreeMonths' => $revenueSummaryThreeMonths,
            'revenueSummaryThirtyDays' => $revenueSummaryThirtyDays,
            'revenueSummarySevenDays' => $revenueSummarySevenDays,
            'revenueChartThreeMonths' => $revenueChart->ThreeMonths(),
            'revenueChartThirtyDays' => $revenueChart->ThirtyDays(),
            'revenueChartSevenDays' => $revenueChart->SevenDays(),
            'freelanceSummaryThreeMonths' => $freelanceSummaryThreeMonths,
            'freelanceSummaryThirtyDays' => $freelanceSummaryThirtyDays,
            'freelanceSummarySevenDays' => $freelanceSummarySevenDays,
            'freelanceChartThreeMonths' => $freelanceChart->ThreeMonths(),
            'freelanceChartThirtyDays' => $freelanceChart->ThirtyDays(),
            'freelanceChartSevenDays' => $freelanceChart->SevenDays(),
            'useractive3months' => $useractive3months,
            'useractive30days' => $useractive30days,
            'useractive7days' => $useractive7days,
            'useractive15minutes' => $useractive15minutes,
            'activeUserChartThreeMonths' => $activeUserChart->ThreeMonths(),
            'activeUserChartThirtyDays' => $activeUserChart->ThirtyDays(),
            'activeUserChartSevenDays' => $activeUserChart->SevenDays(),
            'activeUserChartFifteenMinutes' => $activeUserChart->FifteenMinutes(),
        ]);
    }
}
