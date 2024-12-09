<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/main.css" rel="stylesheet">
    <title>Logi un Durvis Form</title>
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
        <div class="progress">
            <div class="step">
                <div class="bullet active">
                    <span>4</span>
                </div>
                <div class="step-title">Siltinājums</div>
            </div>
            <div class="step">
                <div class="bullet active">
                    <span>5</span>
                </div>
                <div class="step-title">Logi un Durvis</div>
            </div>
            <div class="step">
                <div class="bullet">
                    <span>6</span>
                </div>
                <div class="step-title">Apdare</div>
            </div>
        </div> 
        <h2>Logi un Durvis</h2>
        <form action="{{ route('finish') }}" method="get"> 
            @csrf
            <h3>Logu tipi</h3>
            <select id="logu-tips" name="logu-tips">
                <option value="PVC logs">PVC logi</option>
                <option value="Alumīnija logs">Alumīnija logi</option>
                <option value="Koka logs">Koka logi</option>
            </select>

            <h3>Durvju veidi</h3>
            <select id="durvju-veids" name="durvju-veids">
                <option value="Ugunsdrošas durvis">Ugunsdrošas durvis</option>
                <option value="Skaņu Izolējošas durvis">Skaņas izolējošas durvis</option>
                <option value="Koka durvis">Koka durvis</option>
                <option value="Metala durvis">Metāla durvis</option>
            </select>

            <h3>Aprēķinātās izmaksas: <span>{{ $totalCost ?? 0 }}</span>€</h3>

            <input type="submit" value="Turpināt">
        </form>
    </div>
</body>
</html>
