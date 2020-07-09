<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;

use App\User;

class UserController extends Controller
{ 

	public function __construct()
    {
        $this->middleware('auth');
    }

   //user profile show
    
    public function dashboard(){
        
        $user = Auth::User();

    	return view('users.dashboard' , compact('user'));
    }

  //user profile update

    public function update(Request $request){
         
          $user = Auth::User();

          $this->Validate($request, [

            'first_name' => ['required', 'string', 'max:25'],
            'first_name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:100'],

        ]);

          
          $user->first_name = $request->first_name;
          $user->last_name = $request->last_name;
          $user->username = $request->username;
          $user->email = $request->email;
          $user->phone_number = $request->phone_number;
          $user->address = $request->address;

          if($request->password != NULL || $request->password != ''){

          	$user->password = Hash::make($request->password);
          }
          

          $user->save();
    	  return back();
    }

     public function profile(){
        
         
        $user = Auth::User();
    	return view('users.update' , compact('user'));
    }
}
