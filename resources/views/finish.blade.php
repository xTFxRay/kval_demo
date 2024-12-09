<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/main.css" rel="stylesheet">
    <title>Apdare Form</title>
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
                <div class="bullet active">
                    <span>5</span>
                </div>
                <div class="step-title">Logi un Durvis</div>
            </div>
            <div class="step">
                <div class="bullet active">
                    <span>6</span>
                </div>
                <div class="step-title">Apdare</div>
            </div>
        </div> 
        <h2>Iekšējā un Ārējā apdare</h2>
        <form action="{{ route('plumblight') }}" method="get">
            @csrf
            <h3>Iekšējā apdare</h3>
            <label for="gridu-veids">Grīdas veids:</label>
            <select id="gridu-veids" name="gridu-veids">
                <option value="Parkets">Parkets</option>
                <option value="Lamināts">Lamināts</option>
                <option value="Flīzes">Flīzes</option>
            </select>

            <label for="sienu-apdare">Sienu apdare:</label>
            <select id="sienu-apdare" name="sienu-apdare">
                <option value="Bez apdares">Bez apdares</option>
                <option value="Krasa">Krāsa</option>
                <option value="Tapetes">Tapetes</option>
                <option value="Dekoratīvās plāksnes">Dekoratīvās plāksnes</option>
            </select>

            <label for="griestu-apdare">Griestu apdare:</label>
            <select id="griestu-apdare" name="griestu-apdare">
                <option value="Bez apdares">Bez apdares</option>
                <option value="Krasa">Krāsaoti griesti</option>
                <option value="paneli">Paneļi</option>
                <option value="koka-apsuvums">Koka apšuvums</option>
                <option value="gipskartons">Ģipškartona griesti</option>
            </select>

            <h3>Ārējā apdare</h3>
            <label for="fasades-apsuvums">Fasādes apšuvums:</label>
            <select id="fasades-apsuvums" name="fasades-apsuvums">
                <option value="blank">Bez apšuvuma</option>
                <option value="metals">Metāla apšuvums</option>
                <option value="vinils">Vinila apšuvums</option>
                <option value="akmens">Akmens apšuvums</option>
            </select>


            <h3>Aprēķinātās izmaksas: <span>{{$totalCost ?? 0}}</span>€</h3>

            <input type="submit" value="Turpināt">
        </form>
    </div>
</body>
</html>
