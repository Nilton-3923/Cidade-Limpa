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

        //tabela Denuncia
        public function tabelaDenuncia($limitar){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT * FROM tbDenuncia
                      INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_usuario
                      INNER JOIN tbCategoria ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria

                      LIMIT 0,$limitar";

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

    }
?>