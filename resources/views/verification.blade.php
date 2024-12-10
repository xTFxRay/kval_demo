@extends('layouts.app')

@section('title', 'Verifikācija') 

<style>
    .verification_container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 8px;
        max-width: 900px;
        width: 70vh;
        height: auto;
        margin: 20px auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .verification_container h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .verification_container p {
        font-size: 16px;
        margin-bottom: 20px;
        color: #555;
    }

    .verification_container form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .verification_container input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    .verification_container button {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .verification_container button:hover {
        background-color: #45a049;
    }
</style>


@section('content')
    <div class="verification_container">
        <h2>Ievadiet verifikācijas kodu</h2>
        <p>Mēs esam nosūtījuši verifikācijas kodu uz jūsu kontā norādīto adresi. Ievadiet to lai turpinātu.</p>

        <form action="{{ route('verify_code') }}" method="POST">
            @csrf
            <input type="text" name="code" id="code" placeholder="Ievadiet kodu" required maxlength="6" pattern="\d{6}">
            <button type="submit">Apstiprināt</button>
        </form>

        @if(session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif
    </div>
@endsection


   
