<?php 

    include_once("../classe/Conexao.php");
    include_once("../classe/Usuario.php");

    if(isset($_POST['emailUsuario']) && !empty($_POST['emailUsuario']) 
    && isset($_POST['senhaUsuario']) && !empty($_POST['senhaUsuario'])){

        $usuario = new Usuario();

        $email = addslashes($_POST['emailUsuario']);
        $senha = addslashes($_POST['senhaUsuario']);

        if($email == 'adm' && $senha == '123'){
            session_start();
            $_SESSION['emailAdm'] = $email;
            $_SESSION['senhaAdm'] = $senha;
            header("Location: ../area-restrita-adm/index-adm-restrita.php");

        }else{

            if($usuario->login($email,$senha) == true){
                if(isset($_SESSION['idUsuario'])){     
                    session_start();
                    $_SESSION['idUsuario'];
                    header("Location: ../area-restrita-usuario/index-restrita.php");
                    
                }else{
                    header("Location: ../login.php");
                }
    
            }else{
                header("Location: ../login.php");
            } 
        }

    }else{
                header("Location: ../login.php");
    }

?>