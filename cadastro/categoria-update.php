<?php
    include_once("../classe/Conexao.php");

    $conexao = Conexao::pegarConexao();
    
    $nomeImagem = $_FILES['fotoUsuario']['name'];
    $arquivoImagem = $_FILES['fotoUsuario']['tmp_name'];

    $caminhoImagem = "imgUsuario/".$nomeImagem;
    move_uploaded_file($arquivoImagem,$caminhoImagem);

    $stmtImg  = $conexao->prepare("INSERT INTO tbImgusuario VALUES(null,'$caminhoImagem')");
    $stmtImg->execute();

    $idImagem = $conexao->lastInsertId();

    $idUsuario = $_POST['idUsuario'];
    $nome = $_POST['nomeUsuario'];
    $senha = $_POST['senhaUsuario'];


    $stmt = $conexao->prepare("UPDATE tbUsuario 
                               SET nomeUsuario = '$nome'
                                   ,senhaUsuario = '$senha'
                                   ,fk_idImgUsuario = '$idImagem'
                                   WHERE pk_Usuario = '$idUsuario'");
    
    $stmt->execute();

    header("Location:../area-restrita-usuario/index-restrita.php");


?>