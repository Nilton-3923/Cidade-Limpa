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

            $query = "SELECT denunciasResolvidas FROM tbAdm";
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
    }
?>