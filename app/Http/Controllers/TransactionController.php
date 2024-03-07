<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\ProjectModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('id_user', Auth::user()->id)->paginate(5);
        $projectlist = ProjectModel::where('user_id', Auth::user()->id)->get();
        return view('workspace.transaction.index', compact('transactions', 'projectlist'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'created_date' => ['required'],
            'amount' => ['required'],
            'description' => ['required'],
            'source' => ['required'],
            'category' => ['required'],
        ]);

        if ($validator->fails()) {
            $error = "You have failed add new transaction.\n" . strval($validator->errors());
            Alert::error('Failed Message', $error);
            return redirect()->route('workspace.transaction.show');
        }

        // make data
        $transaction = new Transaction();

        if ($request->project_id != null) {
            $transaction->id_project = $request->project_id;
        } else {
            $transaction->id_project = 1;
        }
        $transaction->id_user = Auth::user()->id;
        $transaction->created_date = $request->created_date;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->source = $request->source;
        $transaction->category = $request->category;
        $transaction->is_income = 0;
        $transaction->save();

        if ($transaction) {
            Alert::success('Success Message', 'You have successfully add new transaction.');
            return redirect()->route('workspace.transaction.show');
        } else {
            Alert::error('Failed Message', 'You have failed add new transaction.');
            return redirect()->route('workspace.transaction.show');
        }
    }

    public function createincome(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'created_date' => ['required'],
            'amount' => ['required'],
            'description' => ['required'],
            'source' => ['required'],
            'category' => ['required'],
        ]);

        if ($validator->fails()) {
            $error = "You have failed add new transaction.\n" . strval($validator->errors());
            Alert::error('Failed Message', $error);
            return redirect()->route('workspace.transaction.show');
        }

        // make data
        $transaction = new Transaction();

        if ($request->project_id != null) {
            $transaction->id_project = $request->project_id;
        } else {
            $transaction->id_project = 1;
        }

        $transaction->id_user = Auth::user()->id;
        $transaction->created_date = $request->created_date;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->source = $request->source;
        $transaction->category = $request->category;
        $transaction->is_income = 1;
        $transaction->save();

        if ($transaction) {
            Alert::success('Success Message', 'You have successfully add new transaction.');
            return redirect()->route('workspace.transaction.show');
        } else {
            Alert::error('Failed Message', 'You have failed add new transaction.');
            return redirect()->route('workspace.transaction.show');
        }
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            Alert::error('Failed Message', 'You have failed delete transaction.');
            return redirect()->route('workspace.transaction.show');
        }

        $transaction->delete();
        Alert::success('Success Message', 'You have successfully delete transaction.');
        return redirect()->route('workspace.transaction.show');

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'created_date' => ['required'],
            'amount' => ['required'],
            'description' => ['required'],
            'source' => ['required'],
            'category' => ['required'],
        ]);

        if ($validator->fails()) {
            $error = "You have failed update transaction.\n" . strval($validator->errors());
            Alert::error('Failed Message', $error);
            return redirect()->route('workspace.transaction.show');
        }
        $transaction = Transaction::find($id);
        if ($request->project_id != null) {
            $transaction->id_project = $request->project_id;
        } else {
            $transaction->id_project = 1;
        }
        $transaction->id_user = Auth::user()->id;
        $transaction->created_date = $request->created_date;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->source = $request->source;
        $transaction->category = $request->category;
        $transaction->save();

        if ($transaction) {
            Alert::success('Success Message', 'You have successfully update transaction.');
            return redirect()->route('workspace.transaction.show');
        } else {
            Alert::error('Failed Message', 'You have failed update transaction.');
            return redirect()->route('workspace.transaction.show');
        }
    }

}
