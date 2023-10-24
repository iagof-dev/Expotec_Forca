<?php

require_once(__DIR__ . "/model/database.php");
$db = new db();
$ranking = $db->getRanking();

foreach($ranking as $value){
    echo($value['nome'] . " - " . $value['pontuacao'] . "<br>");
}

?>

<a href="/index.php"><button class="btn btn-primary">Voltar</button></a>



<link rel="stylesheet" href="forca.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
