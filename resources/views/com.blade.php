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
            height: auto; 
            display: flex;
            flex-direction: column;
            justify-content: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
           
        }

        .black {
            background-color: rgba(0, 0, 0, 0.5); 
            height: 145%;
            width: 100%;
            position: absolute;
            z-index: 0;
            
            
        }
        .form-container{
            z-index: 1;
            margin-top: 20px;
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
            <form id="mainForm" method="POST" action="{{ route('extras') }}">
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
                        <input type="checkbox" name="cela_apg" value="Ceļa apgaismojums"> Ceļa apgaismojums
                    </label>
                </div>
                <div>
                    <label>
                        <input type="checkbox" name="zemes_apg" value="Zemes lampa"> Zemes apgaismojums
                    </label>
                </div>
        
                <label for="zoga-uzstadisana">Žoga uzstādīšana</label>
                <select name="zoga-uzstadisana" id="zoga-uzstadisana">
                    <option value="Nē">Nē</option>
                    <option value="Jā">Jā</option>
                </select>
        
                <div id="platiba" class="pasleptie-elem">
                    <label for="platiba">Žoga platība (m)</label>
                    <input type="number" id="platiba" name="platiba" min="0">
        
                    <label for="varti">Vārtu veids:</label>
                    <select id="varti" name="varti">
                        <option value="Bez">Bez vārtiem</option>
                        <option value="Elektriskie vārti">Elektriskie vārti</option>
                        <option value="Manuāli vārti">Manuāli vārti</option>
                    </select>
                </div>
        
                <label>Celiņa uzstādīšana</label>
                <select name="celins" id="celins">
                    <option value="Nē">Nē</option>
                    <option value="Jā">Jā</option>
                </select>
        
                <div id="celina_uzstadisana" class="pasleptie-elem">
                    <label for="celina_uzstadisana">Celiņa platība (m²):</label>
                    <input type="number" id="celina_uzstadisana" name="celina_uzstadisana" min="0" placeholder="Ievadiet platību m²">
                </div>
        
                <label for="zaliens">Zāliena uzstādīšana</label>
                <select name="zaliens" id="zaliens">
                    <option value="Nē">Nē</option>
                    <option value="Jā">Jā</option>
                </select>
        
                <div id="zaliena_ierikosana" class="pasleptie-elem">
                    <label>Zāliena platība (m²):</label>
                    <input type="number" id="zaliena_ierikosana" name="zaliena_ierikosana" min="0" placeholder="Ievadiet platību m²">
                </div>
        
                <h3>Aprēķinātās izmaksas: <span>{{ $totalCost ?? 0 }}</span>€</h3>
        
                <input type="submit" value="{{ Auth::check() ? 'Turpināt' : 'Pabeigt' }}">
                <a href="{{ route('start') }}" class="button-link">Beigt</a>
            </form>
        </div>
        
        <div id="popup" class="popup">
            <div class="content">
                <h2>Vai vēlaties pievienot savas izmaksas?</h2>
                <div class="choises">
                    <a href="#" class="button" onclick="submitFormWithRoute('{{ route('specification') }}')">Pievienot izmaksas</a>
                    <a href="#" class="button" onclick="submitFormWithRoute('{{ route('extras') }}')">Izlaist</a>
                </div>
                <span class="close">&times;</span>
            </div>
        </div>
        
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            function toggleFields() {
                const zogsUzst = document.getElementById('zoga-uzstadisana').value;
                const celinsUzst = document.getElementById('celins').value;
                const zaliensUzst = document.getElementById('zaliens').value;
        
                document.getElementById('platiba').style.display = zogsUzst === 'Jā' ? 'block' : 'none';
                document.getElementById('celina_uzstadisana').style.display = celinsUzst === 'Jā' ? 'block' : 'none';
                document.getElementById('zaliena_ierikosana').style.display = zaliensUzst === 'Jā' ? 'block' : 'none';
            }
        
            window.onload = function () {
                toggleFields();
                document.getElementById('zoga-uzstadisana').addEventListener('change', toggleFields);
                document.getElementById('celins').addEventListener('change', toggleFields);
                document.getElementById('zaliens').addEventListener('change', toggleFields);
            };
        
            function submitFormWithRoute(route) {
                const form = document.getElementById('mainForm');
                form.action = route;
                form.submit();
            }
        </script>
</body>

</html>
