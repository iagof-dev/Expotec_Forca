<?php
error_reporting(0);
session_destroy();
session_start();
ob_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once(__DIR__ . "/model/jogador.php");
    (new player())->setName($_POST['username']);
    echo('<script>alert("Boa sorte '. (new player())->getName() .'!")</script>');
    header("Location: game.php");
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Registro</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap');

        body {
            font-family: 'Ubuntu', sans-serif;
            background-image: url(./img/FUNDO.jpg);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            border-radius: 6px;
        }

        .box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border-radius: 8px;
            color:black;
            background-color: purple;
        }

        button, input[type="submit"] {
            color:white;
            background-color: purple;
            padding: 10px 125px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.5s
        }
       

        button:hover, input[type="submit"]:hover {
            background-color: plum;
        }
        #nome{
            background-color:white;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <div class="box">
    <form id="registrationForm" action="./index.php" method="post">
        <label>Nome de Usuário:</label>
        <input id="nome" type="text" name="username" required>
        <input class="btn btn-primary" type="submit" value="Registrar">
    </form>
    <a href="ranking.php"><button class="btn btn-primary" >Ranking</button></a>
    </div>
    
</body>
</html>
