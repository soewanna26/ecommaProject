<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Mail</title>
</head>

<body>
    <h1>{{ $mailData['name'] }}</h1>

    <p> Your Price : {{ $mailData['price'] }}</p>

    <p> Your Buy Product : {{ $mailData['productTitle'] }}</p>

    <p>Your Quantity : {{ $mailData['quantity'] }}</p>

    <p>Thank you</p>
</body>

</html>
