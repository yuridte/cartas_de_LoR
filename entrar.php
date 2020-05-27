<?php
require_once("header.php"); //cabeçalho do site
?>
<div id="background-video" class="intern-pages-video-bg">
    <video autoplay loop autobuffer muted playsinline src="video/<?= $splash_video ?>" id="bg-video"></video>
</div>


<div class="container-fluid margem-top-150">
    <div class="row justify-content-md-center">
        <div class="col-md-6 cadastro-box">
            <form action="iniciar_sessao.php" method="post">

                <?php 
                if (isset($_GET['msg'])) {
                    switch ($_GET['msg']) {
                        case 'ok':
                            echo '<div class="alert alert-success" role="alert">
                                    Login realizado com sucesso!
                                </div>';
                            break;

                        case 'error':
                            echo '<div class="alert alert-danger" role="alert">
                                    Erro! Por favor certifique-se que os seus dados de acesso foram inseridos corretamente.
                                </div>';
                            break;

                        case 'logout':
                            echo '<div class="alert alert-warning" role="alert">
                                    Você saiu da sua conta! Até logo &#128521;
                                </div>';
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                }


                if(isset($_GET['return_path'])){
                    echo '<input type="hidden" name="return_path" id="return_path" value="' . $_GET['return_path'] . '">';
                }
                ?>

                <h2>Entrar</h2>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <input type="submit" class="btn btn-primary" value="Entrar"><br><br>
                <div class="text-right">
                    <a href="cadastro.php">Clique aqui para se cadastrar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once("footer.php"); //rodapé do site
?>