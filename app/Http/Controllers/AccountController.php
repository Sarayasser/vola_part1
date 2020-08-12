<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
use App\Bank;
use App\Transaction;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(){
        $accounts=Account::all();
        $banks=Bank::all();
        return view('index',['accounts'=>$accounts,'banks'=>$banks]);
    }
    public function create(){
        $banks=Bank::all();
        return view('create',['banks'=>$banks]);
    }
    public function store(){
        $request=Request();
        $bank_id=Bank::where('bank_name',$request->bank_name)->first()->id;
        // dd($bank_id);
        Account::create([
            'user_id'=>Auth::user()->id,
            'bank_id'=>$bank_id,
            'currency'=>$request->currency,
            'type_of_account'=>$request->type_of_account,
            'balance'=>$request->balance,
            // 'status'=>'active',
        ]);
        return redirect('/home');
    }
    public function show(){
        $request=Request();
        $account=Account::where('id',$request->id)->first();
        $trans=Transaction::where('account_id',$request->id)->get();
        // dd($trans);
        return view('show',['account'=>$account,'trans'=>$trans]);
    }
    public function edit(){
        $request=Request();
        $account=Account::where('id',$request->id)->first();
        return view('edit',['account'=>$account]);
    }
    public function update(){
        $request=Request();
        $id=$request->id;
        // dd($id);
        if($request->currency || $request->type_of_account != null){
        $account=Account::where('id',$id)->first()->update([
            'currency'=>$request->currency,
            'type_of_account'=>$request->type_of_account,
        ]);
        }
        // $account->save();
        return redirect('home');
    }
    public function delete(){
        $request=Request();
        $trans=Transaction::where('id',$request->id)->first();
        $trans->rollback();
        // dd($request->id);
    }
    public function status(){
        $request=Request();
        $account = Account::find($request->id);
        // dd($request->status);
        if($request->status == 1){
        $account->status = 1;
        }else{
        $account->status = 0;
        }
        // dd($account);
        $account->save();

        return redirect('/home');
    }

    public function createTrans(){
        $request=Request();
        $account=Account::where('id',$request->id)->first();
        // dd($request->type);
        if($request->type == "deposit"){
            // dd($request->type);
            return view('transactions/deposite',['account'=>$account]);
        }
        if($request->type == "withdraw"){
            return view('transactions/withdraw',['account'=>$account]);
        }
        if($request->type == "transfer"){
            return view('transactions/transfer',['account'=>$account]);
        }

    }

    public function deposit(){
        $request=Request();
        $transaction=Transaction::create([
            'account_id'=>$request->id,
            'amount'=>$request->amount,
            'date'=>now(),
        ]);
        $transaction->save();

        $account=Account::where('id',$request->id)->first();
        $account->balance += $request->amount;
        $account->save();

        return redirect()->route('account.show',['id'=>$account->id]);
    }

    public function withdraw(){
        $request=Request();
        $transaction=Transaction::create([
            'account_id'=>$request->id,
            'amount'=>$request->amount,
            'date'=>now(),
        ]);
        $transaction->save();

        $account=Account::where('id',$request->id)->first();
        $account->balance -= $request->amount;
        $account->save();

        $trans=Transaction::where('account_id',$request->id)->get();
        // dd($trans);
        return view('show',['account'=>$account,'trans'=>$trans]);
    }

    public function transfer(){
        $request=Request();
        $transaction=Transaction::create([
            'account_id'=>$request->id,
            'accountto_id'=>$request->accountto_id,
            'amount'=>$request->amount,
            'date'=>now(),
        ]);
        $transaction->save();

        $account=Account::where('id',$request->id)->first();
        $account->balance -= $request->amount;
        $account->save();

        $accountto=Account::where('id',$request->accountto_id)->first();
        $accountto->balance += $request->amount;
        $accountto->save();

        $trans=Transaction::where('account_id',$request->id)->get();
        // dd($trans);
        return view('show',['account'=>$account,'trans'=>$trans]);
    }

    public function filterDate(){
        $request=Request();
        // dd($request->filter);
        if($request->filter == "asc"){
            $trans=Transaction::where('account_id',$request->id)->orderBy('date','asc')->get();
            $account=Account::where('id',$request->id)->first();
            // dd($trans);
            return view('show',['account'=>$account,'trans'=>$trans]);
        }
        if($request->filter == "desc"){
            $trans=Transaction::where('account_id',$request->id)->orderBy('date','desc')->get();
            $account=Account::where('id',$request->id)->first();
            // dd($trans);
            return view('show',['account'=>$account,'trans'=>$trans]);
        }

    }

    public function filterBank(){
        $request=Request();
        // dd($request);
        $banks=Bank::all();
        if($request->filter == "1"){
            $accounts=Account::where('bank_id',$request->filter)->get();
            return view('index',['accounts'=>$accounts,'banks'=>$banks]);
        }
        if($request->filter == "2"){
            $accounts=Account::where('bank_id',$request->filter)->get();
            return view('index',['accounts'=>$accounts,'banks'=>$banks]);
        }
        if($request->filter == "3"){
            $accounts=Account::where('bank_id',$request->filter)->get();
            return view('index',['accounts'=>$accounts,'banks'=>$banks]);
        }
        if($request->filter == "all"){
            $accounts=Account::all();
            return view('index',['accounts'=>$accounts,'banks'=>$banks]);
        }

    }
}
