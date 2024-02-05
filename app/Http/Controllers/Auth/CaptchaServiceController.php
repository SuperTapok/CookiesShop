<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CaptchaServiceController extends Controller
{
    public function index()
    {
        return view('captcha');
    }

    public function capthcaFormValidate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::once($credentials)) {
            $user = Auth::getUser();
            Auth::login($user);
            return redirect("");
        }
        else {
            return redirect('captcha-form');
        }
        
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
