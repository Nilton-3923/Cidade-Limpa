<?php
    include_once("../Classe/Usuario.php");
    include_once("../Classe/Conexao.php");


    //Criação de um objeto Usuario

    $email = $_POST['txtEmail'];
    $senha = $_POST['txtSenha'];

    $usuario = new Usuario();

    if($usuario->verificar($email,$senha) === true){//Verificar se o usuario já existe
        header("Location: ../cadastro-usuario.php");
    }
    else{
        $nomeImagem = $_FILES['fotoUsuario']['name'];
        $arquivoImagem = $_FILES['fotoUsuario']['tmp_name'];

        $caminhoImagem = "imgUsuario/".$nomeImagem;
        move_uploaded_file($arquivoImagem,$caminhoImagem);

        $nome = $_POST['txtNome'];
        $tel = $_POST['telefone'];
        $usuario->setNomeUsuario($nome);
        $usuario->setSenhaUsuario($_POST['txtSenha']);
        $usuario->setEmailUsuario($_POST['txtEmail']);
        $usuario->setCepUsuario($_POST['txtCep']);
        $usuario->setImgUsuario($caminhoImagem);
        
        echo $usuario->cadastrar($usuario,$tel);
        header("Location: ../login.php");

    }
    

?>
