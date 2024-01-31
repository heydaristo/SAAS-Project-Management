<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscription;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\plan;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = DB::table('subscriptions')
        ->join('users', 'subscriptions.id_user', '=', 'users.id')
        ->join('plans', 'subscriptions.id_plan', '=', 'plans.id')
        ->select('subscriptions.*', 'users.fullname as fullname', 'plans.plan_name as plan_name')
        ->get();
        $freelances = User::where('id_role', 3)->get();
        $plans = Plan::all();
        return view('admin.subscription.index', compact('subscriptions', 'freelances', 'plans'));
    }

    public function store(Request $request)
    {
        $startDate = null;
        $endDate = null;
        $validator = null;
        
        if(is_null($request->duration)){
            $validator = Validator::make($request->all(), [
                'id_user' => ['required'],
                'id_plan' => ['required'],
                'start_date' => ['required'],
                'end_date' => ['required'],
            ]);
    
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            // difference between startDate and endDate in months
            $diff = abs(strtotime($endDate) - strtotime($startDate));
            $years = floor($diff / (365*60*60*24));
            $months = floor($diff / (30*60*60*24));
            $data['duration'] = $months;
        }else{
            $validator = Validator::make($request->all(), [
                'id_user' => ['required'],
                'id_plan' => ['required'],
                'duration' => ['required'],
            ]);

            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d', strtotime($startDate. ' + '.$request->duration.' months')); 
            $data['duration'] = $request->duration;
        }

        if ($validator->fails()) {
            $error = "You have failed add new subscription.\n".strval($validator->errors());
            Alert::error('Failed Message', $error);
            return redirect()->route('admin.subscription.show');
        }

        $data['id_user'] = $request->id_user;
        $data['id_plan'] = $request->id_plan;
        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;

        if(!$data){
            dd('error');
        }else{
            $result = Subscription::create($data);
            if($result){
                Alert::success('Success Message', 'You have successfully add new subscription.');
                return redirect()->route('admin.subscription.show');
            }else{
                Alert::error('Failed Message', 'You have failed add new subscription.');
                return redirect()->route('admin.subscription.show');
            }
        }

    }

    public function destroy($id)
    {
        $subscription = Subscription::find($id);

        if(!$subscription){
            Alert::error('Failed Message', 'You have failed delete subscription.');
            return redirect()->route('admin.subscription.show');
        }

        $subscription->delete();
        Alert::success('Success Message', 'You have successfully delete subscription.');
        return redirect()->route('admin.subscription.show');   
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => ['required'],
            'id_plan' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);

        if ($validator->fails()) {
            $error = "You have failed update subscription.\n".strval($validator->errors());
            Alert::error('Failed Message', $error);
            return redirect()->route('admin.subscription.show');
        }

            $startDate = $request->start_date;
            $endDate = $request->end_date;
            // difference between startDate and endDate in months
            $diff = abs(strtotime($endDate) - strtotime($startDate));
            $years = floor($diff / (365*60*60*24));
            $months = floor($diff / (30*60*60*24));
            $data['duration'] = $months;

        
        $data['id_user'] = $request->id_user;
        $data['id_plan'] = $request->id_plan;
        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;
        // dd($data);

        $subscription = Subscription::find($id);

        if(!$subscription){
            Alert::error('Failed Message', 'You have failed update subscription.');
            return redirect()->route('admin.subscription.show');
        }

        $result = $subscription->update($data);
        if($result){
            Alert::success('Success Message', 'You have successfully update subscription.');
            return redirect()->route('admin.subscription.show');
        }else{
            Alert::error('Failed Message', 'You have failed update subscription.');
            return redirect()->route('admin.subscription.show');
        }
    }
}
