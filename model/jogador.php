<?php

class player{
    function setName($nome){
        $_SESSION['jogador'] = $nome;
    }

    function getName(){
        return $_SESSION['jogador'];
    }

    function setScore($score){
        $_SESSION['score'] += $score;
    }

    function getScore(){
        return $_SESSION['score'];
    }
}