
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <!-- Plugins sociais -->
            <div class="col-md-12 share-box">
                <h3>Gostou da página? Compartilhe com seus amigos ...</h3>

                <!-- facebook -->
                <a id="facebook-Link" type="button" class="share-button facebook-share-button" href="https://www.facebook.com/sharer.php?u=<?= $url_atual ?>" target="_new">
                        <i class="fab fa-facebook"></i> Compartilhar no Facebook
                </a>
                <script type="text/javascript">
                    $('#facebook-Link').click(function () {
                        window.open($(this).attr('href'), 'sharer', 'width=626,height=436');
                        return false;
                    });
                </script>


                <!-- twitter -->
                <?php
                    $title = 'Mestres de Runeterra';
                    $short_url = $url_atual;
                    $url = $url_atual;
                    $twitter_params = 
                    '?text=' . urlencode($title) . '+-' .
                    '&amp;url=' . urlencode($short_url) . 
                    '&amp;counturl=' . urlencode($url) .
                    '';

                    $link = "http://twitter.com/share" . $twitter_params . "";
                ?>

                <a class="share-button twitter-share-button" type="button" href="<?php echo $link; ?>" target="_new"><i class="fab fa-twitter"></i> Compartilhar no Twitter</a>

                <!-- Pinterest -->
                <!-- <a href="http://pinterest.com/pin/create/button/?url=<?= $url_atual ?>&media=<?= $imagem_share ?>" type="button" target="_new" class="share-button pinterest-share-button">
                    <i class="fab fa-pinterest"></i> Marcar no Pinterest
                </a> -->


                <!-- whatsapp -->
                <a href="" id="whatsapp-share-btt" rel="nofollow" target="_blank" type="button" class="share-button whatsapp-share-button"><i class="fab fa-whatsapp"></i> Enviar via WhatsApp</a>
                
                <script type="text/javascript">
                    //Constrói a URL depois que o DOM estiver pronto
                    document.addEventListener("DOMContentLoaded", function() {
                        //conteúdo que será compartilhado: Título da página + URL
                        var conteudo = encodeURIComponent(document.title + " " + window.location.href);
                        //altera a URL do botão
                        document.getElementById("whatsapp-share-btt").href = "https://api.whatsapp.com/send?text=" + conteudo;
                    }, false);
                </script>


            </div>
            
        </div>
    </div>
</div>