<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Plan;
use RealRashid\SweetAlert\Facades\Alert;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all(); 
        return view('admin.plan.index', compact('plans'));
    }

    public function store(Request $request)
    {
         // store data
         $validator = Validator::make($request->all(), [
            'plan_name' => ['required'],
            'plan_benefit' => ['required'],
            'plan_price' => ['required'],
        ]);

        if ($validator->fails()) {
            $error = "You have failed add new plan.\n".strval($validator->errors());
            Alert::error('Failed Message', $error);
            return redirect()->route('admin.plan.show');
        }

        $data['benefits'] = $request->plan_benefit;
        $data['plan_name'] = $request->plan_name;
        $data['price'] = $request->plan_price;

        if(!$data){
            dd('error');
        }else{
            $result = Plan::create($data);
            if($result){
                Alert::success('Success Message', 'You have successfully add new plan.');
                return redirect()->route('admin.plan.show');
            }else{
                Alert::error('Failed Message', 'You have failed add new plan.');
                return redirect()->route('admin.plan.show');
            }
        }
    }

    public function destroy($id)
    {
        $plan = Plan::find($id);

        if(!$plan){
            Alert::error('Failed Message', 'You have failed delete plan.');
            return redirect()->route('admin.plan.show');
        }

        $plan->delete();
        Alert::success('Success Message', 'You have successfully delete plan.');
        return redirect()->route('admin.plan.show');
    }

    public function update(Request $request, $id)
    {
        $plan = Plan::find($id);

        if(!$plan){
            Alert::error('Failed Message', 'You have failed update plan.');
            return redirect()->route('admin.plan.show');
        }

        $validator = Validator::make($request->all(), [
            'plan_name' => ['required'],
            'plan_benefit' => ['required'],
            'plan_price' => ['required'],
        ]);

        if ($validator->fails()) {
            $error = "You have failed update plan.\n".strval($validator->errors());
            Alert::error('Failed Message', $error);
            return redirect()->route('admin.plan.show');
        }

        $data['benefits'] = $request->plan_benefit;
        $data['plan_name'] = $request->plan_name;
        $data['price'] = $request->plan_price;

        if(!$data){
            dd('error');
        }else{
            $result = $plan->update($data);
            if($result){
                Alert::success('Success Message', 'You have successfully update plan.');
                return redirect()->route('admin.plan.show');
            }else{
                Alert::error('Failed Message', 'You have failed update plan.');
                return redirect()->route('admin.plan.show');
            }
        }
    }



    
}
