var largura = 0
var altura = 0
var vidas = 1
var tempo = 10

var criaMosquitoTempo = 1500

var nivel = window.location.search.replace('?', '')

if (nivel === 'facil') {
    criaMosquitoTempo = 1500
} else if (nivel === 'medio') {
    criaMosquitoTempo = 1000
} else if (nivel === 'dificil') {
    criaMosquitoTempo = 750
}


function ajustarTamanhoJogo() {
    largura = window.innerWidth
    altura = window.innerHeight
}

ajustarTamanhoJogo()

var cronometro = setInterval(function () {
    tempo -= 1

    if (tempo < 0) {
        clearInterval(criaMosquito)
        clearInterval(cronometro)
        window.location.href = 'vitoria.html'
    } else {
        document.getElementById('cronometro').innerHTML = tempo
    }

}, 1000)

function posicaoRandomica() {
    if (document.getElementById('mosquito')) {
        document.getElementById('mosquito').remove()

        if (vidas > 3) {
            return window.location.href = 'fim_de_jogo.html'
        } else {
            document.getElementById('v' + vidas).src = "imagens/coracao_vazio.png"
            vidas++
        }
    }

    var posicaoX = Math.floor(Math.random() * largura)
    var posicaoY = Math.floor(Math.random() * altura)

    var mosquito = document.createElement('img')
    mosquito.src = 'imagens/mosquito.png'

    var tamanho = tamanhoAleatorio()
    mosquito.className = tamanho[0] + ' ' + ladoAleatorio()

    posicaoX = posicaoX >= largura - tamanho[1] ? largura - tamanho[1] : posicaoX
    posicaoY = posicaoY >= altura - tamanho[1] ? altura - tamanho[1] : posicaoY

    mosquito.style.left = posicaoX + 'px'
    mosquito.style.top = posicaoY + 'px'
    mosquito.style.position = 'absolute'
    mosquito.id = 'mosquito'
    mosquito.onclick = function () {
        this.remove()
    }

    document.body.appendChild(mosquito)
}

function tamanhoAleatorio() {
    var classe = Math.floor(Math.random() * 3)
    switch (classe) {
        case 0:
            return ['mosquito1', 50]
        case 1:
            return ['mosquito2', 70]
        case 2:
            return ['mosquito3', 90]
    }
}

function ladoAleatorio() {
    var classe = Math.floor(Math.random() * 2)
    switch (classe) {
        case 0:
            return 'ladoA'
        case 1:
            return 'ladoB'
    }
}