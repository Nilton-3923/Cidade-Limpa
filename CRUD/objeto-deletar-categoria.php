<?php   
    require_once("../classe/Categoria.php");
    $categoria = new Categoria();

    echo $idCategoria = $_GET['pk_idCategoria'];

    echo $categoria->deletarCategoria($idCategoria);
    header("Location:../area-restrita-adm/cadastro-categoria.php");

?>