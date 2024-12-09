<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/main.css" rel="stylesheet">
    <title>Siltinājums</title>
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
</style>
<body>
    <div class="black"></div>
    <div class="form-container">
        <div class="progress">
            <div class="step">
                <div class="bullet active">
                    <span>4</span>
                </div>
                <div class="step-title">Siltinājums</div>
            </div>
            <div class="step">
                <div class="bullet">
                    <span>5</span>
                </div>
                <div class="step-title">Logi un Durvis</div>
            </div>
            <div class="step">
                <div class="bullet">
                    <span>6</span>
                </div>
                <div class="step-title">Apdare</div>
            </div>
        </div> 
        <h2>Siltinājums</h2>
        <div id="formFields">
            <form action="{{ route('winDoor') }}" method="get">
            <h3>Apsildes veids</h3>
                <label for="apsildes-veids">Apkures sistēma:</label>
                <select id="apsildes-veids" name="apsildes-veids">
                    <option value="Bez">Bez</option>
                    <option value="Gāzes katls">Gāzes apkure</option>
                    <option value="Siltumsūknis">Siltumsūknis (gaisa-ūdens, zemes)</option>
                    <option value="Apkures katls">Centrālā apkure</option>
                    <option value="Radiators">Radiatori</option>
                </select>

                <h3>Siltinājuma veids</h3>

                <label for="siltinajums-gridai">Siltinājums grīdai:</label>
                <select id="siltinajums-gridai" name="siltinajums-gridai">
                    <option value="Bez">Bez</option>
                    <option value="Akmens vate">Akmens vate</option>
                    <option value="Stikla vate">Stikla vate</option>
                    <option value="Putuplasts">EPS (putuplasts)</option>
                    <option value="XPS">XPS</option> 
                    <option value="Putas">Poliuretāna putas</option>
                  
                </select>

                <label for="siltinajums-sienam">Siltinājums sienām:</label>
                <select id="siltinajums-sienam" name="siltinajums-sienam">
                    <option value="Bez">Bez</option>
                    <option value="Akmens vate">Akmens vate</option>
                    <option value="Stikla vate">Stikla vate</option>
                    <option value="Putuplasts">EPS (putuplasts)</option>
                    <option value="XPS">XPS</option>
                    <option value="Putas">Poliuretāna putas</option>
                </select>

                <label for="siltinajums-griestiem">Siltinājums griestiem:</label>
                <select id="siltinajums-griestiem" name="siltinajums-griestiem">
                    <option value="Bez">Bez</option>
                    <option value="Akmens vate">Akmens vate</option>
                    <option value="Stikla vate">Stikla vate</option>
                    <option value="Putuplasts">EPS (putuplasts)</option>
                    <option value="XPS">XPS</option>
                    <option value="Putas">Poliuretāna putas</option>
                </select>

                <h3>Aprēķinātās izmaksas: <span>{{ $totalCost ?? 0 }}</span>€</h3>

                <input type="submit" value="Nākamais">
            </form>
        </div>
    </div>

</body>
</html>