@extends('layouts.app')

@section('content')
<div class="container">
@if(Session::has('message'))
      <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
      @endif
    <div class="row justify-content-center">
      
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                   
                            <a href="{{ route('add.user') }}">Add new user</a> 


                            <table class="table">
  <thead>
    <tr>
     
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Created at</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
<?php $i=1?>
@forelse ($users as $user)
    <tr>
      
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->created_at}}</td>
      <td>
     <a href="{{route('edit.user',[$user->id])}}"> <button type="button" class="btn btn-primary">Edit</button></a>
     <a onclick="return confirm('Are you sure you want to delete this user?');" href="{{route('delete.user',[$user->id])}}"><button type="button" class="btn btn-danger">Delete</button></a>

      </td>
      </tr>
      @empty
    <p>No users</p>
    @endforelse
  </tbody>
</table>

{{ $users->links() }} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
