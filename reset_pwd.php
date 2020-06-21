<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php"); //cabeçalho do site
?>
<div id="background-video" class="intern-pages-video-bg">
    <video autoplay loop autobuffer muted playsinline src="video/<?= $splash_video ?>" id="bg-video"></video>
</div>


<div class="container-fluid margem-top-150">
    <div class="row justify-content-md-center">
        <div class="col-md-6 cadastro-box">
            <form action="" method="post">

                <?php 
                if (isset($_POST['email'])) {
                    $sql_verificar = "SELECT id FROM user WHERE email LIKE '" . $_POST['email'] . "';";
                    $check_email = $dbConn->query($sql_verificar)->fetchAll();
                    $contador = count($check_email);

                    if ($contador > 0) {
                        $chave = md5(time()); //key
                        $email_remetente = "contato@mestresderuneterra.com.br";
                        $email_destinatario = $_POST['email'];
                        $email_assunto = "REDEFINIÇÃO DE SENHA";
                        $email_reply = $email_remetente;
                        // Corpo do texto
                        $email_conteudo = "<h1>Clique no link abaixo para redefinir senha</h1> \n";  
                        $email_conteudo .= "<a href='https://mestresderuneterra.com.br/reset_pwd.php?e=" . $email_destinatario . "&t=" . $chave . "'>https://mestresderuneterra.com.br/reset_pwd.php?e=" . $email_destinatario . "&t=" . $chave . "</a> \n";
                        $email_conteudo .= "<p>Caso não tenha solicitado a restauração de senha, por favor, ignore este e-mail.</p>";

                        $email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Return-Path: $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );

                        if (mail($email_destinatario, $email_assunto, nl2br($email_conteudo), $email_headers)){
                            echo "</b>E-Mail enviado com sucesso!</b>"; 
                            $sql_update = "UPDATE user SET token = '" . $chave . "' WHERE email = '" . $_POST['email'] . "';";
                            try {
                                $dbConn->beginTransaction();
                                $stmt = $dbConn->prepare($sql_update);
                                $stmt->execute();
                                $dbConn->commit();
                                echo '<div class="alert alert-success" role="alert">E-mail enviado!</div>';
                            } catch (Exception $e) {
                                //Roll back and show error
                                $sql_update .=  "Error: " . $e->getMessage();
                                $dbConn->rollBack();
                                echo '<div class="alert alert-danger" role="alert">Erro! Tente novamente. </div>';
                            }
                        }else{
                            echo '<div class="alert alert-danger" role="alert">Erro! Tente novamente. </div>';
                        }
                    }else{
                        echo '<div class="alert alert-danger" role="alert">Esse e-mail (' . $_POST['email'] . ') não está cadastrado.</div>';
                    }

                }elseif($_GET['t']){


                    $sql_verificar = "SELECT * FROM user WHERE email LIKE '" . $_GET['e'] . "' AND token LIKE '" . $_GET['t'] . "';";
                    $check_email = $dbConn->query($sql_verificar)->fetchAll();
                    $contador = count($check_email);

                    if ($contador > 0) {
                        $senha = md5("senha12345");

                        $sql_update = "UPDATE user SET token = '', password = '" . $senha . "' WHERE email = '" . $_GET['e'] . "';";
                        try {
                            $dbConn->beginTransaction();
                            $stmt = $dbConn->prepare($sql_update);
                            $stmt->execute();
                            $dbConn->commit();
                            echo '<div class="alert alert-success" role="alert">Sua senha foi resetada para: senha12345 <br> Entre na sua conta e altere sua senha imediatamente!</div>';
                        } catch (Exception $e) {
                            //Roll back and show error
                            $sql_update .=  "Error: " . $e->getMessage();
                            $dbConn->rollBack();
                            echo '<div class="alert alert-danger" role="alert">Erro! Tente novamente. </div>';
                        }
                    }else{
                        echo '<div class="alert alert-danger" role="alert">Erro! Tente novamente repetindo o processo. </div>';
                    }



                }else{
                ?>

                <h2>Recuperar senha</h2>
                <br>
                <h3>Você receberá o link para redefinição de senha no seu e-mail cadastrado.</h3>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>

                <input type="submit" class="btn btn-primary" value="Enviar"><br><br>
                <?php 
                }
                ?>
            </form>
        </div>
    </div>
</div>

<?php
require_once("footer.php"); //rodapé do site
?>