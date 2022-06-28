<!--------NILTON EDITOU(PEGAR TUDO)--------->
<?php 

    require_once("Conexao.php");

    class Adm{


        private $idRespAdm;
        private $dataResp;
        private $idDenuncia;
        private $idAdm;
        private $respAdm;
        private $verificacao;

        //Métodos Getters
        public function getIdResp(){
            return $this->idRespAdm;
        }
        public function getDataResp(){
            return $this->dataResp;
        }
        public function getIdDenuncia(){
            return $this->idDenuncia;
        }
        public function getIdAdm(){
            return $this->idAdm;
        }
        public function getRespAdm(){
            return $this->respAdm;
        }
        public function getVerificacao(){
            return $this->verificacao;
        }

        //Métodos Setters
        public function setIiRespAdm($idRespAdm){
            $this->idRespAdm = $idRespAdm;
        }
        public function setDataResp($dataResp){
            $this->dataResp = $dataResp;
        }
        public function setIdDenuncia($idDenuncia){
            $this->idDenuncia = $idDenuncia;
        }
        public function setIdAdm($idAdm){
            $this->idAdm = $idAdm;
        }
        public function setRespAdm($respAdm){
            $this->respAdm = $respAdm;
        }
        public function setVerificacao($verificacao){
            $this->verificacao = $verificacao;
        }

        //Método de cadastrar resposta do Adm
        public function cadastrar($resposta){
            $conexao = Conexao::pegarConexao();
            $stmt = $conexao->prepare("INSERT INTO tbrespadm 
                                        (
                                         dataRespAdm, #1
                                         textoRespAdm,#2
                                         denunciaVerificada, #3
                                         fk_idDenuncia, #4
                                         fk_idAdm #5
                                        )
                                        VALUES(?,?,?,?,?)");
            $stmt->bindValue(1,$resposta->getDataResp());
            $stmt->bindValue(2,$resposta->getRespAdm());
            $stmt->bindValue(3,$resposta->getVerificacao());
            $stmt->bindValue(4,$resposta->getIdDenuncia());
            $stmt->bindValue(5,$resposta->getIdAdm());
           

            $stmt->execute();
        }
        public function respostaAdm($idusuario){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT pk_idRespAdm,pk_idDenuncia,dataRespAdm,tituloDenuncia,bairroDenuncia,dataDenuncia,cepDenuncia,ruaDenuncia,
                        imgDenuncia,emailUsuario,textoRespAdm FROM tbRespAdm
                        INNER JOIN tbDenuncia ON tbRespAdm.fk_idDenuncia = tbDenuncia.pk_idDenuncia
                        INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_Usuario
                        INNER JOIN tbCategoria ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria
                        WHERE pk_Usuario = $idusuario";
            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;
        }


        //********** MÉTODOS GRÁFICOS */
        //Método de ver Denuncias filtradas por zona(Gráfico)
        public function filtroCategoria(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT COUNT(pk_idDenuncia),campoCategoria FROM tbDenuncia
                      INNER JOIN tbCategoria ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria
                      GROUP BY fk_idCategoria";

            $query = $conexao->query($query);
            $query = $query->fetchAll();
            return $query;

        }

        //Método de ver de filtrar por zona
        public function filtroZona(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT COUNT(pk_idDenuncia),zonaDenuncia FROM tbdenuncia
                      GROUP BY zonaDenuncia";
            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;
        }
        
        //Método Pra ver Número de Denúncia
        public function contagem(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT COUNT(pk_idDenuncia) FROM tbDenuncia
                        WHERE statusDenuncia LIKE 'Resolvida'";
            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;

        }
        
        //Método pra ver Denúncias não resolvidas(CONTAGEM)
        public function denunciasNaoResolvidas(){
            $conexao = Conexao::pegarConexao();

            $consulta = "SELECT COUNT(pk_idDenuncia) FROM tbDenuncia
                         WHERE statusDenuncia LIKE 'Não Resolvida'";
            $consulta = $conexao->query($consulta);

            $consulta = $consulta->fetchAll();
            return $consulta;

        }
    
        //Método de contar todos os Úsuarios
        public function contarUsers(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT COUNT(pk_Usuario) FROM tbUsuario";

            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;
        }


        //Método dados user
        public function ultimosUsers(){
            $conexao =Conexao::pegarConexao();

            $user = "SELECT * FROM tbUsuario
                    ORDER BY pk_Usuario DESC
                     LIMIT 0,5";

            $user = $conexao->query($user);

            $user = $user->fetchAll();

            return $user;
        }
        //FIM GRÁFICOSSSSSSSSSSSSSSSSSSSSSSSSSSS

        //TABELA DENUNCIA GERAL
        public function tabelaDenuncia(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT * FROM tbDenuncia
                        INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_usuario
                            INNER JOIN tbCategoria ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria
                            ORDER BY pk_idDenuncia DESC";

            $query = $conexao->query($query);   

            $query = $query->fetchAll();
            return $query;
        }

        //TABELA DENUNCIA NÃO RESOLVIDA
        public function tabelaDenunciaNaoResolvida(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT * FROM tbDenuncia
                        INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_usuario
                            INNER JOIN tbCategoria ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria
                                LEFT JOIN tbrespadm ON tbrespadm.fk_idDenuncia = tbDenuncia.pk_idDenuncia
                                WHERE statusDenuncia LIKE 'Não Resolvida' 
                                ORDER BY pk_idDenuncia DESC";

            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;
        }


        //TABELA DENUNCIA RESOLVIDA
        public function tabelaDenunciaResolvida(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT * FROM tbDenuncia
                        INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_usuario
                            INNER JOIN tbCategoria ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria
                                WHERE statusDenuncia LIKE 'Resolvida'
                                ORDER BY pk_idDenuncia DESC";

            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;
        }



//**************  USUÁRIO *************** */
        //Tabela Usuario (TODOS OS USUÁRIOOOOOO)
        public function tabelaUsuario(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT * FROM tbUsuario";

            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;
        }

        //Pesquisa usuário
        public function pesquisaUsuario($pesquisa){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT * FROM tbUsuario
                      WHERE nomeUsuario LIKE '%$pesquisa%' OR emailUsuario LIKE '%$pesquisa%' OR cepUsuario LIKE '$pesquisa'";

            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;
        }
//************ FIM TABELA USUÁRIO  *********** */

//************* TABELA DE DENÚNCIAS ****** */
        //contar todas
        public function contarTodasDenuncia(){
            $conexao = Conexao::pegarConexao();
            $query = "SELECT COUNT(pk_idDenuncia) FROM tbDenuncia";
            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;
        }
        //pesquisar todas
        public function pesquisaDenuncia($pesquisa){
            $conexao = Conexao::pegarConexao();
            $query = "SELECT * FROM tbDenuncia
                      INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_Usuario
                      INNER JOIN tbCategoria ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria
                      WHERE tituloDenuncia LIKE '%$pesquisa%' OR descDenuncia LIKE '%$pesquisa%' OR campoCategoria LIKE '%$pesquisa%'
                      OR ruaDenuncia LIKE '%$pesquisa%' OR bairroDenuncia LIKE '%$pesquisa%' OR emailUsuario LIKE '%$pesquisa%'";
             $query = $conexao->query($query);

             $query = $query->fetchAll();
             return $query;
        }


//************  FIM TABELA DENÚNCIA ******* */
        

//*********** TABELA ECOPONTO  *********** */

        //pesquisar todas
        public function pesquisaEcoponto($pesquisa){
            $conexao = Conexao::pegarConexao();
            $query = "SELECT * FROM tbEcoponto
                    WHERE logradouroEcoponto LIKE '%$pesquisa%' OR bairroEcoponto LIKE '%$pesquisa%' OR cepEcoponto LIKE '%$pesquisa%'
                    OR cidadeEcoponto LIKE '%$pesquisa%' OR numeroEcoponto LIKE '%$pesquisa%' OR zonaEcoponto LIKE '%$pesquisa%'";
            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;
        }
//**************FIM DA TABELA ECOPONTO******** */
        //Tabela Categoria
        public function tabelaCategoria(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT * FROM tbCategoria";

            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;
        }

        //Tabela Ecoponto
        public function tabelaEcopontoContar(){
            $conexao = Conexao::pegarConexao();
        
            $query = "SELECT COUNT(pk_idEcoPonto) FROM tbEcoponto";
        
            $query = $conexao->query($query);
        
            $query = $query->fetchAll();
            return $query;
        }

        public function tabelaEcoponto(){
            $conexao = Conexao::pegarConexao();
        
            $query = "SELECT * FROM tbEcoponto";
        
            $query = $conexao->query($query);
        
            $query = $query->fetchAll();
            return $query;
        }

        


        public function denunciaRegiao($regiao){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT * FROM tbDenuncia
                        INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_usuario
                            INNER JOIN tbCategoria ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria
                                WHERE zonaDenuncia LIKE '%$regiao%'
                                    ORDER BY pk_idDenuncia DESC";

            $query = $conexao->query($query);
            $query = $query->fetchAll();
            return $query;
        }

        public function pesquisarCep($cep){
            
            $cep  = preg_replace('/[^0-9]/','', $cep);
            
            if (preg_match('/^[0-9]{5}-?[0-9]{3}$/', $cep)){
                $url = "https://viacep.com.br/ws/$cep/json/";
                
                $json = file_get_contents($url);
                $data = json_decode($json);
    
                $logradouro = $data -> logradouro;
                $bairro = $data -> bairro;
                $localidade = $data -> localidade;
                $uf = $data -> uf;
    
                $enderecoJunto = "$logradouro, $bairro, $localidade - $uf";

                $addr = str_replace(" ", "+","$enderecoJunto");

                $address = utf8_encode($addr);

                return $address;
            }else{
                return "erro";
            }
        }

        public function validacaoEndereco($endereco){
            $endereco .=", São Paulo - SP";
            $addr = str_replace(" ", "+","$endereco");

            return $addr;
        }

        public function pesquisarMapa($localizacao){
            
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$localizacao&key=AIzaSyAo1uIjwfM3QBcwPKKDVuXv0z8eJlQGcYE";
        
            $json = file_get_contents($url);
            $data = json_decode($json);
    
            $lat = $data->results[0]->geometry->location->lat;
            $long = $data->results[0]->geometry->location->lng;

            $coordenada = "lat: $lat, lng: $long"; 

            if (empty($coordenada)){
                return "erro";
            }else {
                return $coordenada; 
            }
    
        }

        public function updateStatus($idDenuncia){
            $conexao = Conexao::pegarConexao();

            $verficarDenuncia = $conexao->prepare("UPDATE tbDenuncia 
                                                    SET
                                                    statusDenuncia = 'Resolvida'
                                                        WHERE pk_idDenuncia = '$idDenuncia'");

            $verficarDenuncia->execute();


        }

        public function verificarDenunciAdm($idDenuncia){
            $conexao = Conexao::pegarConexao();

            $verficarDenuncia = $conexao->prepare("UPDATE tbDenuncia 
                                                    SET
                                                    verificacaoAdm = 'TRUE'
                                                        WHERE pk_idDenuncia = '$idDenuncia'");

            $verficarDenuncia->execute();


        }

    }
?>