<?php

use FontLib\Table\Type\head;

    include_once("../classe/Conexao.php");
    include_once("../classe/Categoria.php");


    $categoria = new Categoria();

    $idCategoria = $_POST['pk_idCategoria'];
    $campoCategoria = $_POST['txtCategoria'];

    if(!isset($_POST['pk_idCategoria']) || empty($_POST['pk_idCategoria'])){
        $categoria->setCampoCategoria($_POST['txtCategoria']);
        echo $categoria->cadastrar($categoria);

        header("Location: ../area-restrita-adm/cadastro-categoria.php");

    }
    else{
        echo $categoria->alterar($idCategoria,$campoCategoria);
        
        header("Location: ../area-restrita-adm/cadastro-categoria.php");
       
    }

?>