<?php
    //****************Fazer Verificação com JavaScript */


    include_once("../classe/Conexao.php");


    $conexao = Conexao::pegarConexao();

    $idUsuario = $_SESSION['idUsuario'];
    $nome = $_POST['nomeUsuario'];
    $senha = $_POST['senhaUsuario'];
    
    //Verificar se todos os dados estão preenchido
    if(($_FILES['fotoUsuario']['size'])>0 && 
    isset($_POST['nomeUsuario']) && !empty($_POST['nomeUsuario']) && 
    isset($_POST['senhaUsuario']) && !empty($_POST['senhaUsuario'])){
        
            $nomeImagem = $_FILES['fotoUsuario']['name'];
            $arquivoImagem = $_FILES['fotoUsuario']['tmp_name'];

            $caminhoImagem = "imgUsuario/".$nomeImagem;
            move_uploaded_file($arquivoImagem,$caminhoImagem);

            $stmtImg  = $conexao->prepare("INSERT INTO tbImgusuario VALUES(null,'$caminhoImagem')");
            $stmtImg->execute();

            $idImagem = $conexao->lastInsertId();


            $stmt = $conexao->prepare("UPDATE tbUsuario 
                                    SET nomeUsuario = '$nome'
                                        ,senhaUsuario = '$senha'
                                        ,fk_idImgUsuario = '$idImagem'
                                        WHERE pk_Usuario = '$idUsuario'");
            
            $stmt->execute();
            
            header("Location:../area-restrita-usuario/index-restrita.php");
    }

    else{
        header("Location:../area-restrita-usuario/index-restrita.php");
    }

?>