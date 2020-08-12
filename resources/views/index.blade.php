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
      <td><a class="btn btn-success" href="{{route('account.status',['id'=>$account->id,'status'=>1])}}">Activate</a></td>
      @else
      <p>{{$account->status}}</p>
      <td><a class="btn btn-danger" href="{{route('account.status',['id'=>$account->id,'status'=>0])}}">Deactivate</a></td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>

@endsection

