<?php

class player{
    function setName($nome){
        $_SESSION['jogador'] = $nome;
        $_SESSION['time_played_h'] = 0;
        $_SESSION['time_played_m'] = 0;
        $_SESSION['time_played_s'] = 0;
    }

    function getName(){
        return $_SESSION['jogador'];
    }

    function setScore($score){
        $_SESSION['score'] += $score;
    }

    function getScore(){
	if(empty($_SESSION['score']) || !isset($_SESSION['score'])){
		$_SESSION['score'] = 0;
	}
        return $_SESSION['score'];
    }

    function getTime(){
        return $_SESSION['time_played_h'] . ":". $_SESSION['time_played_m'].":".$_SESSION['time_played_s'];
    }
    function setTime($h, $m, $s){
        $_SESSION['time_played_h'] += $h;
        $_SESSION['time_played_m'] += $m;
        $_SESSION['time_played_s'] += $s;
    }
}
