<?php 

    require_once("../classe/Denuncia.php");

    $idDenuncia = $_POST['pk_idDenuncia'];
    $titulo = $_POST['tituloDenuncia'];
    $desc = $_POST['descDenuncia'];

    $denuncia = new Denuncia();
    
    //Verificar se todos os dados estão preenchido
    if(($_FILES['imgDenuncia']['size'])>0){
        $nomeImagem = $_FILES['imgDenuncia']['name'];
        $arquivoImagem = $_FILES['imgDenuncia']['tmp_name'];

        $caminhoImagem = "../cadastro/imgDenuncia/".$nomeImagem;
        move_uploaded_file($arquivoImagem,$caminhoImagem);
        
        echo $denuncia->alterarImg($idDenuncia, $titulo, $desc, $caminhoImagem);
        
    }else{
        echo $denuncia->alterar($idDenuncia, $titulo, $desc);
    }
   
    header("Location: ../area-restrita-usuario/index-restrita.php")
?>