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
                $uf = $linha->getElementsByTagName('Data')->item(0)->nodeValue;
                echo $uf;
    
                $logradouro = $linha->getElementsByTagName('Data')->item(1)->nodeValue;
                echo $logradouro;
    
                $bairro = $linha->getElementsByTagName('Data')->item(2)->nodeValue;
                echo $bairro;
    
                $cep = $linha->getElementsByTagName('Data')->item(3)->nodeValue;
                echo $cep;
    
                $rua = $linha->getElementsByTagName('Data')->item(4)->nodeValue;
                echo $rua;
    
                $zona = $linha->getElementsByTagName('Data')->item(5)->nodeValue;
                echo $zona;
    
                $num = $linha->getElementsByTagName('Data')->item(6)->nodeValue;
                echo $num."<br>";
    
                $ecoponto = new Ecoponto();
    
                $ecoponto->setUfEcoponto($uf);
                $ecoponto->setLogradouroEcoponto($logradouro);
                $ecoponto->setBairroEcoponto($bairro);
                $ecoponto->setCepEcoponto($cep);
                $ecoponto->setRuaEcoponto($rua);
                $ecoponto->setZonaEcoponto($zona);
                $ecoponto->setNumeroEcoponto($num);
        
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