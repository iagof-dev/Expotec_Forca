<?php
session_start();
ob_start();
require_once(__DIR__ . "/model/jogador.php");

$nome = (new player())->getName();

if(empty($nome) || !isset($nome)){
    header("Location: index.php");
}

if(!empty($_GET['score']) || isset($_GET['score'])){
    (new player())->setScore($_GET['score']);
    header("Location: game.php");
}

require_once(__DIR__ . "/model/database.php");

$palavra = (new db())->getRandomWord();

?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./forca.css" media="screen">
    <link rel="shortcut icon" href="./img/forca06.png" type="image/x-icon">
 
    <title>Jogo da Forca</title>
</head>
<body>
    <div class="container">
        <div id="imagem"></div>

        <div id="palavra-secreta">
            <!-- <div class="letras">A</div>
            <div class="letras">F</div>
            <div class="letras">G</div>
            <div class="letras">A</div>
            <div class="letras">S</div>
            <div class="letras">M</div> -->
        </div>

        <div id="teclado">
            <div class="teclas">
                <button id="tecla-A" onclick="verificaLetraEscolhida('A')">A</button>
                <button id="tecla-B" onclick="verificaLetraEscolhida('B')">B</button>
                <button id="tecla-C" onclick="verificaLetraEscolhida('C')">C</button>
                <button id="tecla-D" onclick="verificaLetraEscolhida('D')">D</button>
                <button id="tecla-E" onclick="verificaLetraEscolhida('E')">E</button>
                <button id="tecla-F" onclick="verificaLetraEscolhida('F')">F</button>
                <button id="tecla-G" onclick="verificaLetraEscolhida('G')">G</button>
                <button id="tecla-H" onclick="verificaLetraEscolhida('H')">H</button>
                <button id="tecla-I" onclick="verificaLetraEscolhida('I')">I</button>
            </div>
            <div class="teclas">
                <button id="tecla-J" onclick="verificaLetraEscolhida('J')">J</button>
                <button id="tecla-K" onclick="verificaLetraEscolhida('K')">K</button>
                <button id="tecla-L" onclick="verificaLetraEscolhida('L')">L</button>
                <button id="tecla-M" onclick="verificaLetraEscolhida('M')">M</button>
                <button id="tecla-N" onclick="verificaLetraEscolhida('N')">N</button>
                <button id="tecla-O" onclick="verificaLetraEscolhida('O')">O</button>
                <button id="tecla-P" onclick="verificaLetraEscolhida('P')">P</button>
                <button id="tecla-Q" onclick="verificaLetraEscolhida('Q')">Q</button>
                <button id="tecla-R" onclick="verificaLetraEscolhida('R')">R</button>
            </div>
            <div class="teclas">
                <button id="tecla-S" onclick="verificaLetraEscolhida('S')">S</button>
                <button id="tecla-T" onclick="verificaLetraEscolhida('T')">T</button>
                <button id="tecla-U" onclick="verificaLetraEscolhida('U')">U</button>
                <button id="tecla-V" onclick="verificaLetraEscolhida('V')">V</button>
                <button id="tecla-W" onclick="verificaLetraEscolhida('W')">W</button>
                <button id="tecla-X" onclick="verificaLetraEscolhida('X')">X</button>
                <button id="tecla-Y" onclick="verificaLetraEscolhida('Y')">Y</button>
                <button id="tecla-Z" onclick="verificaLetraEscolhida('Z')">Z</button>
                <button id="btnReiniciar">✨</button>
            </div>
        </div>

        <div id="categoria">
            <!-- CATEGORIA -->
        </div>

        <!-- inicio modal Bootstrap-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button onclick="redirecionar();" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" id="modalBody"></div>
                <div class="modal-footer">
                <a>
                    <button onclick="redirecionar();" style="background-color: purple !important; border-color:  purple !important;" type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </a> 
            </div>
            </div>
            </div>
        </div>
        <!-- fim modal Bootstrap--> 


        <!--TEMPO-->

    <div id="display">00:00:00</div>

    
    <script>
        let running = false;
        let seconds = 0;
        let minutes = 0;
        let hours = 0;
        let interval;
    
        function startStop() {
            if (running) {
                clearInterval(interval);
                document.getElementById("startStop").textContent = "Iniciar";
            } else {
                interval = setInterval(updateDisplay, 1000);
                document.getElementById("startStop").textContent = "Parar";
            }
            running = !running;
        }

        function checkForm(){
            const tempo = document.querySelector("div#display").innerHTML
            startStop()
        }

        startStop()
    
        function updateDisplay() {
            seconds++;
            if (seconds === 60) {
                seconds = 0;
                minutes++;
                if (minutes === 60) {
                    minutes = 0;
                    hours++;
                }
            }
    
            const display = document.getElementById("display");
            display.textContent = formatTime(hours) + ":" + formatTime(minutes) + ":" + formatTime(seconds);
        }
    
        function formatTime(time) {
            return time < 10 ? "0" + time : time;
        }
    
        function reset() {
            clearInterval(interval);
            running = false;
            seconds = 0;
            minutes = 0;
            hours = 0;
            document.getElementById("display").textContent = "00:00:00";
            document.getElementById("startStop").textContent = "Iniciar";
        }

                        
    </script>
        </form>  



        <!-- Modal Adicionar Palavra -->
        <div id="modal-alerta" class="modal-container">
            <div class="modal-add-palavra">
                <div class="modal-header-add-palavra" id="modal-titulo">
                    <span id="fechaModal" class="close">&times;</span>
                    <h2>ADICIONAR PALAVRA</h2>
                </div>
                <div class="modal-body-add-palavra" id="modal-mensagem">
                    <input id="addPalavra" type="text" placeholder="PALAVRA" required>
                    <input id="addCategoria" type="text" placeholder="CATEGORIA" required>
                    <button onclick="adicionarPalavra()">Adicionar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- <div id="status">Modo Automático</div>
    <button id="abreModalAddPalavra"><i class='bx bx-message-square-add'></i></button> -->
    <!-- <img src="img/jogarNovamente.gif" id="jogarNovamente"></img>  -->


<?php

echo('<h1 style="display: none;">sw: <span id="secret-word">'. $palavra['0']['palavra']. '</span></h1><br>');
echo('<h1 style="display: none;">sc: <span id="secret-cat">'. $palavra['0']['categoria']. '</h1></span>');



?>

<script src="./forca.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</body>
</html>