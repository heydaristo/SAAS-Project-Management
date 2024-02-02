<?php

namespace App\Charts;
use App\Models\TransactionAdmin;
use Carbon\Carbon;


use ArielMejiaDev\LarapexCharts\LarapexChart;


class RevenueChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $revenue = TransactionAdmin::get();

        // get revenue from three month before and group by month

        $revenue = $revenue->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m');
        });

        $data = [];
        $label = [];

        foreach($revenue as $key => $value){
            $data[] = $value->sum('total');
            $label[] = Carbon::parse($key)->format('F Y');
        }
        // dd($data, $label);

        

        return $this->chart->lineChart()
            ->setHeight(300)
            ->addData('Revenue',$data)
            ->setLabels($label);
    }
}
