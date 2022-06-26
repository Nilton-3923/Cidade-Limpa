<?php 
    session_start();
    require_once("../classe/Ecoponto.php");
    require_once("../classe/Ecoponto.php");
    print_r($_FILES['arquivo']['tmp_name']);
    if(!empty($_FILES['arquivo']['tmp_name'])){
        $arquivo = new DOMDocument();
        $arquivo->load($_FILES['arquivo']['tmp_name']);

        $linhas = $arquivo->getElementsByTagName('Row');
        //var_dump($linhas);
        $primeira_linha = true; 
        foreach($linhas as $linha){
            if($primeira_linha == false){
                $logradouro = $linha->getElementsByTagName('Data')->item(0)->nodeValue;

                $rua = $linha->getElementsByTagName('Data')->item(0)->nodeValue;
    
                $bairro = $linha->getElementsByTagName('Data')->item(1)->nodeValue;
    
                $cep = $linha->getElementsByTagName('Data')->item(2)->nodeValue;
    
                $zona = $linha->getElementsByTagName('Data')->item(3)->nodeValue;
    
                $num = $linha->getElementsByTagName('Data')->item(4)->nodeValue;

                //Cadastro
                $ecoponto = new Ecoponto();

                $ecoponto->setUfEcoponto('SP');
                $ecoponto->setLogradouroEcoponto($logradouro);
                $ecoponto->setBairroEcoponto($bairro);
                $ecoponto->setCepEcoponto($cep);
                $ecoponto->setRuaEcoponto($rua);
                $ecoponto->setZonaEcoponto($zona);
                $ecoponto->setNumeroEcoponto($num);
                $ecoponto->setCidadeEcoponto('São Paulo');
        
                echo $ecoponto->cadastroEcoponto($ecoponto);

                $_SESSION['verificarXml-True'] = TRUE;
                header("Location: ../area-restrita-adm/cadastro-ecoponto.php");
            }
            $primeira_linha = false;
        }
    }else{
            $_SESSION['verificarXml-False'] = TRUE;
            header("Location: ../area-restrita-adm/cadastro-ecoponto.php");
    }
?>