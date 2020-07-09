@extends('users.layout.master')

@section('sub_content')
   <div class="container">
   	
   	<h2>Welcome {{ $user->first_name . ' ' . $user->last_name}}</h2>
          <div class="row">
          	<div class="col-md-4">
          		<div class="card card-body mt-2">
          		    <a href="{{ route('user.profile') }}">Update Profile</a>
          	    </div>
          	</div>
          </div>

   </div>

@endsection       