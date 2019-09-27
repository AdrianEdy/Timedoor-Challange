<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

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

    public function login(Request $request)
    {
        $this->validateLogin($request);
        $user = User::where($this->username(), $request->{$this->username()})->first();

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $errors = null;
        if (!$user) {
            $errors[$this->username()] = "Your {$this->username()} is wrong!";
        } else {
            if (!Hash::check($request->password, $user->password)) {
                $errors['password'] = "Your password is wrong!";
            } else {
                if (!$user->hasVerifiedEmail()) {
                    $errors['verified'] = "Your email has not been verified yet, "
                                        . "please verified your email first.";
                } else {
                    if ($this->attemptLogin($request)) {
                        return $this->sendLoginResponse($request);
                    }
                }
            }
        }
        
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request, $errors);
    }

    protected function sendFailedLoginResponse(Request $request, $errors)
    {
        if ($errors) {
            throw ValidationException::withMessages($errors);
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }    

    public function logout(Request $request)
    {
        if ($request->_token !== $request->session()->token()) {
            return redirect('/');
        }
        
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
