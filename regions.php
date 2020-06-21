<?php
require_once("header.php"); //cabeçalho do site
?>
<script type="text/javascript">
    // Mudando o title
    var title_topo_atual = document.title;
    document.title = "Regiões - " + title_topo_atual;
</script>

<div class="banner banner-regions">
    <h1>Regiões</h1>
</div>

<div class="container-fluid container-regions-msg">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <img src="img/regions-medium.jpg" alt="Regiões de Runeterra">
        </div>
        <div class="col-md-6 text-center">
            <h2>Conheça Runeterra!</h2>
            <p>Explore o mundo de <i>Legends of Runeterra</i>. Como você pode ver no mini mapa existem muitas regiões que ainda não foram lançadas dentro do jogo. A cada ano a Riot Games lançará duas novas regiões.</p>
            <p>Cada região tem uma identidade própria com campeões e cartas que reafirmam essa identidade. A partir disso você pode descobrir o seu estilo de jogo e um universo de combinações se torna possível para que você vença seu oponente!</p>
        </div>
    </div>
</div>

<div class="container container-regions-list">
    <div class="row text-center justify-content-center">
        <div class="col-md-3">
            <a href="region.php?region=Bilgewater">
                <img src="img/regions/hd/Bilgewater_crest_icon.png" alt="Águas de Sentina"/>
                <h2>Águas de Sentina</h2>
            </a>
        </div>
        <div class="col-md-3">
            <a href="region.php?region=Demacia">
                <img src="img/regions/hd/Demacia_crest_icon.png" alt="Demacia"/>
                <h2>Demacia</h2>
            </a>
        </div>
        <div class="col-md-3">
            <a href="region.php?region=Freljord">
                <img src="img/regions/hd/Freljord_crest_icon.png" alt="Freljord"/>
                <h2>Freljord</h2>
            </a>
        </div>
        <div class="col-md-3">
            <a href="region.php?region=ShadowIsles">
                <img src="img/regions/hd/ShadowIsles_crest_icon.png" alt="Ilhas das Sombras"/>
                <h2>Ilhas das Sombras</h2>
            </a>
        </div>
        <div class="col-md-3">
            <a href="region.php?region=Ionia">
                <img src="img/regions/hd/Ionia_crest_icon.png" alt="Ionia"/>
                <h2>Ionia</h2>
            </a>
        </div>
        <div class="col-md-3">
            <a href="region.php?region=Noxus">
                <img src="img/regions/hd/Noxus_crest_icon.png" alt="Noxus"/>
                <h2>Noxus</h2>
            </a>
        </div>
        <div class="col-md-3">
            <a href="region.php?region=PiltoverZaun">
                <img src="img/regions/hd/PiltoverZaun_crest_icon.png" alt="Piltover e Zaun"/>
                <h2>Piltover e Zaun</h2>
            </a>
        </div>
    </div>
</div>



<?php
require_once("footer.php"); //rodapé do site
?>