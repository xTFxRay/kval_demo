<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7); 
            z-index: 0;
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

        .form-container {
            border: 2px solid #ccc;
            padding: 20px;
            background-color: white;
            width: 350px;
            z-index: 1;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            font-weight: bold;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"],
        .form-container input[type="password_confirmation"],
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-container button:hover {
            background-color: #45a049;
        }
        

        .back-button {
            display: inline-block;
            margin-top: 20px;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            width: 90%;
            transition: background-color 0.3s, color 0.3s;
        }

        
    </style>
</head>
<body>

    <div class="overlay"></div>

    <div class="form-container">
            
            
       
            <div class="page_title">
                <h1>Pievienot Lietotāju</h1>
            </div>
            <div class="content">
                <form action="{{ route('user_store') }}" method="POST">
                    @csrf
                    <label for="name">Vārds:</label>
                    <input type="text" name="name" required>
                    <label for="email">Ēpasts:</label>
                    <input type="email" name="email" required>
                    <label for="password">Parole:</label>
                    <input type="password" name="password" required>
                    <label for="password_confirmation">Apstiprināt paroli:</label>
                    <input type="password" name="password_confirmation" required>
                    <label for="role">Loma:</label>
                    <select name="role" required>
                        <option value="admin">Admin</option>
                        <option value="default_user">Lietotājs</option>
                    </select>
                    <button type="submit">Pievienot lietotāju</button>
                    <a href="{{ route('users') }}" class="back-button">Atpakaļ</a>
                </form>
            </div>
        
            
            
            
    </div>
</body>
</html>







