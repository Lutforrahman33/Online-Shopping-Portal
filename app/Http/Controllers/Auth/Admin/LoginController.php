<?php

namespace App\Http\Controllers\Auth\Admin;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

     public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    public function login(Request $request){

               
             $this->validate($request , [
              'email' => 'required',
               'password' => 'required' ,
             ]);

          if(Auth::guard('admin')->attempt(['email' => $request->email , 'password' => $request->password])){
           return redirect()->intended(route('admin.index'));
            
    }else{

        return back();
    }
    
    }
     

     public function logout(Request $request){

         $this->guard()->logout();
         $request->session()->invalidate();

         return redirect()->route('admin.login');
     }

    //  protected function guard()
    // {
    //     return Auth::guard();
    // }
}
