$(document).ready(function(){

    //Filtrando por REGIÃO
    $(document).on( "click", ".filtro_regiao.inativo", function() {
        var regiao = $(this).attr('id') + "_";
        $(this).removeClass("inativo");
        $(this).addClass("ativo");
        var input = $("#regionRef").val();
        $("#regionRef").val(input + regiao);
    });
    $(document).on( "click", ".filtro_regiao.ativo", function() {
        var regiao = $(this).attr('id') + "_";
        $(this).removeClass("ativo");
        $(this).addClass("inativo");
        var input = $("#regionRef").val();
        input = input.replace(regiao, "");
        $("#regionRef").val(input);
    });

    //Filtrando por RARIDADE
    $(document).on( "click", ".filtro_raridade.inativo", function() {
        var rarity = $(this).attr('id') + "_";
        $(this).removeClass("inativo");
        $(this).addClass("ativo");
        var input = $("#rarityRef").val();
        $("#rarityRef").val(input + rarity);
    });
    $(document).on( "click", ".filtro_raridade.ativo", function() {
        var rarity = $(this).attr('id') + "_";
        $(this).removeClass("ativo");
        $(this).addClass("inativo");
        var input = $("#rarityRef").val();
        input = input.replace(rarity, "");
        $("#rarityRef").val(input);
    });

});