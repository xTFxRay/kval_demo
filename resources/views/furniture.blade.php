<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/main.css" rel="stylesheet">
    <title>Mēbelējums</title>
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
                    <span>7</span>
                </div>
                <div class="step-title">Santehnika</div>
            </div>
            <div class="step">
                <div class="bullet active">
                    <span>8</span>
                </div>
                <div class="step-title">Mēbeles</div>
            </div>
            <div class="step">
                <div class="bullet">
                    <span>9</span>
                </div>
                <div class="step-title">Autonovietne</div>
            </div>
        </div> 
        <h2>Mēbeles</h2>
        <div id="formFields" >
            <form action="{{ route('add') }}" method="get">
                @csrf

                <h3>Izvēlieties mēbeļu komplektu materiālu</h3>

                <div class="furniture_set">
                    <input type="radio" id="wood_set" name="furniture_set" value="Koka">
                    <label for="wood_set">Koka mēbeļu komplekts</label>
                    <img src="images/wooden_furniture.jpg" alt="Koka mēbeļu komplekts" width="100" height="100">
                </div>
            
                <div class="furniture_set">
                    <input type="radio" id="leather_set" name="furniture_set" value="Ādas">
                    <label for="leather_set">Ādas mēbeļu komplekts</label>
                    <img src="images/leather_furniture.jpg" alt="Ādas mēbeļu komplekts" width="100" height="100">
                </div>
            
                <div class="furniture_set">
                    <input type="radio" id="metal-set" name="furniture_set" value="Metāla">
                    <label for="metal_set">Metāla mēbeļu komplekts</label>
                    <img src="images/metal_furniture.jpg" alt="Metāla mēbeļu komplekts" width="100" height="100">
                </div>
            
                <div class="furniture_set">
                    <input type="radio" id="fabric_set" name="furniture_set" value="Auduma">
                    <label for="fabric_set">Auduma mēbeļu komplekts</label>
                    <img src="images/fabric_furniture.jpg" alt="Auduma mēbeļu komplekts" width="100" height="100">
                </div>

                <h3>Dizaina konsultācija</h3>
                <div class="design_consultation">
                    <select id="design_consultation" name="design_consultation">
                        <option value="yes">Jā</option>
                        <option value="no">Nē</option>
                    </select>
                </div>

                <h3>Aprēķinātās izmaksas: <span>{{ $totalCost ?? 0 }}</span>€</h3>

                <input type="submit" value="Nākamais">
            </form>
        </div>
    </div>

</body>
</html>
