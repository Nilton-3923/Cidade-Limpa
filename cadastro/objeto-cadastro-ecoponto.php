<?php
    include_once("../classe/Conexao.php");
    include_once("../classe/Ecoponto.php");


    $ecoponto = new Ecoponto();

    $ecoponto->setUfEcoponto($_POST['uf']);
    $ecoponto->setLogradouroEcoponto($_POST['cidade']);
    $ecoponto->setBairroEcoponto($_POST['bairro']);
    $ecoponto->setCepEcoponto($_POST['cep']);
    $ecoponto->setRuaEcoponto($_POST['rua']);
    $ecoponto->setZonaEcoponto($_POST['regiao']);
    $ecoponto->setNumeroEcoponto($_POST['numero']);


    echo $ecoponto->cadastroEcoponto($ecoponto);

    header("Location: ../area-restrita-adm/index-adm-restrita.php");

?> 