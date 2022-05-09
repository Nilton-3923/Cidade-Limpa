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

        private $idImagemDenuncia;
        private $idUsuario;
        private $idCategoria;


 
        //Métodos Getters

        # PK e FK
        public function getIdDenuncia(){
            return $this->idDenuncia;
        }
        public function getIdImagemDenuncia(){
            return $this->idImagemDenuncia;
        }
        public function getIdUsuario(){
            return $this->idUsuario;
        }
        public function getIdCategoria(){
            return $this->idCategoria;
        }
        

        # Descrições e data
        public function getDescDenuncia(){
            return $this->descDenuncia;
        }
        public function getTituloDenuncia(){
            return $this->tituloDenuncia;
        }
        public function getDataDenuncia(){
            return $this->dataDenuncia;
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


        //Métodos Setters

        #PK e FK
        public function setIdDenuncia($idDenuncia){
            $this->idDenuncia = $idDenuncia;
        }
        public function setIdImagemDenuncia($idImagemDenuncia){
            $this->idImagemDenuncia = $idImagemDenuncia;
        }
        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }
        public function setIdCategoria($idCategoria){
            $this->idCategoria = $idCategoria;
        }



        #Descrição e data
        public function setDescDenuncia($descDenuncia){
            $this->descDenuncia = $descDenuncia;
        }
        public function setTituloDenuncia($tituloDenuncia){
            $this->tituloDenuncia = $tituloDenuncia;
        }
        public function setDataDenuncia($dataDenuncia){
            $this->dataDenuncia = $dataDenuncia;
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

            //Cadastro da Foto da Denuncia
            $nomeImagem = $_FILES['fotoDenuncia']['name'];
            $arquivoImagem = $_FILES['fotoDenuncia']['tmp_name'];

            $caminhoImagem = "imgDenuncia/".$nomeImagem;
            move_uploaded_file($arquivoImagem,$caminhoImagem);

            $stmtImg = $conexao->prepare("INSERT INTO tbImgdenun VALUES(null,'$caminhoImagem')");

            $stmtImg->execute();

            $idImagem = $conexao->lastInsertId();

            //Cadastro da Denúncia
            $stmtDenuncia = $conexao->prepare(
                "INSERT INTO tbDenuncia
                    (tituloDenuncia,#1
                    descDenuncia,   #2
                    dataDenuncia,   #3
                    ufDenuncia,     #4
                    bairroDenuncia, #5
                    cepDenuncia,    #6
                    ruaDenuncia,    #7
                    cidadeDenuncia, #8
                    coordeDenuncia, #9
                    fk_idUsuario,   #10
                    fk_idImgDenun,  #11
                    fk_idCategoria) #12
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"
            );

            //Informações
            $stmtDenuncia->bindValue(1,$denuncia->getTituloDenuncia());
            $stmtDenuncia->bindValue(2,$denuncia->getDescDenuncia());
            $stmtDenuncia->bindValue(3,$denuncia->getDataDenuncia());

            //Endereços
            $stmtDenuncia->bindValue(4,$denuncia->getUfDenuncia());
            $stmtDenuncia->bindValue(5,$denuncia->getBairroDenuncia());
            $stmtDenuncia->bindValue(6,$denuncia->getCepDenuncia());
            $stmtDenuncia->bindValue(7,$denuncia->getRuaDenuncia());
            $stmtDenuncia->bindValue(8,$denuncia->getCidadeDenuncia());

            //Geolocalização
            $stmtDenuncia-> bindValue(9,$denuncia->geolocalizacao());

            //Id
            $stmtDenuncia->bindValue(10,$denuncia->getIdUsuario());
            $stmtDenuncia->bindValue(11,$idImagem);
            $stmtDenuncia->bindValue(12,$denuncia->getIdCategoria());

            $stmtDenuncia->execute();
        }
        

        //Método para Mostrar as Denúncias já feitas
        public function mostrar(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT imgDenuncia,imgUsuario,nomeUsuario,tituloDenuncia,descDenuncia,dataDenuncia,ufDenuncia,bairroDenuncia,cepDenuncia,ruaDenuncia,cidadeDenuncia FROM tbDenuncia
                      INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_Usuario
                        INNER JOIN tbImgUsuario ON tbUsuario.fk_idImgUsuario = tbImgUsuario.pk_idImgUsuario
                            INNER JOIN tbImgDenun ON tbDenuncia.fk_idImgDenun = tbImgDenun.pk_idImgDenun";

            $query = $conexao->query($query);

            $query = $query->fetchAll();

            return $query;



        }

        public function mostrarPontosMapa(){
            $conexao = Conexao :: pegarConexao();

            $query = "SELECT coordeDenuncia, tituloDenuncia, descDenuncia, cepDenuncia, DATE_FORMAT(`dataDenuncia`,'%d/%m/%Y') as dataDenuncia, campoCategoria,imgDenuncia FROM tbDenuncia 
                INNER JOIN tbcategoria 
                    ON tbcategoria.pk_idCategoria = tbdenuncia.fk_idCategoria
                        INNER JOIN tbimgdenun
                            ON tbimgdenun.pk_idImgDenun = tbdenuncia.fk_idImgDenun
            ";

            $query = $conexao->query($query);
            $query = $query->fetchAll();

            return $query;
        }

        //Método de Deletar Denuncia(DELETE)
        public function deletarDenuncia($idDenuncia,$idImagemDenuncia){
            $conexao = Conexao::pegarConexao();

            $deleteDenuncia = $conexao->prepare("DELETE FROM tbDenuncia
                                                WHERE pk_idDenuncia = $idDenuncia");

            $deleteDenuncia->execute();

            $deleteImgDenuncia = $conexao->prepare("DELETE FROM tbImgDenun
                                                    WHERE pk_idImgDenun = $idImagemDenuncia");

            $deleteImgDenuncia->execute();
            return "Deletado";

        }
        
        //Método de Alterar Denuncia sem Imagem
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


        //Método de Alterar com Imagem
        public function alterarImg($caminhoImagem,$idDenuncia, $titulo, $desc){
            $conexao = Conexao::pegarConexao();

            $alterarFoto = $conexao->prepare("INSERT INTO tbImgDenun VALUES(null,'$caminhoImagem')");

            $alterarFoto->execute();

            $idImg = $conexao->lastInsertId();

            $alterarDenuncia = $conexao->prepare("UPDATE tbDenuncia 
                                                    SET
                                                    tituloDenuncia = '$titulo'
                                                    ,descDenuncia = '$desc'
                                                    ,fk_idImgDenun = '$idImg'
                                                        WHERE pk_idDenuncia = '$idDenuncia'");

            $alterarDenuncia->execute();

            return "Update Atualizado";


        }

    }
?>