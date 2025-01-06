<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/main.css" rel="stylesheet">
    <title>Santehnika</title>
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
        .button-link {
            display: inline-block;
            width: 90%;
            background-color: green; 
            color: white;
            text-align: center;
            padding: 10px 20px;
            margin: 10px 0;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button-link:hover {
            background-color: #45a049; 
            text-decoration: none;
        }
</style>
<body>
    <div class="black"></div>
    <div class="form-container">
            <div class="progress">
                <div class="step">
                    <div class="bullet active">
                        <span>7</span>
                    </div>
                    <div class="step-title">Santehnika</div>
                </div>
                <div class="step">
                    <div class="bullet">
                        <span>8</span>
                    </div>
                    <div class="step-title">Mēbeles</div>
                </div>
                <div class="step">
                    <div class="bullet">
                        <span>9</span>
                    </div>
                    <div class="step-title">Autonovietne</div>
                </div>
            </div> 
        <h2>Santehnika</h2>

        <div id="formFields">
            <form action="{{ route('furniture') }}" method="GET">
                <h4>Gaisa plūsmas</h4>
                <div>
                    <label>
                        <input type="checkbox" name="ventilacija" value="Ventilācija"> Ventilācijas sistēma
                    </label>
                </div>
                <div>
                    <label>
                        <input type="checkbox" name="gaisa_filtrs" value="Gaisa filtrs"> Gaisa filtri
                    </label>
                </div>

                <h4>Ūdens filtri</h4>
                <div>
                    <label>
                        <input type="checkbox" name="centralais_filtrs" value="Centrālais filtrs"> Centrālie ūdens filtri 
                    </label>
                </div>
                <div>
                    <label>
                        <input type="checkbox" name="udens_filtrs" value="Ūdens filtrs"> Dzeramā ūdens filtri
                    </label>
                </div>

                <h3>Aprēķinātās izmaksas: <span>{{ $totalCost ?? 0 }}</span>€</h3>

                <input type="submit" value="Nākamais">
                <a href="{{ route('start') }}" class="button-link">Beigt</a>
            </form>
        </div>
    </div>

</body>
</html>
