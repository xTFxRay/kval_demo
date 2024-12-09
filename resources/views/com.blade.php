<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/main.css" rel="stylesheet">
    <title>Labiekārtošana</title>
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
</head>

<body>
    <div class="black"></div>
    <div class="form-container">
        <div class="progress">
            <div class="step">
                <div class="bullet active">
                    <span>9</span>
                </div>
                <div class="step-title">Autonovietne</div>
            </div>
            <div class="step">
                <div class="bullet active">
                    <span>10</span>
                </div>
                <div class="step-title">Papildus opcijas</div>
            </div>
            <div class="step">
                <div class="bullet">
                    <span>11</span>
                </div>
                <div class="step-title">Rezultāti</div>
            </div>
        </div> 
        <h2>Piemājas teritorijas labiekārtošana</h2>
        <div id="formFields">
            <form  
                @if(Auth::check()) 
                    onsubmit="event.preventDefault(); popup();" 
                @else 
                    action="{{ route('results') }}" 
                @endif>

            @csrf
                <h3>Apgaismojuma instalācija</h3>

                <h4>Iekštelpu apgaismojums</h4>
                <div>
                    <label>
                        <input type="checkbox" name="spot_gaismas" value="Spot gaismas"> Spot gaismas
                    </label>
                </div>
                <div>
                    <label>
                        <input type="checkbox" name="led_paneli" value="LED paneli"> LED paneļi
                    </label>
                </div>

                <h4>Āra apgaismojums</h4>
                <div>
                    <label>
                        <input type="checkbox" name="sienas_gaismas" value="Sienas gaismeklis"> Sienas gaismekļi
                    </label>
                </div>
                <div>
                    <label>
                        <input type="checkbox" name="cela_apg" value="Ceļa apgaismojums">Ceļa apgaismojums
                    </label>
                </div>
                <div>
                    <label>
                        <input type="checkbox" name="zemes_apg" value="Zemes lampa">Zemes apgaismojums
                    </label>
                </div>


                <label for="zoga-uzstadisana">Žoga uzstādīšana</label>
                <select name="zoga-uzstadisana" id="zoga-uzstadisana">
                    <option value="Nē">Nē</option>
                    <option value="Jā">Jā</option>
                </select>

                <div id="platiba" class="pasleptie-elem">
                    <label for="platiba">Žoga platība (m)</label>
                    <input type="number" id="platiba" name="platiba">
        
                    <label for="varti">Vārtu veids:</label>
                    <select id="varti" name="varti">
                        <option value="no">Bez vārtiem</option>
                        <option value="elektriskie_varti">Elektriskie vārti</option>
                        <option value="varti">Manuāli vārti</option>
                    </select>

                </div>

                <label>Celiņa uzstādīšana</label>
                <select name="celins" id="celins">
                    <option value="Nē">Nē</option>
                    <option value="Jā">Jā</option>
                </select>

                <div id="celina_uzstadisana" class="pasleptie-elem">
                    <label for="celina_uzstadisana">Celiņa platība (m²):</label>
                    <input type="number" id="celina_uzstadisana" name="celina_uzstadisana" min = "1" placeholder="Ievadiet platību m²">
                </div>

                <label for="zaliens">Zāliena uzstādīšana</label>
                <select name="zaliens" id="zaliens">
                    <option value="Nē">Nē</option>
                    <option value="Jā">Jā</option>
                </select>

                <div id="zaliena_ierikosana" class="pasleptie-elem">
                    <label>Zāliena platība (m²):</label>
                    <input type="number" id="zaliena_ierikosana" name="zaliena_ierikosana"  min = "1" placeholder="Ievadiet platību m²">
                </div>


                <h3>Aprēķinātās izmaksas: <span>{{ $totalCost ?? 0 }}</span>€</h3>

                <input type="submit" value="{{ Auth::check() ? 'Turpināt' : 'Pabeigt' }}" >
            </form>
        </div>
        <div id="popup" class="popup">
            <div class="content">
                <h2>Vai vēlaties pievienot savas izmaksas?</h2>
                <div class="choises">
                    <a href="{{ route('specification') }}" class="button">Pievienot izmaksas</a>
                    <a href="{{ route('results') }}" class="button">Izlaist</a>
                </div>
                <span class="close">&times;</span>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
