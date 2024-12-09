<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Pateicamies par Jūsu pasūtījumu, {{ $name }}!</h1>
    <p>Pasūtījuma detaļas</p>
    <p><strong>Pasūtījuma ID:</strong> {{ $orderId }}</p>
    <p><strong>Cena:</strong> €{{ number_format($totalAmount, 2) }}</p>
</body>
</html>
