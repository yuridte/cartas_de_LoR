<?php
require_once("header.php"); //cabeçalho do site
?>
<div id="background-video" class="intern-pages-video-bg">
    <video autoplay loop autobuffer muted playsinline src="video/<?= $splash_video ?>" id="bg-video"></video>
</div>

<div class="container-fluid margem-top-150">
    <div class="row justify-content-md-center">
        <div class="col-md-6 cadastro-box">

            <?php 
            if (isset($_GET['msg'])) {
                switch ($_GET['msg']) {
                    case 'ok':
                        echo '<div class="alert alert-success" role="alert">
                                Enviado com sucesso!
                            </div>';
                        break;

                    case 'error':
                        echo '<div class="alert alert-danger" role="alert">
                                Erro! Por favor tente novamente.
                            </div>';
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }
            ?>
            

            <h2>Contate-nos</h2>

            <form action="http://formmail.kinghost.net/formmail.cgi" method="POST">
                <input type="hidden" name="recipient" value="contato@mestresderuneterra.com.br"> <input type="hidden" name="redirect" value="http://www.mestresderuneterra.com.br/contact.php?msg=ok"> 
                <input type="hidden" name="subject" value="Mensagem de Contato"> 
                <input type="hidden" name="email" value="contato@mestresderuneterra.com.br">

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome">
                </div>
                <div class="form-group">
                    <label for="replyto">E-mail</label>
                    <input type="text" class="form-control" name="replyto">
                </div>
                <div class="form-group">
                    <label for="Comentarios">Mensagem</label>
                    <textarea type="text" class="form-control" name="Comentarios"></textarea>
                </div>

                <input type="submit" class="btn btn-primary" value="Enviar">
            </form>

        </div>
    </div>
</div>

<?php
require_once("footer.php"); //rodapé do site
?>