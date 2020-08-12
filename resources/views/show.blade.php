@extends('layouts.app')
@section('content')

<div class="col-3">
<h3> Transactions:
</h3>
<h4>Bank : {{$account->bank->bank_name}}</h4>
<a class="btn btn-success mr-3" href="{{route('account.createTrans',['id'=>$account->id,'type'=>'deposit'])}}">Deposit</a>
<a class="btn btn-primary mr-3" href="{{route('account.createTrans',['id'=>$account->id,'type'=>'withdraw'])}}">Withdraw</a>
<a class="btn btn-danger" href="{{route('account.createTrans',['id'=>$account->id,'type'=>'transfer'])}}">Transfer</a>
<h4 class="mt-2">Filter By Date:</h4>
<a class="btn btn-dark" href="{{route('account.filterDate',['id'=>$account->id,'filter'=>'asc'])}}">Ascending</a>
<a class="btn btn-light" href="{{route('account.filterDate',['id'=>$account->id,'filter'=>'desc'])}}">Descending</a>
</div>

<table class="table mt-5">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">From Account</th>
      <th scope="col">To Account</th>
      <th scope="col">Amount</th>
      <th scope="col">Type of transaction</th>
      <th scope="col">Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($trans as $tran)
    <tr>
      <th scope="row">{{$tran->id}}</th>
      <td>{{$tran->account_id}}</td>
      <td>{{$tran->accountto_id}}</td>
      <td>{{$tran->amount}}</td>
      <td>{{$tran->type_of_transaction}}</td>
      <td>{{$tran->date}}</td>
    @if($tran->date == date('Y-m-d'))
    <td><a class="btn btn-danger" href="{{route('account.delete',['id'=>$tran->id])}}">Delete</a></td>
    @endif
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
