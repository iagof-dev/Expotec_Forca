let jogarNovamente = true;
let tentativas = 6;
let listaDinamica = [];
let palavraSecretaCategoria;
let palavraSecretaSorteada;
let palavras = [];
let jogoAutomatico = true;

let pontuacao = 0;

let running = false;
let seconds = 0;
let minutes = 0;
let hours = 0;
let interval;
carregaListaAutomatica();

criarPalavraSecreta();

function criarPalavraSecreta() {
  const indexPalavra = parseInt(Math.random() * palavras.length);

  palavraSecretaSorteada = palavras[indexPalavra].nome;
  palavraSecretaCategoria = palavras[indexPalavra].categoria;

  // console.log(palavraSecretaSorteada);
}

montarPalavraNaTela();
startStop();

function montarPalavraNaTela() {
  const categoria = document.getElementById("categoria");
  categoria.innerHTML = palavraSecretaCategoria;

  const palavraTela = document.getElementById("palavra-secreta");
  palavraTela.innerHTML = "";

  for (i = 0; i < palavraSecretaSorteada.length; i++) {
    if (listaDinamica[i] == undefined) {
      if (palavraSecretaSorteada[i] == " ") {
        listaDinamica[i] = " ";
        palavraTela.innerHTML =
          palavraTela.innerHTML +
          "<div class='letrasEspaco'>" +
          listaDinamica[i] +
          "</div>";
      } else {
        listaDinamica[i] = "&nbsp;";
        palavraTela.innerHTML =
          palavraTela.innerHTML +
          "<div class='letras'>" +
          listaDinamica[i] +
          "</div>";
      }
    } else {
      if (palavraSecretaSorteada[i] == " ") {
        listaDinamica[i] = " ";
        palavraTela.innerHTML =
          palavraTela.innerHTML +
          "<div class='letrasEspaco'>" +
          listaDinamica[i] +
          "</div>";
      } else {
        palavraTela.innerHTML =
          palavraTela.innerHTML +
          "<div class='letras'>" +
          listaDinamica[i] +
          "</div>";
      }
    }
  }
}

function verificaLetraEscolhida(letra) {
  document.getElementById("tecla-" + letra).disabled = true;
  if (tentativas > 0) {
    mudarStyleLetra("tecla-" + letra, false);
    comparalistas(letra);
    montarPalavraNaTela();
  }
}

function mudarStyleLetra(tecla, condicao) {
  if (condicao == false) {
    document.getElementById(tecla).style.background = "#C71585";
    document.getElementById(tecla).style.color = "#ffffff";
  } else {
    document.getElementById(tecla).style.background = "#008000";
    document.getElementById(tecla).style.color = "#ffffff";
  }
}

function comparalistas(letra) {
  const pos = palavraSecretaSorteada.indexOf(letra);
  if (pos < 0) {
    tentativas--;
    carregaImagemForca();

    if (tentativas == 0) {
      abreModal(
        "OPS!",
        "Não foi dessa vez ... A palavra secreta era <br>" +
          palavraSecretaSorteada
      );
      piscarBotaoJogarNovamente(true);
    }
  } else {
    pontuacao += 5;
    mudarStyleLetra("tecla-" + letra, true);
    for (i = 0; i < palavraSecretaSorteada.length; i++) {
      if (palavraSecretaSorteada[i] == letra) {
        listaDinamica[i] = letra;
      }
    }
  }

  let vitoria = true;
  for (i = 0; i < palavraSecretaSorteada.length; i++) {
    if (palavraSecretaSorteada[i] != listaDinamica[i]) {
      vitoria = false;
    }
  }

  if (vitoria == true) {
    pontuacao += 500;
    abreModal("PARABÉNS!", "Você venceu...");
    //piscarBotaoJogarNovamente(true);
  }
}

// async function piscarBotaoJogarNovamente(){
//     while (jogarNovamente == true) {
//         document.getElementById("btnReiniciar").style.backgroundColor = 'red';
//         document.getElementById("btnReiniciar").style.scale = 1.3;
//         await atraso(500)
//         document.getElementById("btnReiniciar").style.backgroundColor = 'yellow';
//         document.getElementById("btnReiniciar").style.scale = 1;
//         await atraso(500)
//     }
// }

async function atraso(tempo) {
  return new Promise((x) => setTimeout(x, tempo));
}

function carregaImagemForca() {
  switch (tentativas) {
    case 5:
      document.getElementById("imagem").style.background =
        "url('./img/forca01.png')";
      break;
    case 4:
      document.getElementById("imagem").style.background =
        "url('./img/forca02.png')";
      break;
    case 3:
      document.getElementById("imagem").style.background =
        "url('./img/forca03.png')";
      break;
    case 2:
      document.getElementById("imagem").style.background =
        "url('./img/forca04.png')";
      break;
    case 1:
      document.getElementById("imagem").style.background =
        "url('./img/forca05.png')";
      break;
    case 0:
      document.getElementById("imagem").style.background =
        "url('./img/forca06.png')";
      break;
    default:
      document.getElementById("imagem").style.background =
        "url('./img/forca.png')";
      break;
  }
}

