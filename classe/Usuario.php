<?php

    require_once("Conexao.php");

    class Usuario{
        //Atributos do Úsuario

        private $idUsuario;
        private $nomeUsuario;
        private $sobrenomeUsuario;
        private $emailUsuario;
        private $cepUsuario;

        //Métodos Getters 
        public function getIdUsuario(){
            return $this->idUsuario;
        }
        public function getNomeUsuario(){
            return $this->nomeUsuario;
        }
        public function getSobreNomeUsuario(){
            return $this->sobrenomeUsuario;
        }
        public function getEmailUsuario(){
            return $this->emailUsuario;
        }
        public function getCepUsuario(){
            return $this->cepUsuario;
        }

        

        //Métodos Setters

        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }
        public function setNomeUsuario($nomeUsuario){
            $this->nomeUsuario = $nomeUsuario;
        }
        public function setSobreNomeUsuario($sobrenomeUsuario){
            $this->sobrenomeUsuario = $sobrenomeUsuario;
        }
        public function setEmailUsuario($emailUsuario){
            $this->emailUsuario = $emailUsuario;
        }
        public function setCepUsuario($cepUsuario){
            $this->cepUsuario = $cepUsuario;
        }


        //parte de telefone 
        //Getters
        public function getIdTelUsuario(){
            return $this->idTelUsuario;
        }

        public function getNumTelUsuario(){
            return $this->numTelUsuario;
        }
        //Setters
        public function setIdTelUsuario($idTelUsuario){
            $this->idTelUsuario = $idTelUsuario;
        }

        public function setNumTelUsuario($numTelUsuario){
            $this->numTelUsuario = $numTelUsuario;
        }


        //Método de Inserir (Insert)

        public function cadastrar($usuario){
            
            $conexao = Conexao::pegarConexao();
            
            $stmt = $conexao->prepare("INSERT INTO tbUsuario(nomeUsuario,
                                    sobreNomeUsuario,emailUsuario,cepUsuario)
            VALUES (?,?,?,?)");

            $stmt->bindValue(1,$usuario->getNomeUsuario());
            $stmt->bindValue(2,$usuario->getSobreNomeUsuario());
            $stmt->bindValue(3,$usuario->getEmailUsuario());
            $stmt->bindValue(4,$usuario->getcepUsuario());

            

            $stmt->execute();
            $id = $conexao->lastInsertId();
            // cadastro do telefone
            $tel = $_POST['telefone'];
            $stmt1 = $conexao->prepare("INSERT INTO tbTelUsuario VALUES(null,'$tel','$id');");	
            $stmt1 ->execute();

        }
    }

?>