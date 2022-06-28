<?php
    ////////////////////////NILTON MUDOU
    require_once("../classe/Adm.php"); 

    $resposta = new Adm();

    $respostaAdm= "Estamos verificando se essa denúncia foi resolvida?";

    foreach($_POST['id'] as $id){

    
        $resposta->setRespAdm($respostaAdm);
        $resposta->setIdAdm('1');
        $resposta->setIdDenuncia($id);
        
        date_default_timezone_set('America/Sao_Paulo');
        $resposta->setDataResp(date('d/m/Y'));

        $resposta->setVerificacao('Verificada');

        echo $resposta->cadastrar($resposta);

    }
    header("Location: ../area-restrita-adm/tabela-denuncia.php");


?>