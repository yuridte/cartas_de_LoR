<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php");
?>

<script type="text/javascript">
    // Mudando o title
    var title_topo_atual = document.title;
    document.title = "Criadores de Conteúdo - " + title_topo_atual;
</script>

<div class="banner banner-criadores-conteudo">
    <h1>Ao Vivo</h1>
</div>

<div class="container creator-container">

    <div class="row artigo-container justify-content-center">
        <div class="col-md-9 text-center">
            <p>Essas são as streams dos nossos parceiros que estão acontecendo nesse momento na Twitch. Clique em uma miniatura para assistir.</p>
            <p>Mande um e-mail pela <a href="contact.php">página de contato</a> e anuncie sua stream gratuitamente!</p>
        </div>
    </div>
</div>

<div class="container streamers-live-box">
    <div class="row">
        <?php
        function file_get_channelcontents_curl($streamurl) {
            $streamch = curl_init();
                curl_setopt($streamch, CURLOPT_URL, $streamurl);
                curl_setopt($streamch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($streamch, CURLOPT_CUSTOMREQUEST, 'GET');

                $streamheaders = array();
                $streamheaders[] = 'Client-Id: v6j1r539pz2qqozegs1e332x8wx5no';
                $streamheaders[] = 'Authorization: Bearer o1ci6dqp4c4tcnwymdgx19smzr7aba';
                curl_setopt($streamch, CURLOPT_HTTPHEADER, $streamheaders);

                $streamresult = curl_exec($streamch);
                    if (curl_errno($streamch)) {
                        echo 'Error:' . curl_error($streamch);
                    }
                curl_close($streamch);

                return $streamresult;
        }


        $sql = "SELECT id, name, twitch, twitch_u FROM creators ORDER BY name ASC;";

        //colocando em array
        $creators_array = $dbConn->query($sql)->fetchAll();

        foreach ($creators_array as $creator) {
            $streamurl = "https://api.twitch.tv/helix/streams?user_login=" . $creator['twitch_u'];
            $stream = file_get_channelcontents_curl($streamurl);

            $pattern = '/live/';//Padrão a ser encontrado na string $tags
            if (preg_match($pattern, $stream)) {
                ?>
                <div class="col-md-4">
                    <div class="stream">
                        <a href="<?= $creator['twitch'] ?>" target="new">
                            <img src="uploads/creators/<?= $creator['id'] ?>.png">
                            <h1><?= $creator['name'] ?></h1>
                        </a>
                    </div>
                </div>
            <?php
            }
        }
        ?>
    </div>
</div>


<?php 
//incluindo sessão de compartilhamento
include('share-box.php');
?>

<?php
require_once("footer.php");
?>