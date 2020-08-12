@extends('layouts.app')
@section('content')

<div class="col-3">
<h3> Welcome {{Auth::user()->name}}
</h3>
@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
</div>

<div class="col-6">
<a type="button" class="btn btn-success" href="{{route('account.create')}}">Create new Account</a>
</div>

<div class="col-3 mt-3">
<h5>Banks filter:</h5>
<a class="btn btn-dark mr-2" href="{{route('account.filterBank',['filter'=>'all'])}}">All</a>
    @foreach($banks as $bank)
  <a class="btn btn-dark mr-2" href="{{route('account.filterBank',['filter'=>$bank->id])}}">{{$bank->bank_name}}</a>
    @endforeach
</div>

<table class="table mt-5">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Bank Name</th>
      <th scope="col">Type of Account</th>
      <th scope="col">Currency</th>
      <th scope="col">Balance</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
      <th scope="col">Transactions</th>
    </tr>
  </thead>
  <tbody>
  @foreach($accounts as $account)
    <tr>
      <th scope="row">{{$account->id}}</th>
      <td>{{$account->bank->bank_name}}</td>
      <td>{{$account->type_of_account}}</td>
      <td>{{$account->currency}}</td>
      <td>{{$account->balance}}</td>
      @if($account->status == 0)
      <td>InActive</td>
      @else
      <td>Active</td>
      @endif
      @if($account->status === 0)
      <td>
      <a class="btn btn-success" href="{{route('account.status',['id'=>$account->id,'status'=>1])}}">Activate</a>
      <a class="btn btn-primary" href="{{route('account.edit',['id'=>$account->id])}}">Update</a>
      </td>
      @else
      <td>
      <a class="btn btn-danger" href="{{route('account.status',['id'=>$account->id,'status'=>0])}}">Deactivate</a>
      <a class="btn btn-primary" href="{{route('account.edit',['id'=>$account->id])}}">Update</a>
      </td>
      @endif

      <td>
      <a class="btn btn-dark" href="{{route('account.show',['id'=>$account->id])}}">Show</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection

