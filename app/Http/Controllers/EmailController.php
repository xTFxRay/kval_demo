<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EmailController extends Controller
{
    public function verify(Request $request)
    {
        $verificationCode = rand(100000, 999999);
        Session::put('verification_code', $verificationCode);
        $user = Auth::user(); 

        Mail::send('emails.verificationemail', ['code' => $verificationCode], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Your Verification Code');
        });

        return view('verification',compact( 'user'));
    }


    public function verify_code(Request $request)
{

    $totalPrice = 0;
    $cart = session('cart');
    if ($cart) {
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
    }

    $request->validate([
        'code' => 'required|digits:6',
    ]);

    $storedCode = session('verification_code'); 

    if ($storedCode && $request->code == $storedCode) {
        session()->forget('verification_code'); 
        return redirect()->route('checkout')->with([
            'totalPrice' => $totalPrice, 
            'user' => Auth::user() 
        ]);
    }

    return back()->with('error', 'Invalid verification code. Please try again.');
}



}