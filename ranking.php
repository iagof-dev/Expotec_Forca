

<html>

    <head>
    <link rel="stylesheet" href="forca.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    </head>

    <body>

    <style>
        body{
            font-size: 40px;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        section {
            width: fit-content;
            margin: auto;
            background-color: white;
            padding: 2rem;
            border-radius: 1rem;
            margin-block: auto;
        }
    </style>

    <section>

    <h1>Pontuação:</h1><br>
    <?php

        require_once(__DIR__ . "/model/database.php");
        $db = new db();
        $ranking = $db->getRanking();

        if(!empty($ranking) || isset($ranking)){
            

        foreach($ranking as $value){
            echo($value['nome'] . " - " . $value['pontuacao']. "<br>");
        }
    }


    ?>

    <hr>

    <a href="./index.php"><button class="btn btn-primary">Voltar</button></a>


    </section>
    </body>
</html>
