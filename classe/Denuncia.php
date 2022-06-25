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

        #status
        public function getStatusDenuncia(){
            return $this->statusDenuncia;
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

        #status
        public function setStatusDenuncia($statusDenuncia){
            $this->statusDenuncia = $statusDenuncia;
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
                    statusDenuncia, #12                   
                    fk_idUsuario,   #13
                    fk_idCategoria) #14
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)"
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
            $stmtDenuncia->bindValue(12,$denuncia->getStatusDenuncia());
            //Id
            $stmtDenuncia->bindValue(13,$denuncia->getIdUsuario());
            $stmtDenuncia->bindValue(14,$denuncia->getIdCategoria());

            $stmtDenuncia->execute();
        }
        

        //Método para Mostrar as Denúncias já feitas
        public function mostrar(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT imgDenuncia,imgUsuario,nomeUsuario,tituloDenuncia,descDenuncia,dataDenuncia,ufDenuncia,bairroDenuncia,cepDenuncia,ruaDenuncia,cidadeDenuncia,statusDenuncia FROM tbDenuncia
                      INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_Usuario
                      WHERE statusDenuncia NOT LIKE 'Resolvida%'
                      ORDER BY pk_idDenuncia DESC";

            $query = $conexao->query($query);

            $query = $query->fetchAll();

            return $query;

        }

        public function mostrarPontosMapa(){
            $conexao = Conexao :: pegarConexao();

            $query = "SELECT coordeDenuncia, tituloDenuncia, descDenuncia, cepDenuncia, dataDenuncia, campoCategoria,imgDenuncia,statusDenuncia FROM tbDenuncia 
                INNER JOIN tbcategoria 
                    ON tbcategoria.pk_idCategoria = tbdenuncia.fk_idCategoria 
                    WHERE statusDenuncia NOT LIKE 'Resolvida%'      
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
        public function alterar($idDenuncia, $titulo, $desc,$idCategoria){
            $conexao = Conexao::pegarConexao();

            $alterarDenuncia = $conexao->prepare("UPDATE tbDenuncia 
                                                    SET
                                                    tituloDenuncia = '$titulo'
                                                    ,descDenuncia = '$desc'
                                                    ,fk_idCategoria = '$idCategoria'
                                                        WHERE pk_idDenuncia = '$idDenuncia'");

            $alterarDenuncia->execute();


            return "Update realizado";      
        }
        public function denunciaResolvida($idDenuncia){
            $conexao = Conexao::pegarConexao();

            $alterarDenuncia = $conexao->prepare("UPDATE tbDenuncia 
                                                    SET
                                                        statusDenuncia = 'Resolvida'
                                                        WHERE pk_idDenuncia = '$idDenuncia'
                                                        ORDER BY pk_idDenuncia DESC");

            $alterarDenuncia->execute();
        }


        public function alterarImg($idDenuncia, $titulo, $desc, $caminhoImagem,$idCategoria){
            $conexao = Conexao::pegarConexao();

            $alterarDenuncia = $conexao->prepare("UPDATE tbDenuncia 
                                                    SET
                                                    tituloDenuncia = '$titulo'
                                                    ,descDenuncia = '$desc'
                                                    ,imgDenuncia = '$caminhoImagem'
                                                    ,fk_idCategoria = '$idCategoria'
                                                        WHERE pk_idDenuncia = '$idDenuncia'");

            $alterarDenuncia->execute();


            return "Update realizado";      
        }
        //Método de pesquisa
        public function pesquisar($pesquisar){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT tituloDenuncia,descDenuncia,dataDenuncia,nomeUsuario,imgUsuario,cepDenuncia,imgDenuncia FROM tbDenuncia
                      INNER JOIN tbUsuario ON tbUsuario.pk_Usuario = tbDenuncia.fk_idUsuario
                      WHERE tituloDenuncia LIKE '%$pesquisar%' OR descDenuncia LIKE '%$pesquisar%' OR nomeUsuario LIKE '%$pesquisar%' OR zonaDenuncia LIKE'%$pesquisar%'";

            $query = $conexao->query($query);
            $query = $query->fetchAll();
            return $query;
        }

        public function denunciaRegiao($regiao){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT * FROM tbDenuncia
                        INNER JOIN tbUsuario ON tbUsuario.pk_Usuario = tbDenuncia.fk_idUsuario
                            WHERE zonaDenuncia LIKE '%$regiao%'
                                ORDER BY pk_idDenuncia DESC
                      ";

            $query = $conexao->query($query);
            $query = $query->fetchAll();
            return $query;
        }
        public function denunciaCategoria($categoria){
            $conexao = Conexao::pegarConexao();
            $query = "SELECT tituloDenuncia,descDenuncia,dataDenuncia,nomeUsuario,imgUsuario,cepDenuncia,imgDenuncia FROM tbDenuncia
                      INNER JOIN tbUsuario ON tbUsuario.pk_Usuario = tbDenuncia.fk_idUsuario
                      WHERE fk_idCategoria = '$categoria'";
            $query = $conexao->query($query);
            $query = $query->fetchAll();
            return $query;
        }

        public function dataDenuncia($desc){
            $conexao = Conexao::pegarConexao();
            $query = "SELECT tituloDenuncia,descDenuncia,dataDenuncia,nomeUsuario,imgUsuario,cepDenuncia,imgDenuncia FROM tbDenuncia
                      INNER JOIN tbUsuario ON tbUsuario.pk_Usuario = tbDenuncia.fk_idUsuario
                      ORDER BY dataDenuncia $desc
                      LIMIT 0,6";
            $query = $conexao->query($query);
            $query = $query->fetchAll();
            return $query;
}

    }
?>
