<?php
    require_once("Conexao.php");
    require_once("Categoria.php");

    class Denuncia{

        

        private $idDenuncia;

        private $descDenuncia;
        private $tituloDenuncia;
        private $dataDenuncia;

        private $cepDenuncia;
        private $ufDenuncia;
        private $bairroDenuncia;
        private $ruaDenuncia;
        private $cidadeDenuncia;
        private $numero;
        private $zonaDenuncia;

        private $imagemDenuncia;
        private $idUsuario;
        private $idCategoria;


 
        //Métodos Getters

        # PK e FK
        public function getIdDenuncia(){
            return $this->idDenuncia;
        }
        public function getIdUsuario(){
            return $this->idUsuario;
        }
        public function getIdCategoria(){
            return $this->idCategoria;
        }
        

        # Descrições,data e foto
        public function getDescDenuncia(){
            return $this->descDenuncia;
        }
        public function getTituloDenuncia(){
            return $this->tituloDenuncia;
        }
        public function getDataDenuncia(){
            return $this->dataDenuncia;
        }
        public function getImagemDenuncia(){
            return $this->imagemDenuncia;
        }

        # Localização
        public function getCepDenuncia(){
            return $this->cepDenuncia;
        }
        public function getUfDenuncia(){
            return $this->ufDenuncia;
        }
        public function getBairroDenuncia(){
            return $this->bairroDenuncia;
        }
        public function getRuaDenuncia(){
            return $this->ruaDenuncia;
        }
        public function getCidadeDenuncia(){
            return $this->cidadeDenuncia;
        }
        public function getNumero(){
            return $this -> numero; 
        }
        public function getZonaDenuncia(){
            return $this->zonaDenuncia;
        }


        //Métodos Setters

        #PK e FK
        public function setIdDenuncia($idDenuncia){
            $this->idDenuncia = $idDenuncia;
        }
        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }
        public function setIdCategoria($idCategoria){
            $this->idCategoria = $idCategoria;
        }



        #Descrição,data e foto
        public function setDescDenuncia($descDenuncia){
            $this->descDenuncia = $descDenuncia;
        }
        public function setTituloDenuncia($tituloDenuncia){
            $this->tituloDenuncia = $tituloDenuncia;
        }
        public function setDataDenuncia($dataDenuncia){
            $this->dataDenuncia = $dataDenuncia;
        }
        public function setImagemDenuncia($imagemDenuncia){
            $this->imagemDenuncia = $imagemDenuncia;
        }

        #Localização
        public function setUfDenuncia($ufDenuncia){
            $this->ufDenuncia = $ufDenuncia;
        }
        public function setBairroDenuncia($bairroDenuncia){
            $this->bairroDenuncia = $bairroDenuncia;
        }
        public function setCepDenuncia($cepDenuncia){
            $this->cepDenuncia = $cepDenuncia;
        }
        public function setRuaDenuncia($ruaDenuncia){
            $this->ruaDenuncia= $ruaDenuncia;
        }
        public function setCidadeDenuncia($cidadeDenuncia){
            $this->cidadeDenuncia = $cidadeDenuncia;
        }
        public function setNumero($numero){
            $this -> numero = $numero; 
        }
        public function setZonaDenuncia($zonaDenuncia){
            $this->zonaDenuncia = $zonaDenuncia;
        }


        public function corpoEmail(){

            $dataDenuncia = $this -> dataDenuncia;
            $ruaDenuncia = $this -> ruaDenuncia;
            $bairroDenuncia = $this -> bairroDenuncia;
            $numero = $this -> numero; 
            $descricao = $this -> descDenuncia; 
            $imagemDenuncia = $this -> imagemDenuncia;
            $idCategoria = $this->idCategoria;

            if($idCategoria  == 1){
                $categoria = "Descarte de lixo";
            }else{
                $categoria = "Casos de Dengue";
            }

            $corpoEmail = "Olá, somos a empresa SOFTONE desenvolvedora do projeto Cidade Limpa. Nosso projeto tem como objetivo auxiliar as pessoas com as denuncias de irregularidades na cidade de São Paulo.<br>
            
            Temos uma denuncia de $categoria feita na região de São Paulo, no dia $dataDenuncia, na $ruaDenuncia, $numero, $bairroDenuncia.
            
            <br><br>
            Descrição feita pelos moradores: $descricao.
            
            <br><br>
            Imagem do local: <br>
            <img src='$imagemDenuncia' style='height:200px; width:200px;'>";

            return $corpoEmail;
        }


        public function geolocalizacao(){

            $ufDenuncia = $this -> ufDenuncia; 
            $cidadeDenuncia = $this -> cidadeDenuncia;
            $ruaDenuncia = $this -> ruaDenuncia;
            $bairroDenuncia = $this -> bairroDenuncia;
            $numero = $this -> numero; 


            $enderecoJunto = "$numero $ruaDenuncia, $bairroDenuncia, $cidadeDenuncia - $ufDenuncia"; 

            $addr = str_replace(" ", "+","$enderecoJunto");

            $address = utf8_encode($addr);
    
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyAo1uIjwfM3QBcwPKKDVuXv0z8eJlQGcYE";
        
            $json = file_get_contents($url);
            $data = json_decode($json);
    
            $lat = $data->results[0]->geometry->location->lat;
            $long = $data->results[0]->geometry->location->lng;

            $localizacao = "lat: $lat, lng: $long"; 
    
            return $localizacao; 
        }




        public function denunciar($denuncia){
            $conexao = Conexao::pegarConexao();

            //Cadastro da Denúncia
            $stmtDenuncia = $conexao->prepare(
                "INSERT INTO tbDenuncia
                    (tituloDenuncia,#1
                    descDenuncia,   #2
                    imgDenuncia,    #3
                    dataDenuncia,   #4
                    ufDenuncia,     #5
                    bairroDenuncia, #6
                    cepDenuncia,    #7
                    ruaDenuncia,    #8
                    cidadeDenuncia, #9
                    coordeDenuncia, #10
                    zonaDenuncia,   #11
                    fk_idUsuario,   #12                   
                    fk_idCategoria) #13
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)"
            );

            //Informações
            $stmtDenuncia->bindValue(1,$denuncia->getTituloDenuncia());
            $stmtDenuncia->bindValue(2,$denuncia->getDescDenuncia());
            $stmtDenuncia->bindValue(3,$denuncia->getImagemDenuncia());
            $stmtDenuncia->bindValue(4,$denuncia->getDataDenuncia());

            //Endereços
            $stmtDenuncia->bindValue(5,$denuncia->getUfDenuncia());
            $stmtDenuncia->bindValue(6,$denuncia->getBairroDenuncia());
            $stmtDenuncia->bindValue(7,$denuncia->getCepDenuncia());
            $stmtDenuncia->bindValue(8,$denuncia->getRuaDenuncia());
            $stmtDenuncia->bindValue(9,$denuncia->getCidadeDenuncia());

            //Geolocalização
            $stmtDenuncia-> bindValue(10,$denuncia->geolocalizacao());
            $stmtDenuncia->bindValue(11,$denuncia->getZonaDenuncia());

            //Id
            $stmtDenuncia->bindValue(12,$denuncia->getIdUsuario());
            $stmtDenuncia->bindValue(13,$denuncia->getIdCategoria());

            $stmtDenuncia->execute();
        }
        

        //Método para Mostrar as Denúncias já feitas
        public function mostrar(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT imgDenuncia,imgUsuario,nomeUsuario,tituloDenuncia,descDenuncia,dataDenuncia,ufDenuncia,bairroDenuncia,cepDenuncia,ruaDenuncia,cidadeDenuncia FROM tbDenuncia
                      INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_Usuario";

            $query = $conexao->query($query);

            $query = $query->fetchAll();

            return $query;



        }

        public function mostrarPontosMapa(){
            $conexao = Conexao :: pegarConexao();

            $query = "SELECT coordeDenuncia, tituloDenuncia, descDenuncia, cepDenuncia, DATE_FORMAT(`dataDenuncia`,'%d/%m/%Y') as dataDenuncia, campoCategoria,imgDenuncia FROM tbDenuncia 
                INNER JOIN tbcategoria 
                    ON tbcategoria.pk_idCategoria = tbdenuncia.fk_idCategoria       
            ";

            $query = $conexao->query($query);
            $query = $query->fetchAll();

            return $query;
        }

        //Método de Deletar Denuncia(DELETE)
        public function deletarDenuncia($idDenuncia){
            $conexao = Conexao::pegarConexao();

            $deleteDenuncia = $conexao->prepare("DELETE FROM tbDenuncia
                                                WHERE pk_idDenuncia = $idDenuncia");

            $deleteDenuncia->execute();
            $contagem = $conexao->prepare("UPDATE tbAdm 
                                            SET denunciaReslvAdm = denunciaReslvAdm+1");
            $contagem->execute();

            return 'deletado';

        }
        
        //Método de Alterar Denuncia 
        public function alterar($idDenuncia, $titulo, $desc){
            $conexao = Conexao::pegarConexao();

            $alterarDenuncia = $conexao->prepare("UPDATE tbDenuncia 
                                                    SET
                                                    tituloDenuncia = '$titulo'
                                                    ,descDenuncia = '$desc'
                                                        WHERE pk_idDenuncia = '$idDenuncia'");

            $alterarDenuncia->execute();


            return "Update realizado";      
        }

        public function alterarImg($idDenuncia, $titulo, $desc, $caminhoImagem){
            $conexao = Conexao::pegarConexao();

            $alterarDenuncia = $conexao->prepare("UPDATE tbDenuncia 
                                                    SET
                                                    tituloDenuncia = '$titulo'
                                                    ,descDenuncia = '$desc'
                                                    ,imgDenuncia = '$caminhoImagem'
                                                        WHERE pk_idDenuncia = '$idDenuncia'");

            $alterarDenuncia->execute();


            return "Update realizado";      
        }
        //Método de pesquisa
        public function pesquisar($pesquisar){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT tituloDenuncia,descDenuncia,dataDenuncia,nomeUsuario,imgUsuario,cepDenuncia,imgDenuncia FROM tbDenuncia
                      INNER JOIN tbUsuario ON tbUsuario.pk_Usuario = tbDenuncia.fk_idUsuario
                      WHERE tituloDenuncia LIKE '%$pesquisar%' OR descDenuncia LIKE '%$pesquisar%' OR nomeUsuario LIKE '%$pesquisar%'";

            $query = $conexao->query($query);
            $query = $query->fetchAll();
            return $query;
        }

    }
?>