<?php 
    require_once("Conexao.php");

    class Adm{

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

            $query = "SELECT denunciaReslvAdm FROM tbAdm";
            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;

        }
        
        //Método pra ver Denúncias não resolvidas
        public function denunciasNaoResolvidas(){
            $conexao = Conexao::pegarConexao();

            $consulta = "SELECT COUNT(pk_idDenuncia) FROM tbDenuncia";
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

        //TABELA DENUNCIA GERAL
        public function tabelaDenuncia(){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT * FROM tbDenuncia
                        INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_usuario
                            INNER JOIN tbCategoria ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria";

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
                                WHERE statusDenuncia LIKE 'Não Resolvida'";

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
                                WHERE statusDenuncia LIKE 'Resolvida'";

            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;
        }




        //Tabela Usuario
        public function tabelaUsuario($limitar){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT * FROM tbUsuario
                      LIMIT 0,$limitar";

            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;
        }
        
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

        public function tabelaEcoponto($limitar){
            $conexao = Conexao::pegarConexao();
        
            $query = "SELECT * FROM tbEcoponto
                      LIMIT 0,$limitar";
        
            $query = $conexao->query($query);
        
            $query = $query->fetchAll();
            return $query;
        }

        


        public function denunciaRegiao($regiao){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT * FROM tbDenuncia
                      INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_usuario
                      INNER JOIN tbCategoria ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria
                      WHERE zonaDenuncia LIKE '%$regiao%'";

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