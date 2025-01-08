<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        .form-container input[type="number"],
        .form-container input[type="file"],
        .form-container input[type="description"],
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
            background-color: green;
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
            font-family:sans-serif;
            margin-top: 20px;
            color: white;
            background-color: green;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            width: 90%;
            transition: background-color 0.3s, color 0.3s;
        }

        .back-button:hover{
            background-color: #45a049;
        }
        
    </style>
</head>
<body>

    <div class="overlay"></div>

    <div class="form-container">
            
            
                <div class="page_title">
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
                <h1>Pievienot produktu</h1>
                </div>
                <div class="content">
                    <form action="{{ route('product_add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="name">Nosaukums:</label>
                        <input type="text" name="name" required>
                    
                        <label for="description">Apraksts:</label>
                        <textarea name="description" required></textarea>
                    
                        <label for="price">Cena:</label>
                        <input type="number" name="price" step="0.01" min="0" required>
                    
                        <label for="category">Kategorija:</label>
                        <select name="category" id="category">
                            <option value="Apgaismojums">Apgaismojums</option>
                            <option value="Mēbeles">Mēbeles</option>
                            <option value="Drošība">Drošība</option>
                            <option value="Siltinājums">Siltinājums</option>
                            <option value="Durvis">Durvis</option>
                            <option value="Logi">Logi</option>
                            <option value="Interjers">Interjers</option>
                            <option value="Jumta Segums">Jumta Segums</option>
                        </select>

                        <label for="category">Daudzums:</label>
                        <input type="number" name="quantity" min="0">
                    
                        <label for="image">Foto:</label>
                        <input type="file" name="image">
                    
                        <button type="submit">Pievienot produktu</button>
                        <a href="{{ route('products') }}" class="back-button">Atpakaļ</a>
                    </form>
                </div>
            
            
            
    </div>
</body>
</html>
