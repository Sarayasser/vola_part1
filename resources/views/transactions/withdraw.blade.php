@extends('layouts.app')
@section('content')
<h3>Withdraw Form</h3>
<form class="col-6" method="POST" action="{{route('account.withdraw',['id'=>$account->id])}}">
@csrf
<div class="form-group">
    <label for="exampleFormControlInput1">Amount</label>
    <input type="text" class="form-control" name="amount" placeholder="Amount">
</div>
<div>
<a class="btn btn-danger">+</a>
</div>
  <div>
  <button type="submit" class="btn btn-success m-3">Submit</button>
  </div>
</form>

@endsection
