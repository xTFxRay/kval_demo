<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/main.css" rel="stylesheet">
    <title>Rezultāti</title>
</head>
<style>
    body {
        background-image: url("../images/bricks.png");
        background-size:cover;
        align-items: center;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh; 
        display: flex;
        flex-direction: column;
        justify-content: center;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
           
        }

    .btn, button, input[type="text"], input[type="number"] {
        display: inline-block;
        margin: 10px;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        outline: none;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button {
        background-color: green;
        color: white;
        cursor: pointer;
    }

    input[type="text"], input[type="number"] {
        width: calc(100% - 120px); 
        background-color: #f9f9f9;
        color: #333;
        border: 1px solid #ccc;
    }


    .btn {
        display: inline-block;
        margin: 10px;
        padding: 10px 20px;
        color: white;
        background-color: green;
        text-decoration: none;
        border-radius: 4px;
        font-size: 16px;
        width: 90%;
    }

    .black {
        background-color: rgba(0, 0, 0, 0.5); 
        height: 100%;
        width: 100%;
        position: absolute;
        z-index: 0;  
        }

    .form-container{
        z-index: 1;
        }

</style>
<body>
    <div class="black"></div>
    <div class="form-container">
        <h2>Pievienojiet specifikāciju Jūsu mājoklim</h2>
        
        <form action="{{ route('addSpecification') }}" method="POST" id="specificationForm">
            @csrf
            <label for="specName">Specifikācijas nosaukums:</label>
            <input type="text" id="specName" name="specName">
        
            <label for="specPrice">Cena (€):</label>
            <input type="number" id="specPrice" name="specPrice" step="0.01">
        
            <button type="submit">Pievienot specifikāciju</button>
        </form>

        <div class="buttons">
            <a href="{{ route('results') }}" class="btn">Pāriet uz rezultātiem</a>
        </div>
  
    </div>

 
</body>
</html>
