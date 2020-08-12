<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
use App\Bank;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(){
        $accounts=Account::all();
        return view('index',['accounts'=>$accounts]);
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
}
