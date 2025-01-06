<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
            .form-container h2 {
                font-size: 24px;
                margin-bottom: 10px;
            }

            .form-container p {
                font-size: 16px;
                margin-bottom: 20px;
                color: #555;
            }

            .form-container form {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            .form-container input {
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 16px;
            }

            .form-container button {
                background-color: #4caf50;
                color: white;
                border: none;
                padding: 10px;
                border-radius: 4px;
                cursor: pointer;
            }

            .form-container button:hover {
                background-color: #45a049;
            }
         body {
            background-image: url(../images/bricks.png);
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7); 
            z-index: 0;
        }

        .form-container {
            border: 2px solid gray;
            padding: 20px;
            background-color: white;
            width: 350px;
            z-index: 1;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-top: 15px;
            font-size: 14px;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="tel"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-container .links {
            text-align: center;
            margin-top: 15px;
        }

        .form-container .links a {
            text-decoration: none;
            color: #4CAF50;
            display: block;
            margin-top: 10px;
        }

        .form-container .links a:hover {
            text-decoration: underline;
        }

        
        .alert{
            color: red;
        
        }
    </style>
</head>
<body>
    
    <div class="overlay"></div>

    <div class="form-container">
            @if (session('error'))
                <div class="alert alert-danger" style="color: red;">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
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


</body>
</html>
