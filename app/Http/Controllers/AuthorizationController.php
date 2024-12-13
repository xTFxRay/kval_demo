<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Cart;

use Session;


class AuthorizationController extends Controller
{
    function login(){
        return view("login");
    }

    function register(){
        return view("register");
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:7',
        ]);
        
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect()->intended(route('adminDash')); 
            }


            return redirect()->intended(route('home'));
        }
        return redirect()->intended(route('login'))->with("error", "Kļūda pieslēdzoties serverim");
    }

    function registerPost(Request $request){
       
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:7',

        ]);
       
        $data['name'] = $request->name;
        $data['surname'] = $request->surname;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['role'] = 'default_user';
        
        $user = User::create($data);
        $credentials = $request->only('email','password');

        if(!$user){
            return redirect(route('login'))->with('error','Kļūda registrējot lietotāju');
        }
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'));
        }

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

    $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id, 
        'phone' => 'nullable|string|max:20',
        'password' => 'nullable|min:8',
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
}