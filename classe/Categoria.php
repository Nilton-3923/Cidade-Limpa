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
        public function cadastrar($categoria){
            $conexao = Conexao::pegarConexao();

            $stmt = $conexao->prepare("INSERT INTO tbCategoria (campoCategoria) 
                                       VALUES(?)");
            $stmt->bindValue(1,$categoria->getCampoCategoria());

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
    }







?>