function abreModal(titulo, mensagem) {
  let modalTitulo = document.getElementById("exampleModalLabel");
  modalTitulo.innerText = titulo;

  let modalBody = document.getElementById("modalBody");
  modalBody.innerHTML = mensagem;

  $("#myModal").modal({
    show: true,
  });
}

let bntReiniciar = document.querySelector("#btnReiniciar");
bntReiniciar.addEventListener("click", function () {
  jogarNovamente = false;
  location.reload();
});

function listaAutomatica() {
  // ativa o modo manual
  if (jogoAutomatico == true) {
    document.getElementById("jogarAutomatico").innerHTML =
      "<i class='bx bx-play-circle'></i>";
    palavras = [];
    jogoAutomatico = false;

    document.getElementById("abreModalAddPalavra").style.display = "block";
    document.getElementById("status").innerHTML = "Modo Manual";
  } else if (jogoAutomatico == false) {
    // ativa o modo automático
    document.getElementById("jogarAutomatico").innerHTML =
      "<i class='bx bx-pause-circle'></i>";
    jogoAutomatico = true;

    document.getElementById("abreModalAddPalavra").style.display = "none";
    document.getElementById("status").innerHTML = "Modo Automático";
  }
}

const modal = document.getElementById("modal-alerta");

const btnAbreModal = document.getElementById("abreModalAddPalavra");
btnAbreModal.onclick = function () {
  modal.style.display = "block";
};

const btnFechaModal = document.getElementById("fechaModal");
btnFechaModal.onclick = function () {
  modal.style.display = "none";
  document.getElementById("addPalavra").value = "";
  document.getElementById("addCategoria").value = "";
};

window.onclick = function () {
  if (event.target == modal) {
    modal.style.display = "none";
    document.getElementById("addPalavra").value = "";
    document.getElementById("addCategoria").value = "";
  }
};

function carregaListaAutomatica() {
  palavras = [
    (palavra001 = {
      nome: document.getElementById('secret-word').innerText.toUpperCase(),
      categoria: document.getElementById('secret-cat').innerText.toUpperCase(),
    })
  ];
}

function adicionarPalavra() {
  let addPalavra = document.getElementById("addPalavra").value.toUpperCase();
  let addCategoria = document
    .getElementById("addCategoria")
    .value.toUpperCase();

  if (
    isNullOrWhiteSpace(addPalavra) ||
    isNullOrWhiteSpace(addCategoria) ||
    addPalavra.length < 3 ||
    addCategoria.length < 3
  ) {
    abreModal("ATENÇÃO", " Palavra e/ou Categoria inválidos");
    return;
  }

  let palavra = {
    nome: addPalavra,
    categoria: addCategoria,
  };

  palavras.push(palavra);
  sortear();

  document.getElementById("addPalavra").value = "";
  document.getElementById("addCategoria").value = "";
}

function isNullOrWhiteSpace(input) {
  return !input || !input.trim();
}

function sortear() {
  if (jogoAutomatico == true) {
    location.reload();
  } else {
    if (palavras.length > 0) {
      listaDinamica = [];
      criarPalavraSecreta();
      montarPalavraNaTela();
      resetaTeclas();
      tentativas = 6;
      piscarBotaoJogarNovamente(false);
    }
  }
}

function resetaTeclas() {
  let teclas = document.querySelectorAll(".teclas > button");
  teclas.forEach((x) => {
    x.style.background = "#FFFFFF";
    x.style.color = "#8B008B";
    x.disabled = false;
  });
}

async function piscarBotaoJogarNovamente(querJogar) {
  if (querJogar) {
    document.getElementById("jogarNovamente").style.display = "block";
  } else {
    document.getElementById("jogarNovamente").style.display = "none";
  }
}



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
    console.log(tempo);
    startStop()
    window.location.href = "./marcar.php"
}


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

             

function redirecionar() {
    //console.log("tentavias: " + tentativas);
  if (tentativas <= 0) {
    //console.log("caiu aqui, perdeu");
    window.location.href = "./marcar.php?perdeu=true&score=" + pontuacao;
  } 
  if(tentativas > 0){
    //console.log("caiu aqui, não perdeu");
    window.location.href = "./marcar.php?perdeu=false&score=" + pontuacao;
  }
}


function Desistir(){
  window.location.href = "./marcar.php?perdeu=true&score=" + pontuacao;
}
