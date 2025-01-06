<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/main.css" rel="stylesheet">
    <title>Mājas Konstrukcija</title>
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
                    <span>1</span>
                </div>
                <div class="step-title">Sākums</div>
            </div>
            <div class="step">
                <div class="bullet active">
                    <span>2</span>
                </div>
                <div class="step-title">Dokumentācija</div>
            </div>
            <div class="step">
                <div class="bullet active">
                    <span>3</span>
                </div>
                <div class="step-title">Mājas konstrukcija</div>
            </div>
        </div> 
        <h2>Mājas konstrukcija</h2>
        <div id="formFields">
            <form action="{{ route('heating') }}" method="get">
              @csrf
                <h3>Pamatu veidi</h3>
                <select id="pamatu-veidi" name="pamatu-veidi">
                    <option value="Lentes pamati">Lentes pamati</option>
                    <option value="Plātņu pamati">Plātņu pamati</option>
                    <option value="Pāļpamati">Pāļpamati</option>
                    <option value="Bloku pamati">Saliekamo bloku pamati</option>
                </select>

                <h3>Sienas biezums</h3>
                <select id="sienas-biezums" name="sienas-biezums">
                    <option value="15">15 cm (vidējs karkass)</option>
                    <option value="10">10 cm (viegls karkass)</option>
                    <option value="20">20 cm (smags karkass)</option>
                </select>

                <h3>Sienas tips</h3>
                <select id="sienas-tips" name="sienas-tips">
                    <option value="Keramzitbloku">Keramzītbloku sienas</option>
                    <option value="Koka karkasa">Koka karkasa sienas</option>
                    <option value="Monolīta betona">Monolīta betona sienas</option>
                    <option value="Metāla karkasa">Metāla karkasa sienas</option>
                </select>

                <h3>Jumta segums</h3>
                    <select id="jumta-veidi" name="jumta-veidi">
                        <option value="Dakstini">Dakstiņu jumts</option>
                        <option value="Metāla jumts">Metāla jumts</option>
                        <option value="Šīferis">Bezazbesta viļņoto lokšņu jumts</option>
                    </select>
                
                <h3>Aprēķinātās izmaksas: <span>{{ $totalCost ?? 0 }}</span>€</h3>
                
                <input type="submit" value="Nākamais">
                <a href="{{ route('start') }}" class="button-link">Beigt</a>
            </form>
        </div>
    </div>

</body>
</html>
