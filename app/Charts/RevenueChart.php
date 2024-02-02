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

    public function ThreeMonths(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // get data from 3 months ago
        $revenue = TransactionAdmin::where('status', 'PAID')
            ->where('date', '>=', Carbon::now()->subMonth(3))
            ->orderBy('date', 'asc')
            ->get();
        
            
            // group by month
            $revenue = $revenue->groupBy(function($date) {
                return Carbon::parse($date->date)->format('Y-m');
            });    
            
            // get total revenue
            $revenue = $revenue->map(function($item, $key){
                return $item->sum('amount');
            });
            

        $data = [];
        $label = [];
        foreach($revenue as $key => $value){
            $data[] = $value;
            $label[] = $key;
        }

        

        return $this->chart->lineChart()
            ->setHeight(200)
            ->addData('Revenue',$data)
            ->setLabels($label);
    }

    public function ThirtyDays(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // get data from 30 days ago
        $revenue = TransactionAdmin::where('status', 'PAID')
            ->where('date', '>=', Carbon::now()->subDays(30))
            ->orderBy('date', 'asc')
            ->get();
        
            
            // group by month
            $revenue = $revenue->groupBy(function($date) {
                return Carbon::parse($date->date)->format('Y-m-d');
            });    
            
            // get total revenue
            $revenue = $revenue->map(function($item, $key){
                return $item->sum('amount');
            });
            

        $data = [];
        $label = [];
        foreach($revenue as $key => $value){
            $data[] = $value;
            $label[] = $key;
        }

        

        return $this->chart->lineChart()
            ->setHeight(200)
            ->addData('Revenue',$data)
            ->setLabels($label);
    }

    public function SevenDays(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // get data from 30 days ago
        $revenue = TransactionAdmin::where('status', 'PAID')
            ->where('date', '>=', Carbon::now()->subDays(7))
            ->orderBy('date', 'asc')
            ->get();
        
            
            // group by month
            $revenue = $revenue->groupBy(function($date) {
                return Carbon::parse($date->date)->format('Y-m-d');
            });    
            
            // get total revenue
            $revenue = $revenue->map(function($item, $key){
                return $item->sum('amount');
            });
            

        $data = [];
        $label = [];
        foreach($revenue as $key => $value){
            $data[] = $value;
            $label[] = $key;
        }

        

        return $this->chart->lineChart()
            ->setHeight(200)
            ->addData('Revenue',$data)
            ->setLabels($label);
    }
}
