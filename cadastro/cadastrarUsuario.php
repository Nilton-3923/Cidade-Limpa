<?php
    include_once("../Classe/Usuario.php");
    include_once("../Classe/Conexao.php");


    //Criação de um objeto Usuario
    $usuario = new Usuario();

    $usuario->setNomeUsuario($_POST['txtNome']);
    $usuario->setSobreNomeUsuario($_POST['txtSobreNome']);
    $usuario->setEmailUsuario($_POST['txtEmail']);
    $usuario->setCepUsuario($_POST['txtCep']);

    
    echo $usuario->cadastrar($usuario);


?>