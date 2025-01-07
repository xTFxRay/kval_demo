<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EmailController extends Controller
{
   
    public function verify_code(Request $request)
{
    $request->validate([
        'code' => 'required|numeric',
    ]);

    $storedCode = session('verification_code'); 
    


    if ($request->code != $storedCode) {
        return back()->withErrors(['code' => 'Ievadītais kods ir nepareizs. Lūdzu, mēģiniet vēlreiz.']);
    }


    $registrationData = session('registration_data');
    $profilePicturePath=$registrationData['profile_picture'];
    

    //Saglabā profila bildi sistēmā
    if ($profilePicturePath) {
        $profilePicturePath = $request->file('profile_picture')->store('photos', 'public');
    }


    //Izveido jaunu lietotāja ierakstu
    $user = User::create([
        'name' => $registrationData['name'],
        'surname' => $registrationData['surname'],
        'phone' => $registrationData['phone'],
        'email' => $registrationData['email'],
        'password' => $registrationData['password'],
        'role' => $registrationData['role'],
        'profile_picture' => $profilePicturePath
    ]);

    session()->forget('registration_data');

    //Lietotāja pieteikšanās sistēmā
    Auth::login($user);

    return redirect()->route('home', ['user' => $user]);
}



}