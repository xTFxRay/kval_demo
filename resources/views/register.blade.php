<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
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
        <div class="mt-5">
            @if($errors->any())
                <div class= "col-12">
                    @foreach($erorrs->all() as $error)
                        <div class= "alert">{{$error}}</div>
                    @endforeach
                </div>
            @endif
        

            @if(@session()->has('error'))
                <div class= "alert">{{session('error')}}</div>
            @endif
            @if(@session()->has('success'))
                <div class= "alert-success">{{session('success')}}</div>
            @endif

        </div>

        <h2>Lietotāja reģistrācija</h2>
        <form id="registrationForm" action="{{route('register.post')}}" method="POST">
            @csrf
            <label for="name">Vārds:</label>
            <input type="text" id="name" name="name">

            <label for="surname">Uzvārds:</label>
            <input type="text" id="surname" name="surname">

            <label for="email">Ēpasts:</label>
            <input type="email" id="email" name="email">
            
            <label for="phone">Telefons:</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{8,14}">
            <div class="error-message" id="phoneError"></div>
            
            <label for="password">Parole:</label>
            <input type="password" id="password" name="password" minlength="7" required>
            <div class="error-message" id="passwordError"></div>

            <input type="submit" value="Turpināt">
        </form>

        <div class="links">
            <a href="{{ route('home') }}">Turpināt kā viesim</a>
        </div>
    </div>


</body>
</html>