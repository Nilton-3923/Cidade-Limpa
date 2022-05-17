<?php 

    require_once("../classe/Usuario.php");

    $id = $_POST['pk_Usuario'];
    $nome = $_POST['nomeUsuario'];
    $tel = $_POST['numTelUsuario'];
    $senha = $_POST['senhaUsuario'];

    $usuario = new Usuario();
    
    //Verificar se todos os dados estão preenchido
    if(($_FILES['fotoUsuario']['size'])>0){
        $nomeImagem = $_FILES['fotoUsuario']['name'];
        $arquivoImagem = $_FILES['fotoUsuario']['tmp_name'];

        $caminhoImagem = "../cadastro/imgUsuario/".$nomeImagem;
        move_uploaded_file($arquivoImagem,$caminhoImagem);
        
        echo $usuario->alterarImg($id, $nome, $tel, $senha,$caminhoImagem);
        
    }else{
        echo $usuario->alterar($id, $nome, $tel, $senha);
    }
    header("Location:../area-restrita-usuario/index-restrita.php");
?>