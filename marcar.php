<?php
session_start();
ob_start();

require_once(__DIR__ . "/model/jogador.php");
$nome = (new player())->getName();

if(empty($nome) || !isset($nome)){
    header("Location: index.php");
}

$score = 0;
require_once(__DIR__ . "/model/database.php");
$db = new db();


if(empty($_GET['score']) || !isset($_GET['score'])){
    $score = (new player())->getScore();
    // echo('jogou varias:' . (new player())->getScore() . '<br>');
}
else{
    $score = (new player())->getScore() + $_GET['score'];
    // echo('Jogou varias: '. (new player())->getScore() . '<br>');
    // echo('Jogou 1: '.$_GET['score']. '<br>');

}



$db->registrarPontuacao($nome, $score);

header("Location: index.php");