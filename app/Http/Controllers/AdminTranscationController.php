<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionAdmin;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AdminTranscationController extends Controller
{
    public function index()
    {
        $transactions = DB::table('transaction_admins')
        ->join('subscriptions', 'transaction_admins.id_subscription', '=', 'subscriptions.id')
        ->join('users', 'subscriptions.id_user', '=', 'users.id')
        ->join('plans', 'subscriptions.id_plan', '=', 'plans.id')
        ->select('transaction_admins.*', 'users.fullname as fullname', 'plans.plan_name as plan_name')
        ->get();
        $freelances = User::where('id_role', 3)->get();
        $subscriptions = Subscription::all();
        return view('admin.transaction.index', compact('transactions', 'freelances', 'subscriptions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_subscription' => ['required'],
            'id_user' => ['required'],
            'date' => ['required'],
            'amount' => ['required'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $error = "You have failed add new transaction.\n".strval($validator->errors());
            Alert::error('Failed Message', $error);
            return redirect()->route('admin.transaction.show');
        }

        $data['id_subscription'] = $request->id_subscription;
        $data['id_user'] = $request->id_user;
        $data['date'] = $request->date;
        $data['amount'] = $request->amount;
        $data['status'] = $request->status;

        if(!$data){
            dd('error');
        }else{
            $result = TransactionAdmin::create($data);
            if($result){
                Alert::success('Success Message', 'You have successfully add new transaction.');
                return redirect()->route('admin.transaction.show');
            }else{
                Alert::error('Failed Message', 'You have failed add new transaction.');
                return redirect()->route('admin.transaction.show');
            }
        }
    }

    public function destroy($id)
    {
        $transaction = TransactionAdmin::find($id);

        if(!$transaction){
            Alert::error('Failed Message', 'You have failed delete transaction.');
            return redirect()->route('admin.transaction.show');
        }

        $transaction->delete();
        Alert::success('Success Message', 'You have successfully delete transaction.');
        return redirect()->route('admin.transaction.show');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => ['required'],
            'amount' => ['required'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $error = "You have failed update transaction.\n".strval($validator->errors());
            Alert::error('Failed Message', $error);
            return redirect()->route('admin.transaction.show');
        }

        $data['date'] = $request->date;
        $data['amount'] = $request->amount;
        $data['status'] = $request->status;

        if(!$data){
            dd('error');
        }else{
            $result = TransactionAdmin::find($id)->update($data);
            if($result){
                Alert::success('Success Message', 'You have successfully update transaction.');
                return redirect()->route('admin.transaction.show');
            }else{
                Alert::error('Failed Message', 'You have failed update transaction.');
                return redirect()->route('admin.transaction.show');
            }
        }
    }
}
