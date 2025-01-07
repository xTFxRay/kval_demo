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
            background-image: url("../images/bricks.png");
            background-size:cover;
            background-position: center;
            height: 100vh; 
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            
           
        }
        .links li a:hover{
            color: gold;
        }
        li, button, a, .fa-instagram, .fa-facebook, .fa-twitter, .fa-user{
            color:white;
        }
        .product_container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding-top: 40px;
            padding-bottom: 40px;
            padding-left: 300px;
            padding-right: 300px;
            height: auto;
            background-color: rgba(255, 255, 255, 0.8); 
            backdrop-filter: blur(10px);
        }

        .filter-options {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .products {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            
            align-content: center;
        }


        .product {
            background-color: #ffffff; 
            border-radius: 8px; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
            overflow: hidden; 
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product:hover {
        transform: translateY(-5px); 
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); 
    }


        .product img {
        max-width: 80%; 
        max-height: 200px; 
        object-fit: contain; 
        margin-bottom: 10px; 
        margin-top: 10px;
    }

    .filter-group label {
    display: block;
    margin-bottom: 8px;
}

#price-min,
#price-max {
    display: block;
    width: 100%;
    margin-bottom: 8px;
    
}

.filter-options > :nth-last-child(2) {
    order: 1;
    margin-left: 0; 
}

.filter-options > :last-child {
    order: 2;
    margin-left: 15px; 
}
.filter-group {
    flex-direction: column;
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
                        <a href="{{ route('delete') }}" class="menu-link">
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
       
    <div id="product_container" class="product_container">
            @if (session('error'))
                <div class="alert alert-danger" style="color: red;">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        <div class="filter-options">
            <div class="filter-group">
                <label for="category">Kategorija:</label>
                <select id="category">
                    <option value="Visi">Visi</option>
                    <option value="Apgaismojums">Apgaismojums</option>
                    <option value="Apsilde">Apsilde</option>
                    <option value="Mēbeles">Mēbeles</option>
                    <option value="Drošība">Drošība</option>
                    <option value="Siltinājums">Siltinājums</option>
                    <option value="Durvis">Durvis</option>
                    <option value="Logi">Logi</option>
                    <option value="Interjers">Interjers</option>
                    <option value="Jumta Segums">Jumta Segums</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="price-min">Cena:</label>
                <input type="number" id="price-min" placeholder="Min" min="0">
                <input type="number" id="price-max" placeholder="Max" max="1500">
            </div>
            <div class="filter-group">
                <label for="sort">Kārtot pēc:</label>
                <select id="sort">
                    <option value="default">Nav</option>
                    <option value="price-asc">Pēc cenas augošā</option>
                    <option value="price-desc">Pēc cenas dilstošā</option>
                    <option value="newest">Jaunākās preces</option>
                </select>
            </div>
            <div class="filter-group">
                <button onclick="applyFilters()">Pielietot</button>
            </div>

            <div class="filter-group">
                <a style="margin-top: 0px;" href="{{ route('cart') }}">
                    <button>Skatīt Grozu</button>
                </a>
            </div>
            
        </div>

        <div class="products">
            @foreach ($products as $product)  
                <div class="product">
                    <img src="{{ $product->image ? asset($product->image) : asset('images/image-not-available.png') }}" alt="{{ $product->name }}">


                    <h2>{{ $product->name }}</h2>
                    <p class="price">{{ number_format($product->price, 2) }}€</p>
                    <a style="margin-top: 10px; margin-bottom: 10px;" href="{{ route('product.show', $product->id) }}">
                        <button>Apskatīt</button>
                        
                    </a>
                </div>
            @endforeach
        </div>
    </div>
<script>

let subMenu = document.querySelector(".sub-menu");

function toggleMenu(){
    subMenu.classList.toggle("open-menu");
}


    function applyFilters() {
    const category = document.getElementById('category').value;
    const priceMin = document.getElementById('price-min').value;
    const priceMax = document.getElementById('price-max').value;
    const sort = document.getElementById('sort').value;

    const queryParams = new URLSearchParams();

    if (category !== 'Visi') queryParams.append('category', category);
    if (priceMin) queryParams.append('price_min', priceMin);
    if (priceMax) queryParams.append('price_max', priceMax);
    if (sort !== 'default') queryParams.append('sort', sort);

    window.location.href = `?${queryParams.toString()}`;
}

</script>
<script src="{{ asset('js/app.js') }}"></script>    
</body>
</html>
