<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\User;
use Carbon\Carbon;

class ActiveUserChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function ThreeMonths(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // get data from 3 months ago
       $activeuser = User::where('last_activity', '>=', now()->subMonth(3))->get();
         $activeuser = $activeuser->groupBy(function($date) {
          return Carbon::parse($date->last_activity)->format('Y-m');
        });
        $activeuser = $activeuser->map(function($item, $key){
          return $item->count('id');
        });
        $data = [];
        $label = [];
        foreach($activeuser as $key => $value){
            $data[] = $value;
            $label[] = $key;
        }
        return $this->chart->lineChart()
            ->setHeight(200)
            ->addData('Active User',$data)
            ->setLabels($label);

    }

    public function ThirtyDays(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // get data from 30 days ago
        $activeuser = User::where('last_activity', '>=', now()->subDays(30))->get();
        $activeuser = $activeuser->groupBy(function($date) {
          return Carbon::parse($date->last_activity)->format('Y-m-d');
        });
        $activeuser = $activeuser->map(function($item, $key){
          return $item->count('id');
        });
        $data = [];
        $label = [];
        foreach($activeuser as $key => $value){
            $data[] = $value;
            $label[] = $key;
        }
        return $this->chart->lineChart()
            ->setHeight(200)
            ->addData('Active User',$data)
            ->setLabels($label);
    }

    public function SevenDays(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // get data from 7 days ago
        $activeuser = User::where('last_activity', '>=', now()->subDays(7))->get();
        $activeuser = $activeuser->groupBy(function($date) {
          return Carbon::parse($date->last_activity)->format('Y-m-d');
        });
        $activeuser = $activeuser->map(function($item, $key){
          return $item->count('id');
        });
        $data = [];
        $label = [];
        foreach($activeuser as $key => $value){
            $data[] = $value;
            $label[] = $key;
        }
        return $this->chart->lineChart()
            ->setHeight(200)
            ->addData('Active User',$data)
            ->setLabels($label);
    }

    public function FifteenMinutes(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // get data from 15 minutes ago
        $activeuser = User::where('last_activity', '>=', now()->subMinutes(15))->get();
        $activeuser = $activeuser->groupBy(function($date) {
          return Carbon::parse($date->last_activity)->format('Y-m-d H:i');
        });
        $activeuser = $activeuser->map(function($item, $key){
          return $item->count('id');
        });
        $data = [];
        $label = [];
        foreach($activeuser as $key => $value){
            $data[] = $value;
            $label[] = $key;
        }
        return $this->chart->lineChart()
            ->setHeight(200)
            ->addData('Active User',$data)
            ->setLabels($label);
    }
}
