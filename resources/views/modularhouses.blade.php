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
            background-position: center;
            background-repeat: no-repeat;
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
            width: 80%;
            height: 80%;
            background-color: rgba(0, 0, 0, 0.5); 
            z-index: 0;
            border-radius: 10px;
            z-index: -1;
            top: 150px;
            
            
        }

        .text-area {
            position: relative;
            z-index: 3; 
            max-width: 700px;
            cursor: pointer;
            border-bottom: 2px solid #fff;
        }
        .text-overlay {
            z-index: 1;
            display:grid;
            padding: 120px 20px; 
            margin: 20px;
            color: white;
            max-width: 80%;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 50px 30px;

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

        .question h3{

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


        .left {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left img {
            border-radius: 15px; 
            max-width: 100%;      
            height: auto;
            object-fit: cover;
        }
        .right p {
            margin-bottom: 20px; 
        }

        .sub-menu{
            z-index:1000;
            opacity: 100 !important;
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
            <li><a href="{{ route('store') }}">Būvē pats</a></li>
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
  
    <div class="overlay"></div>
    
        <div class="text-overlay">
            
            <div class = "left">  
                <img src="../images/r1.jpg">
            </div>
            <div class="right">
                <p>Moduļu mājas ir mūsdienīgs risinājums, kas piedāvā vairākas būtiskas priekšrocības gan būvniecības procesā, gan ikdienas dzīvē. Viena no ievērojamākajām priekšrocībām ir ātrums. Kamēr tradicionālās mājas būvniecība var aizņemt vairākus mēnešus vai pat gadus, moduļu mājas tiek būvētas ievērojami īsākā laikā. Tas ir iespējams, jo moduļi tiek izgatavoti rūpnīcā, kur tiek izmantota precīza un efektīva ražošanas tehnoloģija. Tikmēr būvniecības vietā notiek sagatavošanās darbi, piemēram, pamatu izbūve. Pēc tam rūpnīcā saražotie moduļi tiek piegādāti un ātri salikti uz vietas, kas ievērojami samazina kopējo būvniecības laiku.</p>
                <p>Moduļu mājas ir arī ļoti izmaksu efektīvas. Rūpnieciski izgatavotie moduļi samazina nevajadzīgu materiālu atkritumus, kas bieži rodas tradicionālajā būvniecībā. Turklāt rūpnīcas vide ļauj izvairīties no laikapstākļu ietekmes, kas var radīt kavējumus un papildu izdevumus. Šis kontrolētais process palīdz samazināt arī kļūdas un nodrošina augstu kvalitāti, tādējādi radot papildu ietaupījumus. Šīs izmaksu priekšrocības padara moduļu mājas pieejamas plašākam cilvēku lokam, ļaujot iegūt kvalitatīvu un mūsdienīgu mājokli par pieņemamāku cenu.</p>
                <p>Energoefektivitāte ir vēl viens būtisks faktors, kas padara moduļu mājas pievilcīgas. Šīs mājas tiek būvētas ar augstas kvalitātes izolāciju, logiem un durvīm, kas palīdz uzturēt mājas siltumu ziemā un vēsumu vasarā. Tas nozīmē, ka apkures un dzesēšanas izmaksas ir ievērojami zemākas. Daudzas moduļu mājas tiek aprīkotas arī ar modernām enerģijas taupīšanas tehnoloģijām, piemēram, saules paneļiem un energoefektīvām apkures sistēmām. Tas ne tikai palīdz samazināt izmaksas, bet arī veicina videi draudzīgāku dzīvesveidu.</p>
                <p>Moduļu māju dzīvotspēja un ilgmūžība ir vēl viens faktors, kas iedrošina cilvēkus izvēlēties šo risinājumu. Lai gan dažiem cilvēkiem var šķist, ka moduļu mājas ir mazāk izturīgas nekā tradicionālās, patiesībā tās bieži vien ir pat stiprākas. Tās tiek būvētas, lai izturētu transportēšanu un montāžu, kas prasa augstāku izturības līmeni. Tās arī atbilst visiem būvniecības standartiem un normām, tādējādi nodrošinot drošību un ilgmūžību.</p>
                
                
            </div>
            
            </div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
