<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Treclon</title>
    <link href=" {{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    mkk
    <div id="app">
        <App></App>
    </div>
    <script src="{{ mix('js/app.js') }}"></script> 
</body>
</html>
