<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/main.css" rel="stylesheet">
    <script src="/js/app.js"></script>
    
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
        .calculator-container{
            z-index: 1;
        }
</style>
<body>
<div class="black"></div>
<div class="calculator-container">
    <h2>Izvēlieties mājas plānu</h2>
    <p>Lūdzu izvēlieties vienu no zemāk minētajiem mājas plāniem, kas atbilst jūsu izvēlētajam platībai:</p>

    <form action="{{ route('building') }}" method="get">
        @csrf

        <div class="house-plans">
            @foreach($plans as $plan)
                <div class="house-plan">
                    <input type="radio" id="{{ $plan['name'] }}" name="housePlan" value="{{ $plan['name'] }}">
                    <label for="{{ $plan['name'] }}">
                        <img src="{{ asset('images/' . ($plan['image'])) }}" alt="{{ $plan['name'] }}" class="plan-image" style="width: 200px; height: auto;">
                        <div class="plan-details">
                            <h3>{{ $plan['name'] }}</h3>
                            <p>{{ $plan['size'] }} m²</p>
                        </div>
                    </label>
                </div>
            @endforeach
        </div>

        <h3>Aprēķinātās izmaksas: <span>{{ $totalCost ?? 0 }}</span>€</h3>


        <input type="submit" value="Turpināt">
    </form>

</div>

<div id="myModal" class="modal">
    <span class="close" id="closeModal">&times;</span>
    <img class="modal-content" id="img01" alt="img">
</div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
</html>
