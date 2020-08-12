@extends('layouts.app')
@section('content')
<h3>Transfer Form</h3>
<form class="col-6" method="POST" action="{{route('account.transfer',['id'=>$account->id])}}">
@csrf
<div class="form-group">
    <label for="exampleFormControlInput1">Amount</label>
    <input type="text" class="form-control" name="amount" placeholder="Amount">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Account To</label>
    <input type="text" class="form-control" name="accountto_id" placeholder="Account To">
</div>
<div>
<a class="btn btn-danger">+</a>
</div>
  <div>
  <button type="submit" class="btn btn-success m-3">Submit</button>
  </div>
</form>

@endsection
