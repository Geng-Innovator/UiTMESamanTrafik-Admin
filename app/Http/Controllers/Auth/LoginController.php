<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\LookupJenisKenderaan;
use App\LookupJenisPekerja;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username() {
    	return 'no_pekerja';
    }

    protected function authenticated(Request $request, $user) {
    	return redirect('/');
    }

	public function showLoginForm() {
    	return view('auth.log_masuk')->with([
		    	'message' => null,
			    'password' => null
		    ]);
    }

	public function login(Request $request) {
        if(Auth::attempt(['no_pekerja' => $request['no_pekerja'], 'password' => $request['password'], 'jenis_pekerja' => 1], $request['remember']))
            return redirect('/');
        else
            return view('auth.log_masuk')->with([
            	'message' => 'Nombor pekerja atau katalaluan salah.',
	            'password' => null
            ]);
    }

    public function logout() {
        Auth::logout();
        
        return view('auth.log_masuk')->with([
        	'message' => null,
	        'password' => null
        ]);
    }
}
