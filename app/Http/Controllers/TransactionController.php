<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('id_user', Auth::user()->id)->paginate(5);
        return view('workspace.transaction.index', compact('transactions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'created_date' => ['required'],
            'amount' => ['required'],
            'date' => ['required'],
            'status' => ['required'],
        ]);
    }

    public function destroy($id)
    {

    }

    public function update(Request $request, $id)
    {
       
    }

}
