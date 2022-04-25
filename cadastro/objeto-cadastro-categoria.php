<?php
    include_once("../classe/Conexao.php");
    include_once("../classe/Categoria.php");


    $categoria = new Categoria();

    $categoria->setCampoCategoria($_POST['txtCategoria']);
    echo $categoria->cadastrar($categoria);

    header("Location: ../area-restrita-adm/cadastro-categoria.php");

?> 