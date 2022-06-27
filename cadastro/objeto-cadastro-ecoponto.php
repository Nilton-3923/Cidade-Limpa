<?php

    session_start();
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
    $ecoponto->setCidadeEcoponto('São Paulo');

    echo $ecoponto->cadastroEcoponto($ecoponto);

    $_SESSION['verificarCadastroEcoponto'] = TRUE; 

    header("Location: ../area-restrita-adm/cadastro-ecoponto.php");

?> 
