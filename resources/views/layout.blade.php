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

        .modal {
        display: none;
        position: fixed;
        z-index: 2;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.8);
    }


        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }


        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        .button-link {
            display: inline-block;
            width: 93%;
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
<div class="calculator-container">
    <div class="mt-5">
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
    </div>
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

        


        <input type="submit" value="Turpināt">
        <a href="{{ route('start') }}" class="button-link">Beigt</a>
    </form>

</div>

<div id="myModal" class="modal">
    <span class="close" id="closeModal">&times;</span>
    <img class="modal-content" id="img01" alt="img">
</div>
</body>

<script src="{{ asset('js/app.js') }}"></script> 
<script>
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("myModal");
    const modalImg = document.getElementById("img01");
    const closeModal = document.getElementById("closeModal");

    const images = document.querySelectorAll(".plan-image");
    images.forEach(image => {
        image.addEventListener("click", function () {
            modal.style.display = "block"; 
            modalImg.src = this.src;      
            modalImg.alt = this.alt;    
        });
    });

    closeModal.addEventListener("click", function () {
        modal.style.display = "none";
    });

    modal.addEventListener("click", function (event) {
        if (event.target !== modalImg) {
            modal.style.display = "none";
        }
    });
});
</script>

</html>
