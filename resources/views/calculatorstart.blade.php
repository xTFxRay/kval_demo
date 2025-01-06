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
            width: 100%;
            height: 100%;
            margin: auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            top: 40%;
        }
        .progress {
            display: flex;
            margin-bottom: 20px;
            justify-content: space-between;
            width: 100%;
            height: 50px;
            padding: 10px;
           
        }
        .step {
            text-align: center;
        }

        .edit{
            width: 48%;
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
      
        form.area label {
            display: block;
            margin-bottom: 10px;
        }
        h2{
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
            background-color: black;
        }
        .logout{
            margin-top: 31px;
        }
        .logout{
            width: 50%;
        }
        input[type="submit"]{
            background-color: green;
            color: white;
            border-radius: 10px;
            border: 0px;
        }


        .content {
            width: 100%;
            height: calc(100% - 50px);
            display: flex;
            justify-content: space-between;
        }

        .left {
            width: 50%;
            padding: 20px;
        }

        .right {
            width: 50%;
            padding: 20px;
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
 
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
        <div class="col-12">
            @foreach($errors->all() as $error)
                <div class="alert error">{{ $error }}</div>
            @endforeach
        </div>
    @endif
        
    @if(session()->has('error'))
        <div class="alert error">
            {{ session('error') }}
        </div>
    @endif

    <div class="content">
        <div class="left">
            <h2>Moduļu mājas kalkulators</h2>
            <p>Šis ir moduļu mājas cenu kalkulators. 
            Nospiežot sākt Jums tiks uzdoti jautājumi saistībā ar Jums vēlamo mājas komplektāciju
            un beigās tiks izveidots aptuvens cenu aprēķins Jums tīkamai moduļu mājai. 
            Lai sākt izvēlaties mājas izmēra diapazonu (m2) un nospiediet sākt.</p>
            @auth
                <a href="{{ route('editPrices') }}" class="edit">Rediģēt cenas</a>
            @endauth
        </div>
        <div class="right">
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
            
            <a href="{{ route('home') }}" class="logout button">Atpakaļ</a>
        </div>
    </div>
</div>
@endsection
