<?php

namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\pqa_assessors_info;
use Auth;
use Validator;

use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'change_password']);
    }

    public function index ()
    {
        return view('auth.login');
    }

    public function validateUser (Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        

        //return json_encode($request::all());
        if ($validator->fails())
        {
            return redirect('/')->withErrors($validator)->withInput($request->all());
        }

        $userPass = sha1($request->password);

        $pqa_assessors_info = pqa_assessors_info::where(function ($query) use ($request, $userPass) {
            $query->where('assessors_email', $request->email);
            $query->where('assessors_password', $userPass);
        })->first();

        if($pqa_assessors_info == null)
        {
            return back()->withErrors(['msg' => ['Invalid username or password.']])->withInput($request->all());
            //return redirect('/')->withErrors(['msg', 'Invalid username or password.'])->withInput($request->all());
        }

        $pqa_assessors_info->assessors_status = 3;
        $pqa_assessors_info->save();

        Auth::loginUsingId($pqa_assessors_info->assessors_ID);

        return redirect('/home');
    }

    public function showUser ()
    {
        echo "aaa";
    }

    public function logout ()
    {
        Auth::logout();
        return redirect('/home');
    }

    public function change_password (Request $request)
    {
        $rules = [
            'old_password'              => 'required',
            'password'                  => 'required|min:6|confirmed',
            'password_confirmation'     => 'required|min:6',
        ];
        $messages = [
            'old_password.required'             => 'Old password is requried.',
            'password.required'                 => 'New pasasword is requried.',
            'password.min'                      => 'Password is minimum of 6 characters.',
            'password.confirmed'                => 'New password and connfirm password didn\'t matched.',
            'password_confirmation.required'    => 'Password confirmation is requried.',
            'password_confirmation.min'         => 'Password confirmation is minimum of 6 characters.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            return response()->json(['errCode' => 1, 'errMsgs' => $validator->getMessageBag()]);
        }
        //echo sha1($request->old_password);
        
        $pqa_assessors_info = pqa_assessors_info::where('assessors_password', sha1($request->old_password))->where('assessors_ID', Auth::user()->assessors_ID)->first();
        
        if($pqa_assessors_info == null) // Invalid password
        {
            return response()->json(['errCode' => 2, 'errMsgs' => 'Invalid old password.']);
        }

        $pqa_assessors_info->assessors_password = sha1($request->password);
        $pqa_assessors_info->assessors_default_password = '';
        $pqa_assessors_info->save();

        return response()->json(['errCode' => 0, 'msg' => 'Successfully changed.']);
    }
}
