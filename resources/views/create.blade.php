@extends('layouts.app')
@section('content')

<form class="col-6" method="POST" action="{{route('account.store')}}">
@csrf
  <div class="form-group">
    <label for="exampleFormControlSelect1">Bank</label>
    <select class="form-control" name="bank_name">
    @foreach($banks as $bank)
      <option>{{$bank->bank_name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Type of Account</label>
    <select class="form-control" name="type_of_account">
      <option>Current Account</option>
      <option>Savings Account</option>
      <option>Credit Account</option>
      <option>Joint Account</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Currency</label>
    <select class="form-control" name="currency">
      <option>USD</option>
      <option>EURO</option>
      <option>EGP</option>
      <option>SAR</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Balance</label>
    <input type="text" class="form-control" name="balance" placeholder="Balance">
  </div>

  <div>
  <button type="submit" class="btn btn-success m-3">Submit</button>
  </div>
</form>

@endsection
