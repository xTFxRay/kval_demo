<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rediģēt pasūtījumu</title>
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
            background-image: url("{{ asset('images/bricks.png') }}");
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
        .form-container input[type="number"],
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
            font-family: sans-serif;
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

        <h1>Rediģēt Pasūtījumu</h1>
        <form action="{{ route('order_save', $order->id) }}" method="POST">
            @csrf
            <div>
                <label for="name">Vārds:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $order->name) }}" required>
            </div>
            <div>
                <label for="email">Ēpasts:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $order->email) }}" required>
            </div>
            <div>
                <label for="address">Adrese:</label>
                <input type="text" id="address" name="address" value="{{ old('address', $order->address) }}" required>
            </div>
            <div>
                <label for="payment_method">Apmaksas veids:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="on_delivery" {{ old('payment_method', $order->payment_method) == 'on_delivery' ? 'selected' : '' }}>Apmaksas piegādes brīdī</option>
                    <option value="credit_card" {{ old('payment_method', $order->payment_method) == 'credit_card' ? 'selected' : '' }}>Kredītkarte</option>
                </select>
            </div>
            <div>
                <label for="card_number">Kartes numurs:</label>
                <input type="text" id="card_number" name="card_number" value="{{ old('card_number', $order->card_number) }}">
            </div>
            <div>
                <label for="total_amount">Kopējā summa:</label>
                <input type="number" id="total_amount" name="total_amount" value="{{ old('total_amount', $order->total_amount) }}" step="0.01" required>
            </div>
            <button type="submit">Saglabāt</button>
            <a href="{{ route('users') }}" class="back-button">Atpakaļ</a>
        </form>
        </div>
            
            
            
    </div>
</body>
</html>
