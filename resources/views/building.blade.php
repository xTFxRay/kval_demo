<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/main.css" rel="stylesheet">
    <title>Būvniecības norise</title>
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
        }; 
        
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
                    <div class="bullet ">
                        <span>3</span>
                    </div>
                    <div class="step-title">Mājas konstrukcija</div>
                </div>
            </div> 
       
        <h2>Būvniecības norise</h2>
        <div id="formFields">
            <form action="{{ route('structure') }}" method="get">
                @csrf
                <h3>Būvniecībai nepieciešamie dokumenti</h3>

                <label>Projekta saskaņošana</label>
                <select name="projekts" id="projekts">
                    <option value="Nav nepieciešams">Nav nepieciešams</option>
                    <option value="Nepieciešams">Nepieciešams</option>
                </select>

                <label>Zemes mērīšana</label>
                <select name="merisana" id="merisana">
                    <option value="Nav nepieciešams">Nav nepieciešams</option>
                    <option value="Nepieciešams">Nepieciešams</option>
                </select>

                <label>Robežu apstiprināšana</label>
                <select name="robezu-apstiprinasana" id="robezu-apstiprinasana">
                    <option value="Nav nepieciešams">Nav nepieciešams</option>
                    <option value="Nepieciešams">Nepieciešams</option>
                </select>

                <label>Būvvaldes atļauja</label>
                <select name="atlauja" id="atlauja">
                    <option value="Nav nepieciešams">Nav nepieciešams</option>
                    <option value="Nepieciešams">Nepieciešams</option>
                </select>

                <label>Nodošana eksplotācijā</label>
                <select name="eksplotacija" id="eksplotacija">
                    <option value="Nav nepieciešams">Nav nepieciešams</option>
                    <option value="Nepieciešams">Nepieciešams</option>
                </select>

                <input type="submit" value="Nākamais">
                <a href="{{ route('start') }}" class="button-link">Beigt</a>
            </form>
        </div>
    </div>

</body>
</html>
