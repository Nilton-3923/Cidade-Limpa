<?php
    require_once("Conexao.php");

    class Ecoponto{

        

        private $idEcoponto;

        private $ufEcoponto;
        private $logradouroEcoponto;
        private $bairroEcoponto;
        private $cepEcoponto;
        private $ruaEcoponto;
        private $coordeEcoponto;
        private $zonaEcoponto;
        private $numeroEcoponto;

 
        //Métodos Getters

        # PK e FK
        public function getIdEcoponto(){
            return $this->idEcoponto;
        }

        # Localização Ecoponto
        public function getUfEcoponto(){
            return $this->ufEcoponto;
        }
        public function getLogradouroEcoponto(){
            return $this->logradouroEcoponto;
        }
        public function getBairroEcoponto(){
            return $this->bairroEcoponto;
        }
        public function getCepEcoponto(){
            return $this->cepEcoponto;
        }
        public function getRuaEcoponto(){
            return $this->ruaEcoponto;
        }
        public function getZonaEcoponto(){
            return $this->zonaEcoponto; 
        }
        public function getNumeroEcoponto(){
            return $this->numeroEcoponto;
        }
    

        #Descrição,data e foto
        public function setIdEcoponto($idEcoponto){
            $this->idEcoponto = $idEcoponto;
        }
    
        # Localização ecoponto

        public function setUfEcoponto($ufEcoponto){
            $this->ufEcoponto = $ufEcoponto;
        }
        public function setLogradouroEcoponto($logradouroEcoponto){
            $this->logradouroEcoponto = $logradouroEcoponto;
        }
        public function setBairroEcoponto($bairroEcoponto){
            $this->bairroEcoponto = $bairroEcoponto;
        }
        public function setCepEcoponto($cepEcoponto){
            $this->cepEcoponto = $cepEcoponto;
        }
        public function setRuaEcoponto($ruaEcoponto){
            $this->ruaEcoponto = $ruaEcoponto;
        }
        public function setZonaEcoponto($zonaEcoponto){
            $this->zonaEcoponto = $zonaEcoponto;
        }
        public function setNumeroEcoponto($numeroEcoponto){
            $this->numeroEcoponto = $numeroEcoponto;
        }
        


        public function geolocalizacao(){

            $uf = $this -> ufEcoponto; 
            $cidade = $this -> logradouroEcoponto;
            $rua = $this -> ruaEcoponto;
            $bairro = $this -> bairroEcoponto;
            $numero = $this -> numeroEcoponto; 


            $enderecoJunto = "$numero $rua, $bairro, $cidade - $uf"; 

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




        public function cadastroEcoponto($ecoponto){
            $conexao = Conexao::pegarConexao();

            //Cadastro da Denúncia
            $stmt = $conexao->prepare(
                "INSERT INTO tbEcoponto
                    (ufEcoponto,#1
                    logradouroEcoponto,#2
                    bairroEcoponto,#3
                    cepEcoponto,#4
                    ruaEcoponto,#5 
                    coordeEcoponto, #6
                    zonaEcoponto,#7
                    numeroEcoponto#8
                    )
                        VALUES (?,?,?,?,?,?,?,?)"
            );

            //Informações
            $stmt->bindValue(1,$ecoponto->getUfEcoponto());
            $stmt->bindValue(2,$ecoponto->getLogradouroEcoponto());
            $stmt->bindValue(3,$ecoponto->getBairroEcoponto());
            $stmt->bindValue(4,$ecoponto->getCepEcoponto());

            //Endereços
            $stmt->bindValue(5,$ecoponto->getRuaEcoponto());
            $stmt->bindValue(6,$ecoponto->geolocalizacao());
            $stmt->bindValue(7,$ecoponto->getZonaEcoponto());
            $stmt->bindValue(8,$ecoponto->getNumeroEcoponto());

            $stmt->execute();
        }
        

        //Método para Mostrar as Denúncias já feitas
        public function mostrarEcoponto(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT * FROM tbEcoponto";
                      

            $query = $conexao->query($query);

            $query = $query->fetchAll();

            return $query;

        }

        public function ecopontosSemGeolocalizacao(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT pk_idEcoponto FROM tbEcoponto
                        WHERE coordeEcoponto = ''";

            $query = $conexao->query($query);
            $query = $query->fetchAll();

            return $query;
        }

        public function selecionarEcopontoParametro($id){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT * FROM tbEcoponto
                        WHERE pk_idEcoponto = $id";

            $query = $conexao->query($query);
            $query = $query->fetchAll();

            return $query;
        }

        public function geolocalizacaoExcel($numero, $rua, $bairro,$cidade, $uf){
         
         
            $enderecoJunto = "$numero $rua, $bairro, $cidade - $uf"; 

            $addr = str_replace(" ", "+","$enderecoJunto");

            $address = utf8_encode($addr);
    
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyAo1uIjwfM3QBcwPKKDVuXv0z8eJlQGcYE";
        
            $json = file_get_contents($url);
            $data = json_decode($json);
    
            $lat = $data->results[0]->geometry->location->lat;
            $long = $data->results[0]->geometry->location->lng;

            return $localizacao = "lat: $lat, lng: $long"; 
    
        }

        public function alterarLocalizacao($coorde, $id){
            $conexao = Conexao::pegarConexao();

            $update = $conexao->prepare("UPDATE tbEcoponto
                                            SET coordeEcoponto = '$coorde'
                                                WHERE pk_idEcoponto = $id");
            $update->execute();

        }

    }
?>