<!--------NILTON EDITOU--------->

<?php
    include_once("../classe/Conexao.php");
    include_once("../classe/Adm.php");

    $resposta = new Adm();

    echo $_POST['respAdm'];
    echo $_POST['idDenuncia'];


    
    $resposta->setRespAdm($_POST['respAdm']);
    $resposta->setIdAdm('1');
    $resposta->setIdDenuncia($_POST['idDenuncia']);
    
    date_default_timezone_set('America/Sao_Paulo');
    $resposta->setDataResp(date('d/m/Y'));

    $resposta->setVerificacao('Verificada');

    echo $resposta->cadastrar($resposta);
    header("Location:../area-restrita-adm/tabela-denuncia.php");

?>