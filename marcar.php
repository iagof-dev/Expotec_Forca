<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
ob_start();

require_once(__DIR__ . "/model/jogador.php");
$nome = (new player())->getName();

if (empty($nome) || !isset($nome)) {
    header("Location: index.php");
}

require_once(__DIR__ . "/model/database.php");
$db = new db();
$score = 0;

$perdeu = $_GET['perdeu'];

if (empty($_GET['score']) || !isset($_GET['score'])) {
    $score = (new player())->getScore();
} else {
    $score = (new player())->getScore() + $_GET['score'];
}

if ($perdeu == 'true') {
    echo ('perdeu');
    try {
        $db->registrarPontuacao($nome, $score);
    } catch (Exception $e) {
        echo ("Não foi possivel registrar pontuação!\n" . $e->getMessage());
    }
    session_destroy();
    header("Location: index.php");
} else {
    //echo ('não perdeu');
    (new player())->setScore($score);
    header("Location: game.php");
}
