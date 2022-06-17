<?php
    require_once("Conexao.php");

    class Categoria{

        private $idCategoria;
        private $campoCategoria;

        //Métodos Getters

        public function getIdCategoria(){
            return $this->idCategoria;
        }
        public function getCampoCategoria(){
            return $this->campoCategoria;
        } 

        //Métodos Setters

        public function setIdCategoria($idCategoria){
            $this->idCategoria = $idCategoria;
        }
        public function setCampoCategoria($campoCategoria){
            $this->campoCategoria = $campoCategoria;
        }

        //Método de Inserção (INSERT)
        public function cadastrar($campoCategoria){
            $conexao = Conexao::pegarConexao();

            $stmt = $conexao->prepare("INSERT INTO tbCategoria (campoCategoria) 
                                       VALUES(?)");
            $stmt->bindValue(1,$campoCategoria->getCampoCategoria());

            $stmt->execute();       
        }

        //Método de Mostrar as categorias cadastradas (SELECT)
        public function listar(){
            $conexao = Conexao::pegarConexao();
            $query = ("SELECT * FROM tbCategoria");

            $query = $conexao->query($query);

            $query = $query->fetchAll();

            return $query;
        }
         //Método de Deletar Categoria(DELETE)
         public function deletarCategoria($idCategoria){
            $conexao = Conexao::pegarConexao();

            $deletarDenuncia = $conexao->prepare("DELETE FROM tbDenuncia
                                                    WHERE fk_idCategoria = $idCategoria");

            $deletarDenuncia->execute();

            $deleteCategoria = $conexao->prepare("DELETE FROM tbCategoria
                                                WHERE pk_idCategoria = $idCategoria");

            $deleteCategoria->execute();

            

            return 'deletado';
        }

         //Método de Alterar Categoria
         public function alterar($idCategoria, $campoCategoria){
            $conexao = Conexao::pegarConexao();

            $alterarCategoria = $conexao->prepare("UPDATE tbCategoria
                                                    SET
                                                    campoCategoria = '$campoCategoria'
                                                        WHERE pk_idCategoria = '$idCategoria'");

            $alterarCategoria->execute();


            return "Update realizado";      
        }
    }







?>