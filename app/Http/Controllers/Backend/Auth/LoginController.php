<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->only(['email', 'password']);

            if (auth()->guard('admin')->attempt($data)) {
                return to_route('admin.dashboard');
            }

            session()->flash('error', 'Not Found Account Please Try Again!');
            return back();
        }
        return view('backend.Auth.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
