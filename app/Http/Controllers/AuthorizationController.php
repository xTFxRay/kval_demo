<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Cart;
use App\Models\User;


use Session;


class AuthorizationController extends Controller
{
    function login(){
        return view("login");
    }

    function register(){
        return view("register");
    }

    public function loginPost(Request $request)
{
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:7',
        ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->status == 'deleted') {
            Auth::logout(); 
            return redirect()->route('login')->with("error", "Konts neeksistē");
        }

        if ($user->role == 'admin') {
            return redirect()->intended(route('adminDash'));
        }

        $cart = Cart::where('user_id', $user->id)->where('status', 'active')->first();
        if (!$cart) {
            Cart::create([
                'user_id' => $user->id,
                'total_price' => 0,
                'status' => 'active',
            ]);
        }

        return redirect()->intended(route('home'));
    }

    return redirect()->intended(route('login'))->with("error", "Kļūda pieslēdzoties serverim");
}


    public function registerPost(Request $request)
    {

            if (User::where('email', $request->email)->where('status', '!=', 'deleted')->exists()) {
                return redirect()->back()->with("error", "Šis e-pasts jau pieder kādam lietotājam.");
            }
            if ($request->password !== $request->password_confirmation) {
                return redirect()->back()->with("error", "Parole un aprtiprinājuma parole nesakrīt");
            }
            
            $request->validate([
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'phone' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:7|confirmed',
            'profile_picture' => 'nullable|image',
        ]);
      
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('temp_profile_pictures', 'public');
        }
        $verificationCode = rand(100000, 999999);
        Session::put('verification_code', $verificationCode);

        session([
            'registration_data' => [
                'name' => $request->name,
                'surname' => $request->surname,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'default_user',
                'profile_picture' => $profilePicturePath,
                'status' => 'active',
            ],
        ]);
    
        Mail::send('emails.verificationemail', ['code' => $verificationCode], function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Jūsu verifikācijas kods');
        });
    

        return view('verification', [
            'email' => $request->email, 
            'verification_code' => $verificationCode 
        ]);
    }
    function logout(Request $request){

        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)->where('status', 'active')->first();

        if ($cart) {
            $cart->status = 'abandoned';
            $cart->save();
        }

        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    function update(Request $request){

    $user = Auth::user();

        if (User::where('email', $request->email)
            ->where('status', '!=', 'deleted')
            ->where('id', '!=', auth()->user()->id)  
            ->exists()) {
        return redirect()->back()->with("error", "Šis e-pasts jau eksistē.");
    }
    if ($request->password !== $request->password_confirmation) {
        return redirect()->back()->with("error", "Parole un aprtiprinājuma parole nesakrīt");
    }

    $request->validate([
        'name' => 'required|string|max:20',
        'surname' => 'required|string|max:20',
        'email' => 'required|email|max:100|unique:users,email,' . $user->id, 
        'phone' => 'nullable|string|max:20',
        'password' => 'nullable|min:8|confirmed', 
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = basename($path); 
        }
        
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');


    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();

    return redirect()->back()->with('success', 'Profils atjaunināts veiksmīgi');
    }

    public function delete($id)
{
    $user = User::findOrFail($id);
    $user->status = 'deleted'; 
    $user->email = null;
    $user->save();
    session()->flash('success', 'Konts veiksmīgi dzēsts!');
    return redirect()->route('login');
}
}