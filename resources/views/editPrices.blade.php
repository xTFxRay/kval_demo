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
        min-height: 100vh;
        height: auto;
        background-image: url('../images/bricks.png');
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
        
            <div>
                <label for="category">Izvēlieties kategoriju:</label>
                <select id="category" name="category" onchange="filterPrices()">
                    <option value="Drošība" selected>Drošība</option>
                    <option value="Apsilde">Apsilde</option>
                    <option value="Siltinājums">Siltinājums</option>
                    <option value="Durvis">Durvis</option>
                    <option value="Logi">Logi</option>
                    <option value="Interjers">Interjers</option>
                    <option value="Apgaismojums">Apgaismojums</option>
                    <option value="Jumta segums">Jumta segums</option>
                    <option value="Mēbeles">Mēbeles</option>
                </select>
            </div>
        
            <table>
                <thead>
                    <tr>
                        <th>Izejmateriāla nosaukums</th>
                        <th>Kategorija</th>
                        <th>Cena (EUR)</th>
                    </tr>
                </thead>
                <tbody id="priceTable">
                    @foreach ($material_prices as $name => $details)
                        <tr data-category="{{ $details['category'] }}">
                            <td>{{ htmlspecialchars($name) }}</td>
                            <td>{{ htmlspecialchars($details['category']) }}</td>
                            <td>
                                <input type="text" name="prices[{{ $name }}]" value="{{ htmlspecialchars($details['price']) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
            <button type="submit">Atjaunot</button>
        </form>
        <a href="{{ route('start') }}">Izlaist</a>
   
</body>
<script>
    function filterPrices() {
        const selectedCategory = document.getElementById('category').value;
        const rows = document.querySelectorAll('#priceTable tr');

        rows.forEach(row => {
            const rowCategory = row.getAttribute('data-category');
            if (selectedCategory === "" || rowCategory === selectedCategory) {
                row.style.display = ""; 
            } else {
                row.style.display = "none"; 
            }
        });
    }
    window.onload = filterPrices;
</script>
</html>
