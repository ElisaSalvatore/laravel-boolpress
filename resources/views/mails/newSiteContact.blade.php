<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Nuovo messaggio ricevuto dal form Contatti!</h1>

    {{-- @dump($newContactInfo) --}}
    <ul>
        <li><strong>Nome utente:</strong> {{ $newContactInfo->name }} </li>
        <li><strong>Indirizzo email:</strong> {{ $newContactInfo->email }} </li>
        <li><strong>Messaggio:</strong> {{ $newContactInfo->message }} </li>
    </ul>
</body>
</html>