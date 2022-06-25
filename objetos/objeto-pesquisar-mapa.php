<?php 
    session_start();
    require_once("../classe/Adm.php"); 

    $adm = new Adm();

    //Variavel de pesquisa
    $pesquisa = $_POST['pesquisa'];

    $localizacao = $_GET['localizacao'];

    switch ($localizacao){

        case "adm": 
            $pagina = "Location: ../area-restrita-adm/cadastro-ecoponto.php#map";
            break;
        case "index" :
            $pagina = "Location: ../index.php#map";
            break;
        case "usuario":
            $pagina = "Location: ../area-restrita-usuario/index-restrita.php#mapa";
            break;
    }
   
    //Verficando se a pesquisa não estpa vazia
    if(!empty($pesquisa)){
        //Vendo se a pesquisa é um cep
        $cep = $adm->pesquisarCep($pesquisa);

        //Se for um cep então parte daqui a coordenada (Ele está dando os valores da API do CEP)
        if($cep != "erro"){

            //Puxando a coordenada com a funcção
            $coordenada = $adm ->pesquisarMapa($cep);

            //SESSION para transitar a coordenada
            $_SESSION['coordenada'] = $coordenada;
            header($pagina);

        }
        //Se não for um cep então verifica se é um endereço
        else {
            //método para dar os parametros da pesquisa 
            $validacao = $adm->validacaoEndereco($pesquisa);

            //Passando a validação
            $coordenada = $adm ->pesquisarMapa($validacao);
            $_SESSION['coordenada'] = $coordenada;
            header($pagina);
          
        }
    }else {
        header($pagina);
    }


?>