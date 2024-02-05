<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\User;
use Carbon\Carbon;



class FreelanceChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function ThreeMonths(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // get data from 3 months ago
        $revenue = User::where('id_role', 3)
            ->where('created_at', '>=', Carbon::now()->subMonth(3))
            ->orderBy('created_at', 'asc')
            ->get();
        
            
            // group by month
            $revenue = $revenue->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m');
            });    
            
            // get total revenue
            $revenue = $revenue->map(function($item, $key){
                return $item->count('id');
            });
            

        $data = [];
        $label = [];
        foreach($revenue as $key => $value){
            $data[] = $value;
            $label[] = $key;
        }

        

        return $this->chart->lineChart()
            ->setHeight(200)
            ->addData('Freelance',$data)
            ->setLabels($label);
    }

    public function ThirtyDays(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // get data from 30 days ago
        $revenue = User::where('id_role', 3)
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->orderBy('created_at', 'asc')
            ->get();
        
            
            // group by month
            $revenue = $revenue->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            });    
            
            // get total revenue
            $revenue = $revenue->map(function($item, $key){
                return $item->count('id');
            });
            

        $data = [];
        $label = [];
        foreach($revenue as $key => $value){
            $data[] = $value;
            $label[] = $key;
        }

        

        return $this->chart->lineChart()
            ->setHeight(200)
            ->addData('Freelance',$data)
            ->setLabels($label);
    }

    public function SevenDays(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // get data from 7 days ago
        $revenue = User::where('id_role', 3)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'asc')
            ->get();
        
            
            // group by month
            $revenue = $revenue->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            });    
            
            // get total revenue
            $revenue = $revenue->map(function($item, $key){
                return $item->count('id');
            });
            

        $data = [];
        $label = [];
        foreach($revenue as $key => $value){
            $data[] = $value;
            $label[] = $key;
        }

        

        return $this->chart->lineChart()
            ->setHeight(200)
            ->addData('Freelance',$data)
            ->setLabels($label);
    }
}
