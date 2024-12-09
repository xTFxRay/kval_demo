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
                    <h1>Rediģēt preci</h1>
                </div>
                <div class="content">
                    <form action="{{ route('product_save', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                    
                        <label for="name">Nosaukums:</label>
                        <input type="text" name="name" value="{{ $product->name }}" required>
                    
                        <label for="description">Apraksts:</label>
                        <textarea name="description" required>{{ $product->description }}</textarea>
                    
                        <label for="price">Cena:</label>
                        <input type="number" name="price" value="{{ $product->price }}" step="0.01" required>
                    
                        <label for="category">Kategorija:</label>
                        <input type="text" name="category" value="{{ $product->category }}">
                    
                        <label for="image">Foto:</label>
                        <input type="file" name="image">
                    
                    
                        <button type="submit">Atjaunināt produktu</button>
                        <a href="{{ route('products') }}" class="back-button">Atpakaļ</a>
                    </form>
                </div>
            
            
            
    </div>
</body>
</html>
