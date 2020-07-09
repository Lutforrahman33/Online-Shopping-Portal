@extends('main_layouts.master')

@section('content')
   <div class="container mt-2">
   	<div class="row">
   		<div class="col-md-4">
   			<div class="list-group">
   				<a href="{{ route('user.dashboard') }}" class="list-group-item {{ route('user.dashboard') ? 'active' : '' }}">DashBoard</a>
   				<a href="{{ route('user.profile') }}" class="list-group-item">Profile</a>
   				
   			</div>

   		</div>
   		<div class="col-md-8">
   			<div class="card card-body">
   			 @yield('sub_content')

   			 </div>
   		</div>
   	</div>
   	
   </div>

@endsection       