<?php
require_once("check_sessao.php"); //check login
require_once("header.php"); //cabeçalho do site
?>

<div class="banner banner-deck-creator">
    <h1>Criador de decks</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 text-center">
            <?php 
            if (isset($_GET['msg'])) {
                switch ($_GET['msg']) {

                    case 'error_code':
                        echo '<div class="alert alert-danger" role="alert">
                                Erro! Código inválido.
                            </div>';
                        break;

                    case 'error':
                        echo '<div class="alert alert-danger" role="alert">
                                Erro! Por favor tente novamente.
                            </div>';
                        break;
                }
            }
            ?>

        </div>
    </div>
</div>

<div class="container-fluid margem-top-80">
    <div class="row justify-content-md-center">
        <div class="col-md-6 cadastro-box">
            <form action="cadastrar_deck.php" method="post">
                <input type="hidden" name="owner_id" id="owner_id" value="<?php echo $_COOKIE['id']; ?>"/>

                <div class="form-group">
                    <label for="name">Título</label><br/>
                    <input type="text" class="form-control" name="name" id="name"><br/><br/>
                </div>

                <div class="form-group">
                    <label for="code">Código</label><br/>
                    <input type="text" class="form-control" name="code" id="code"><br/><br/>
                </div>

                <div class="form-group">
                    <label for="code">Arquétipo</label><br/>
                    <select class="form-control" name="archetype" id="archetype">
                        <option value="indefinido">Não sei</option>
                        <option value="agressivo">Agressivo (Aggro)</option>
                        <option value="combo">Combo</option>
                        <option value="controle">Controle</option>
                        <option value="midrange">Midrange</option>
                    </select>
                    <br/><br/>
                </div>

                <div class="form-group">
                    <label for="tags">Adicione tags separadas por vírgula</label><br/>
                    <input type="text" class="form-control" name="tags" id="tags"><br/><br/>
                </div>

                <div class="form-group">
                    <label for="description">Descrição</label><br/>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="7" placeholder="Opcional"></textarea>
                </div>
                
                <br/><br/>

                <input type="submit" class="btn btn-primary" value="SALVAR">
            </form>
        </div>
    </div>
</div>

<?php
require_once("footer.php"); //rodapé do site
?>