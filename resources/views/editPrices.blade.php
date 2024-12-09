<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/main.css" rel="stylesheet">
    <title>Labot Cenas</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        display: grid;
        justify-content: center;
        align-items: center;
        height: 100vh;
        
        background-image: url('../images/1.png');
        background-size: cover;
        background-position: center;
        font-family: Arial, sans-serif;
}

.form-container{

    width: auto;
    display: block;
}


</style>
<body>
    <div class="form-container">
        <h2>Norādiet jaunu cenu</h2>
        
        <form method="POST" action="{{ route('updatePrices') }}">
            @csrf
            <table>
                <thead>
                    <tr>
                        <th>Izejmateriāla nosaukums</th>
                        <th>Cena (EUR)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($material_prices as $name => $price)
                        <tr>
                            <td>{{ htmlspecialchars($name) }}</td>
                            <td>
                                <input type="text" name="prices[{{ $name }}]" value="{{ htmlspecialchars($price) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit">Update Prices</button>
        </form>
            <a href="{{ route('start') }}" >Izlaist</a>
    </div>
   
</body>
</html>
