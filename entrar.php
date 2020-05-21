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
                if(isset($_GET['return_path'])){
                    echo '<input type="hidden" name="return_path" id="return_path" value="' . $_GET['return_path'] . '">';
                }
                ?>

                <label for="email">E-mail</label>
                <input type="text" name="email" id="email">

                <label for="password">Senha</label>
                <input type="password" name="password" id="password">

                <input type="submit" value="Cadastrar-se">
            </form>
        </div>
    </div>
</div>

<?php
require_once("footer.php"); //rodapé do site
?>