<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Default page for Orion</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.1/css/mdb.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <style>
            @import url('https://fonts.googleapis.com/css?family=Poppins&display=swap');

            * {
                font-family: 'Poppins', sans-serif;
            }

            section {
                height: 100vh;
            }
            a {
                margin-left: 10px;
                margin-right: 10px;
            }
        </style>
    </head>
    <body>

        <main class="container">

            <?= $content ?>

        </main>
        
    </body>
</html>