<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request){
        $this->validate( $request , [
            'name' => 'required',
            'password' => 'required|min:6'
        ]);


    $user = User::where('name' , $request->name)->first();

    if($user){
        if(Hash::check($request->password, $user->password)){
            if(Auth::attempt(['name' => $request->name, 'password' => $request->password])){
                return  $this->sendLoginResponse($request);
            }
        }
        else{
            return redirect()->back()->with(['fail' => "password does't match !!!"]);
        }
    }
    else{
        return redirect()->back()->with(['fail' => 'user not registered !!!']);
    }

}
}
