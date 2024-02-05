<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Charts\RevenueChart;
use App\Charts\FreelanceChart;
use App\Charts\ActiveUserChart;
use App\Charts\ConversionRateChart;
use App\Models\TransactionAdmin;
use App\Models\Subscription;
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

        // formula for user conversion rate
        $userRegister3Months = User::where('created_at', '>=', now()->subMonth(3))->count();
        $userUpgradePremium3Months = Subscription::where('status', 'ACTIVE')
            ->where('id_plan', '<>', 1)
            ->where('created_at', '>=', Carbon::now()->subMonth(3))
            ->count();
        $conversionRate3Months = ($userUpgradePremium3Months / $userRegister3Months) * 100;

        
        $userRegister30Days = User::where('created_at', '>=', now()->subMonth(1))->count();
        $userPremium30Days = Subscription::where('status', 'ACTIVE')
            ->where('id_plan', '<>', 1)
            ->where('created_at', '>=', Carbon::now()->subMonth(1))
            ->count();
        $conversionRate30Days = ($userPremium30Days / $userRegister30Days) * 100;
        
        $userRegister7Days = User::where('created_at', '>=', now()->subDays(7))->count();
        $userPremium7Days = Subscription::where('status', 'ACTIVE')
            ->where('id_plan', '<>', 1)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->count();
        $conversionRate7Days = ($userPremium7Days / $userRegister7Days) * 100;

        // dd($conversionRate7Days, $conversionRate30Days, $conversionRate3Months);

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
            'conversionRate3Months' => $conversionRate3Months,
            'conversionRate30Days' => $conversionRate30Days,
            'conversionRate7Days' => $conversionRate7Days,
        ]);
    }
}
