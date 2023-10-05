<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presto.it</title>
</head>
<body>
    <div>
        <h1>Un  utente ha richiesto di diventare revisore</h1>
        <h2>Questi sono i suoi dati</h2>
        <p>Nome : {{$user->name}}</p>
        <p>Email: {{$user->email}}</p>
        <p>Messaggio: {{$formMessage}}</p>
        <p>Se vuoi accettare la richiesta clicca qui:</p>
        <a href="{{route('make.revisor',compact('user'))}}">Rendi revisore</a>
    </div>
</body>
</html>