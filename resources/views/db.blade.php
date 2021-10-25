<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>DB</h1>
@foreach ($practice as $item)
    <h1>first name:{{ $item->first_name}}</h1>
    <h1>lastname: {{ $item->lastname }}</h1>
    <h1>first name:{{ $item->city}}</h1>
    <hr>
@endforeach

</body>
</html>