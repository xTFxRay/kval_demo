<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulators</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            box-sizing: border-box;
            font-family: "Montserrat", sans-serif;
            margin: 0;
            padding: 0;
            vertical-align: super;
        }
        body {
            background-image: url(../images/bricks.png);
            background-size: cover;
           
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
        }
        .links li a:hover{
            color: gold;
        }
        li, button, a, .fa-instagram, .fa-facebook, .fa-twitter, .fa-user{
            color:white;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); 
            z-index: 1;
            border-radius: 10px;
            
            
        }

        .text-area {
            position: relative;
            z-index: 2; 
            max-width: 700px;
            cursor: pointer;
            border-bottom: 2px solid #fff;
        }
        .text-overlay {
            position: relative;
            z-index: 2; 
            color: white;
            text-align: center;
         
            padding: 40px 20px; 
            margin: 20px;
            max-width: 80%; 
            margin-left: auto;
            margin-right: auto;
            border-radius: 10px;
        }

        .text-area h1, .text-area p {
            margin: 20px 0;
            font-size: 24px; 
            color: white;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }
        .question, .answer {
            text-align: left; 
            margin-top: 10px; 
        }

        .question h3, .answer p {
            color: white; 
            margin: 5px 0; 

        }

        .fa-chevron-down {
            margin-left: 10px; 
            vertical-align: middle; 
        }
        .question{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .answer p{
            padding-top: 16px;
            line-height: 1.5;
            font-size: 24px;
        }
        .answer{
            max-height: 0;
            overflow: hidden;
            transition: max-height 1.4s ease;
        }

        .text-area.active .answer{
            max-height:300px;
        }

    </style>
</head>
<body>
    <header>
        <a href="{{ route('home') }}" class="logo">ModuļuMājas</a>

        <nav>
            <div class = "nav">
            <ul class="links">

            <li><a href="{{ route('home') }}">Sākums</a></li>
            <li><a href="{{ route('modularhouses') }}">Moduļu mājas</a></li>
            @Auth
            <li><a href="{{ route('store') }}">Būvē pats</a></li>
            @endauth
            <li><a href="{{ route('faq') }}">FAQ</a></li>
            <li><a href="{{ route('start') }}">Kalkulators</a></li>

            </ul>
          
            </div>

            <div class="sub-menu">
                <div class="menu">
                    <div class="info">
                        <img src="{{ $user?->photo ? asset('storage/photos/' . $user->photo) : asset('default_icon.jpg') }}" alt="photo">
                            <h3>{{ $user?->name ?? 'Viesis' }}</h3>
                    </div>
                    <hr>
                    
                    @if (Auth::check())
                    <a href="{{ route('delete', ['id' => $user->id]) }}" class="menu-link" onclick="return confirm('Vai tiešām vēlaties dzēst savu kontu?')">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <p>Dzēst kontu</p>
                            <span>></span>
                        </a>
                        <a href="{{ route('edit') }}" class="menu-link">
                            <i class="fa-solid fa-user-pen"></i>
                            <p>Rediģēt profilu</p>
                            <span>></span>
                        </a>
                        <a href="{{ route('logout') }}" class="menu-link">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <p>Izrakstīties</p>
                            <span>></span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="menu-link">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <p>Pieslēgties</p>
                            <span>></span>
                        </a>
                    @endif
                </div>
            </div>
          
        </nav>
        <div class = "media">
            <a href= "javascript:void(0);" onclick="toggleMenu()" id="subMenu">
                <i class="fa-regular fa-user"></i>
            </a>
            <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-facebook"></i>
            </a>
        </div>
    </header>
  
        
    
        <div class="text-overlay">
            <div class="overlay"></div>
            <div class="text-area">
                <h1>FAQ's</h1>
            <div class = "question">  
                <h3>Kāpēc izvēlēties moduļu māju?</h3>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="answer">
                <p>Moduļu mājas ir ekonomisks risinājums, kas piedāvā izcilu kvalitāti, ātru uzstādīšanu un ilgmūžību, 
                vienlaikus nodrošinot mūsdienīgu un personalizētu dizainu.</p>
            </div>
            </div>

            <div class="text-area">
            <div class = "question">  
                <h3>Vai moduļu mājas ir ilgmūzīgas?</h3>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="answer">
                <p>Jā, moduļu mājas tiek būvētas no augstas kvalitātes materiāliem, kas nodrošina izturību un ilgmūžību, 
                salīdzināmu ar tradicionālajām mājām.</p>
            </div>
            </div>

            <div class="text-area">
            <div class = "question">  
                <h3>Vai moduļu mājas iespējams uzstādīt jebkur?</h3>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="answer">
                <p>Jā, moduļu mājas ir pielāgojamas un piemērotas uzstādīšanai gandrīz jebkurā vietā, kur ir pieejams
                piemērots pamats un infrastruktūra.</p>
            </div>
            </div>

            <div class="text-area">
            <div class = "question">  
                <h3>Kāpēc moduļu mājas būvē tik ātri?</h3>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="answer">
                <p>Moduļu mājas tiek ražotas rūpnīcā kontrolētos apstākļos, kas ievērojami samazina būvniecības laiku
                un ļauj uzstādīt māju uz vietas dažu nedēļu laikā.</p>
            </div>
            </div>
        </div>
        </div>
        
    


<script>

let subMenu = document.querySelector(".sub-menu");

function toggleMenu(){
    subMenu.classList.toggle("open-menu");
}

let text_show = document.querySelectorAll(".text-area");
    text_show.forEach(text => {
        text.addEventListener("click", () =>{
            text.classList.toggle("active");
        })
    })


    var modal = document.getElementById("myModal");

    
var images = document.querySelectorAll('.plan-image');
var modalImg = document.getElementById("img01");

images.forEach(function(image) {
    image.onclick = function() {
        modal.style.display = "flex"; 
        modalImg.src = this.src; 
    }
});


var span = document.getElementById("closeModal");


span.onclick = function() {
    modal.style.display = "none";
}


window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


</script>
</body>
</html>
