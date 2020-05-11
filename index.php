<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mestres de Runeterra</title>
    <!-- CSS Styles -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/home.css">
    <style>
        .container-content div{
            position: relative;
            text-align: center;
        }
        .container-content div img{
            height: 60px;
            margin: 30px 20px;
        }
    </style>
</head>
<body>
    <div id="background-video">
        <div class="overlay bg-blue"></div>
        <video src="video/bilgewater-splashvideo.webm" autoplay loop></video>
    </div>
    <div class="container-content">
        <div id="embreve">
            <h1 data-heading="Em breve!" contenteditable>Em breve!</h1>
            <h2>Mestres de Runeterra</h2>
            <a href="https://www.facebook.com/mestresderuneterra"><img src="img/fb-ico.png" alt="Facebook"/></a>
            <a href="https://www.instagram.com/mestresderuneterra/"><img src="img/insta-ico.png" alt="Facebook"/></a>
            <a href="https://www.facebook.com/mestresderuneterra"><img src="img/yt-ico.png" alt="Facebook"/></a>
        </div>
    </div>
    <script>
    var h1 = document.querySelector("h1");
    h1.addEventListener("input", function() {
        this.setAttribute("data-heading", this.innerText);
    });

    // CENTRALIZANDO O EM BREVE
    var div = "embreve"; /*Informamos o nome da DIV.*/     
    
    var alturaTela  = screen.height; /*Atribuimos a variável alturaTela a resolução em Y altura da tela.*/
    var larguraTela = screen.width;  /*Atribuimos a variável larguraTela a resolução em X da tela.*/

    var widthDIV  = (document.getElementById(div).offsetWidth / 2) + 73; /*Atribuimos a variável widthDIV a largura da nossa DIV.*/
    var heightDIV = document.getElementById(div).offsetHeight; /*Atribuimos a variável heightDIV a altura da nossa DIV.*/

    var posicaoX = (larguraTela / 2) - (widthDIV  / 2) ; /*Explicado logo abaixo.*/
    var posicaoY = (alturaTela  / 2) - (heightDIV / 2); /*A mesma explicação acima para largura se aplica aqui.*/
    
    document.getElementById(div).style.width  = widthDIV  + "px"; /*Através do Javascript acessamos a propriedade width do CSS e aplicamos a ela o valor em width para nossa DIV, este valor é especificado na variável widthDIV.*/
    document.getElementById(div).style.height = heightDIV + "px"; /*A mesma explicação para widthDIV se aplica aqui, porém aqui é atribuido o valor para altura, heightDIV.*/
    
    /*Através do document.getElementById() conseguimos acessar um objeto em nosso documento e ter acesso as suas propriedades.*/
    
    /*No bloco de código abaixo que a mágica acontece, acessamos a propriedade top e left e atribuimos os respectivos valores de nossos cálculos para o posicionamento em tela.*/
    
    document.getElementById(div).style.top  = posicaoY + "px"; /*Posição da tela referente ao eixo X.*/
    document.getElementById(div).style.left = posicaoX + "px"; /*Posição da tela referente ao eixo Y.*/
    </script>
</body>
</html>