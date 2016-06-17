<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:10',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);
    }
    
    public function login(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return response(['error' => $validator->failed()], 400);
        }

        if ($user = User::where(['email' => $request['email'], 'phone' => $request['phone']])->first()) {
            Auth::login($user);
            return response(Session::getId());
        }

        $user = $this->create($request->all());
        Auth::login($user);
        return response(Session::getId());
    }

    public function logout(Request $request)
    {
        Auth::logout();
        if ($request->ajax() || $request->wantsJson()) {
            return response(['status' => 'ok']);
        }
        return redirect('/');
    }

    protected function adminValidator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);
    }

    public function adminLogin(Request $request)
    {
        $validator = $this->adminValidator($request->all());
        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }
        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect('/login');
        }

        return redirect()->intended('/admin/user');
    }
}
