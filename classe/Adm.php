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
        //Método de Contar Úsuarios
        public function contarUsersAtivos(){
            $conexao = Conexao::pegarConexao();
            $data = getDate();
            $mes = $data['mon'];
            $ano = $data['year'];
            $mesPassado = $data['mon']-1;
            $contar = "SELECT COUNT(DISTINCT pk_Usuario),dataDenuncia FROM tbUsuario
                        INNER JOIN tbDenuncia ON tbUsuario.pk_Usuario = tbDenuncia.fk_idUsuario
                        WHERE month(dataDenuncia)=$mes AND year(dataDenuncia)=$ano OR month(dataDenuncia)=$mesPassado AND year(dataDenuncia)=$ano";

            $contar = $conexao->query($contar);

            $contar = $contar->fetchAll();

            return $contar;
        }

        public function exibi(){
            $conexao =Conexao::pegarConexao();

            $user = "SELECT * FROM tbUsuario";

            $user = $conexao->query($user);

            $user = $user->fetchAll();

            return $user;
        }



    }
?>