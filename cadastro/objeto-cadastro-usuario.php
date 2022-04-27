<?php
    include_once("../Classe/Usuario.php");
    include_once("../Classe/Conexao.php");


    //Criação de um objeto Usuario


    $usuario = new Usuario();

    $nome = $_POST['txtNome'];

    $usuario->setNomeUsuario($nome);
    $usuario->setSenhaUsuario($_POST['txtSenha']);
    $usuario->setEmailUsuario($_POST['txtEmail']);
    $usuario->setCepUsuario($_POST['txtCep']);

    
    echo $usuario->cadastrar($usuario);

    header("Location: ../login.php");

?>
