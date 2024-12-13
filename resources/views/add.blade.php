<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/main.css" rel="stylesheet">
    <title>Garāža un Autostāvvieta Form</title>
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
            height: 105%;
            width: 100%;
            position: absolute;
            z-index: 0;
            
            
        }
        .form-container{
            z-index: 1;
        }
        .hidden {
            display: none;
        }

        .button-link {
            display: inline-block;
            width: 90%;
            background-color: #4CAF50; 
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
        }
    </style>
</head>
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
                <div class="bullet active">
                    <span>8</span>
                </div>
                <div class="step-title">Mēbeles</div>
            </div>
            <div class="step">
                <div class="bullet active">
                    <span>9</span>
                </div>
                <div class="step-title">Autonovietne</div>
            </div>
        </div> 
        <h2>Garāža vai Autostāvvieta</h2>
        <form action="{{ route('com') }}" method="get">
            @csrf
            <h3>Garāža</h3>
            <select id="garaza-q" name="garaza-q" onchange="toggleInputFields()">
                <option value="no">Nē</option>
                <option value="yes">Jā</option>
            </select>

            <div id="garaza" class="hidden">
                <label for="garaza_m2">Norādiet garāžas izmēru (m2):</label>
                <input type="number" id="garaza" name="garaza" placeholder="Garāžas platība m2">
            </div>

            <h3>Autonovietne</h3>
            <select id="stavvieta-q" name="stavvieta-q" onchange="toggleInputFields()">
                <option value="no">Nē</option>
                <option value="yes">Jā</option>
            </select>

            <div id="stavvieta" class="hidden">
                <label for="stavvieta">Norādiet autonovietnes izmēru (m2):</label>
                <input type="number" id="stavvieta" name="stavvieta" placeholder="Autonovietnes platība m2">
            </div>

            <h3>Mājas drošības risinājumi</h3>
            <label for="drosibas-sistema">Drošības sistēmas:</label>
            <select id="drosibas-sistema" name="drosibas-sistema">
                <option value="no">-</option>
                <option value="Signalizācijas sistēma">Signalizācijas sistēma</option>
                <option value="Videonovērošanas sistēma">Videonovērošanas sistēma</option>
            </select>

            <label for="sensori">Sensori:</label>
            <select id="sensori" name="sensori">
                <option value="no">-</option>
                <option value="Kustības kamera">Kustības sensori</option>
                <option value="Dūmu detektors">Dūmu detektori</option>
            </select>

            <h3>Aprēķinātās izmaksas: <span>{{ $totalCost ?? 0 }}</span>€</h3>

            <input type="submit" value="Turpināt">
            <a href="{{ route('start') }}" class="button-link">Beigt</a>
        </form>
    </div>


<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
