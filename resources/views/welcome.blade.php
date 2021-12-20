<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CRUD Generator</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script
                src="https://code.jquery.com/jquery-3.6.0.js"
                integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
                crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html,
            body {
                height: 100%;
            }

            .container {
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .btn{
                height: 7em;
                width: 40em;
            }


        </style>

        <style>
            body {
                font-family: 'Serif', sans-serif;
            }
            a{

                font-size: 40px;
            }
        </style>
    </head>
    <body class="antialiased">
    <div class="container">

           <a href="{{route('login')}}" class="btn btn-primary"><h1>Start Creating CRUD!</h1></a>

    </div>

    </body>
</html>
