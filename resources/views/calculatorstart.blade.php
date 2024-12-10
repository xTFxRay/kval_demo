@extends('layouts.app')

@section('title', 'Moduļu Mājas Kalkulators')


    <style>
        body {
            background-image: url("../images/bricks.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; 
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        .calculator_container {
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .progress {
            display: flex;
            margin-bottom: 20px;
            justify-content: space-between;
        }
        .step {
            text-align: center;
        }
        .step .bullet {
            width: 30px;
            height: 30px;
            line-height: 30px;
            background: gray;
            color: white;
            border-radius: 50%;
            display: inline-block;
        }
        .step-title {
            margin-top: 5px;
            font-size: 12px;
        }
        form.area {
            margin-top: 20px;
        }
        form.area label {
            display: block;
            margin-bottom: 10px;
        }
        form.area select, form.area input[type="submit"] {
            display: block;
            margin-bottom: 20px;
            width: 100%;
        }
        .edit, .logout {
            display: inline-block;
            margin: 10px 0;
        }
    </style>


@section('content')
    <div class="calculator_container">
        <div class="progress">
            <div class="step">
                <div class="bullet active">
                    <span>1</span>
                </div>
                <div class="step-title">Sākums</div>
            </div>
            <div class="step">
                <div class="bullet">
                    <span>2</span>
                </div>
                <div class="step-title">Dokumentācija</div>
            </div>
            <div class="step">
                <div class="bullet">
                    <span>3</span>
                </div>
                <div class="step-title">Mājas konstrukcija</div>
            </div>
            <div class="step">
                <div class="bullet">
                    <span>...</span>
                </div>
                <div class="step-title">...</div>
            </div>
            <div class="step">
                <div class="bullet">
                    <span>11</span>
                </div>
                <div class="step-title">Rezultāti</div>
            </div>
        </div>

        <h2>Moduļu mājas kalkulators</h2>
        <p>Šis ir moduļu mājas cenu kalkulators. Nospiežot sākt Jums tiks uzdoti jautājumi saistībā ar Jums vēlamo mājas komplektāciju un beigās tiks izveidots aptuvens cenu aprēķins Jums tīkamai moduļu mājai. Lai sākt izvēlaties mājas izmēra diapazonu (m2) un nospiediet sākt.</p>
        
        <form action="{{ route('layout') }}" method="get" class="area">
            @csrf
            <label for="squareMeters">Mājas platība (m2):</label>
            <select id="squareMeters" name="squareMeters">
                <option value="40-60">40 m² - 60 m²</option>
                <option value="70-85">70 m² - 85 m²</option>
                <option value="90-120">90 m² - 120 m²</option>
            </select>

            <input type="submit" value="Sākt">
        </form>

        @auth
            <a href="{{ route('editPrices') }}" class="edit">Rediģēt cenas</a>
        @endauth
        <a href="{{ route('home') }}" class="logout button">Atpakaļ</a>
    </div>
@endsection
