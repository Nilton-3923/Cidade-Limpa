<?php 

    include_once("../classe/Conexao.php");
    include_once("../classe/Usuario.php");

    session_start();

    if(isset($_POST['emailUsuario']) && !empty($_POST['emailUsuario']) 
    && isset($_POST['senhaUsuario']) && !empty($_POST['senhaUsuario'])){

        $usuario = new Usuario();

        $email = addslashes($_POST['emailUsuario']);
        $senha = addslashes($_POST['senhaUsuario']);

        if($email == 'adm' && $senha == '123'){
            
            $_SESSION['emailAdm'] = $email;
            $_SESSION['senhaAdm'] = $senha;
            header("Location: ../area-restrita-adm/index-adm-restrita.php");

        }else{

            if($usuario->login($email,$senha) == true){
                if(isset($_SESSION['idUsuario'])){     
                    $_SESSION['idUsuario'];
                    header("Location: ../area-restrita-usuario/index-restrita.php");
                    
                }else{
                    header("Location: ../novo-login.php");
                    $_SESSION['verificarLogin'] = TRUE; 
                }
    
            }else{
                header("Location: ../novo-login.php");
                $_SESSION['verificarLogin'] = TRUE;
            } 
        }

    }else{
                header("Location: ../novo-login.php");
                $_SESSION['verificarLogin'] = TRUE;
    }

?>