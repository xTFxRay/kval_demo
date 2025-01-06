@extends('layouts.app')

@section('title', 'Rediģēt lietotāja iestatījumus')

@section('content')
    <div class="text-overlay">
        <div class="overlay1"></div>
        
        <div class="text1">
            
            <div class="mt-5">
                @if (session('error'))
                    <div class="alert alert-danger" style="color: red;">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" style="color: red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" style="color: white;">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            
        
            <h2 style="text-align: center; color: white; margin-bottom: 20px;">Rediģēt lietotāja iestatījumus</h2>
            <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 

                <div class="edit">
                    <label for="name">Vārds</label>
                    <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                </div>

                <div class="edit">
                    <label for="surname">Uzvārds</label>
                    <input type="text" id="surname" name="surname" value="{{ old('surname', Auth::user()->surname) }}" required>
                </div>

                <div class="edit">
                    <label for="email">Ēpasts</label>
                    <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                </div>

                <div class="edit">
                    <label for="phone">Telefons</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}">
                </div>

                <div class="edit">
                    <label for="password">Parole</label>
                    <input type="password" id="password" name="password">
                    <small>Atstājiet tukšu ja nevēlaties mainīt paroli</small>
                </div>

                <div class="edit">
                    <label for="password_confirmation">Apstipriniet Paroli</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                </div>

                <div class="edit">
                    <label for="photo">Lietotāja foto</label>
                    <input type="file" id="photo" name="photo" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Atjaunot</button>
            </form>
        </div>
    </div>
@endsection

    <style>
        .edit{
            margin-top: 0px !important;
        }
        .overlay1 {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .text-area {
            position: relative;
            z-index: 3;
            max-width: 700px;
            cursor: pointer;
            border-bottom: 2px solid #fff;
        }

        .text-overlay {
            position: absolute;
            top: 58%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 500px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            padding: 40px;
            margin-top: 20px;
        }

        .text-area h1, .text-area p {
            margin: 20px 0;
            font-size: 24px;
            color: white;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        .question, .answer {
            text-align: left;
            margin-top: 10px;
        }

        .question h3, .answer p {
            color: white;
            margin: 5px 0;
        }

        .fa-chevron-down {
            margin-left: 10px;
            vertical-align: middle;
        }

        .question {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 1.4s ease;
        }

        .text-area.active .answer {
            max-height: 300px;
        }

        .sub-menu {
            z-index: 1000;
            opacity: 100 !important;
        }

        .text1 form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .text1 .edit {
            width: 100%;
            max-width: 400px;
        }

        .text1 label {
            font-size: 16px;
            color: white;
            display: block;
            margin-bottom: 5px;
        }

        .text1 input[type="text"],
        .text1 input[type="email"],
        .text1 input[type="tel"],
        .text1 input[type="password"],
        .text1 input[type="file"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 8px;
        }
    </style>

