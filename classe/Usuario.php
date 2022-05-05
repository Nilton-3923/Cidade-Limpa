<?php
    
    require_once("Conexao.php");

    class Usuario{
        //Atributos do Úsuario

        private $idUsuario;
        private $nomeUsuario;
        private $senhaUsuario;
        private $emailUsuario;
        private $cepUsuario;
        private $fotoUsuario;

        //Métodos Getters 
        public function getFotoUsuario(){
            return $this->fotoUsuario;
        }
        public function getIdUsuario(){
            return $this->idUsuario;
        }
        public function getNomeUsuario(){
            return $this->nomeUsuario;
        }
        public function getSenhaUsuario(){
            return $this->senhaUsuario;
        }
        public function getEmailUsuario(){
            return $this->emailUsuario;
        }
        public function getCepUsuario(){
            return $this->cepUsuario;
        }

        

        //Métodos Setters
        public function setFotoUsuario($fotoUsuario){
            $this->fotoUsuario = $fotoUsuario;
        }
        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }
        public function setNomeUsuario($nomeUsuario){
            $this->nomeUsuario = $nomeUsuario;
        }
        public function setSenhaUsuario($senhaUsuario){
            $this->senhaUsuario = $senhaUsuario;
        }
        public function setEmailUsuario($emailUsuario){
            $this->emailUsuario = $emailUsuario;
        }
        public function setCepUsuario($cepUsuario){
            $this->cepUsuario = $cepUsuario;
        }


        //***********  MÉTODOS *************/


        //Método de Cadastro do Usuario (Insert)
        public function cadastrar($usuario){
            
            $conexao = Conexao::pegarConexao();
            //Inseção da Imagem
            $nomeImagem = $_FILES['fotoUsuario']['name'];
            $arquivoImagem = $_FILES['fotoUsuario']['tmp_name'];

            $caminhoImagem = "imgUsuario/".$nomeImagem;
            move_uploaded_file($arquivoImagem,$caminhoImagem);

            $stmtImg  = $conexao->prepare("INSERT INTO tbImgusuario VALUES(null,'$caminhoImagem')");
            $stmtImg->execute();

            $idImagem = $conexao->lastInsertId();//id da Imagem recém cadastrada


            //Inserção do Usuario
            $stmt = $conexao->prepare("INSERT INTO tbUsuario(nomeUsuario,senhaUsuario,emailUsuario,cepUsuario,fk_idImgUsuario) 
            VALUES (?,?,?,?,'$idImagem')");

            $stmt->bindValue(1,$usuario->getNomeUsuario());
            $stmt->bindValue(2,$usuario->getSenhaUsuario());
            $stmt->bindValue(3,$usuario->getEmailUsuario());
            $stmt->bindValue(4,$usuario->getcepUsuario());

            $stmt->execute();
            $idTelefone = $conexao->lastInsertId();//id do Usuario Recém cadastrados

            // Inserção do telefone
            $tel = $_POST['telefone'];
            $stmtTel = $conexao->prepare("INSERT INTO tbTelUsuario VALUES(null,'$tel','$idTelefone');");	
            $stmtTel ->execute();

        }

        //Método de Login do Úsuario
        public function login($email,$senha){
 
            $conexao = Conexao::pegarConexao();

            $stmt = "SELECT * FROM tbusuario WHERE emailUsuario = :emailUsuario AND senhaUsuario = :senhaUsuario";

            $stmt = $conexao->prepare($stmt);

            $stmt->bindValue("emailUsuario",$email);
            $stmt->bindValue("senhaUsuario",$senha);

            $stmt->execute();

            //Verificando os usuarios que tem esse parâmetros
            if($stmt->rowCount()>0){
                $dados = $stmt->fetch();
                session_start();
                $_SESSION['idUsuario'] = $dados['pk_Usuario'];

                return true;
            }
            else{
                return false;
            
            }
        }
        //Método para mostrar as Denúncias que o úsuario já fez
        public function denunciasFeita(){
            $conexao = Conexao::pegarConexao();
            
           
            $id = $_SESSION['idUsuario'];
            $query = "SELECT imgDenuncia,nomeUsuario,imgUsuario,tituloDenuncia,descDenuncia,dataDenuncia,cepDenuncia FROM tbDenuncia
                      INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_Usuario
                      INNER JOIN tbImgUsuario ON tbUsuario.fk_idImgUsuario = tbImgUsuario.pk_idImgUsuario
                      INNER JOIN tbImgDenun ON tbDenuncia.fk_idImgDenun = tbImgDenun.pk_idImgDenun
                      WHERE pk_Usuario = $id";

            $query = $conexao->query($query);

            $query = $query->fetchAll();

            return $query;
        }

        //Método de Vizualizar o perfil
        public function perfil(){
            $conexao = Conexao::pegarConexao();

            $id = $_SESSION['idUsuario'];

            $query = "SELECT nomeUsuario, emailUsuario, senhaUsuario, numTelUsuario, imgUsuario FROM tbusuario 
                        INNER JOIN tbtelusuario
                            ON tbtelusuario.fk_idUsuario = tbusuario.pk_Usuario
                                INNER JOIN tbimgusuario
                                    ON tbimgusuario.pk_idImgUsuario = tbusuario.fk_idImgUsuario
                                    WHERE pk_Usuario = $id";
            $query = $conexao->query($query);

            $query = $query->fetchAll();

            return $query;
        }


        //Método de o próprio usuario deletar a conta (DELETE)
        public function deletar(){
            $conexao = Conexao::pegarConexao();

            $id = $_SESSION['idUsuario'];

            $deleteTel = $conexao->prepare("DELETE FROM tbTelUsuario
                                        WHERE fk_idUsuario = $id");

            $deleteTel->execute();

            $deleteUsuario = $conexao->prepare("DELETE FROM tbUsuario
                                        WHERE pk_Usuario = $id");

            $deleteUsuario->execute();

        }

        //Método de Alterar Usuario
        public function alterar($id, $nome, $tel, $senha, $idImg){
            $conexao = Conexao::pegarConexao();

            $alterarUsuario = $conexao->prepare("UPDATE tbUsuario 
                                                    SET
                                                    nomeUsuario = '$nome'
                                                    ,senhaUsuario = '$senha'
                                                    ,fk_idImgUsuario = '$idImg'
                                                        WHERE pk_Usuario = '$id'");

            $alterarUsuario->execute();

            $alterarTel = $conexao->prepare("UPDATE tbTelUsuario
                                                SET 
                                                    numTelUsuario = '$tel'
                                                    WHERE fk_idUsuario = '$id'");


            $alterarTel->execute();

            return "Update realizado";      
        }


        //Método de Alterar Imagem do Usuario
        public function alterarImg($caminhoImagem){
            $conexao = Conexao::pegarConexao();

            $alterarFoto = $conexao->prepare("INSERT INTO tbImgusuario VALUES(null,'$caminhoImagem')");

            $alterarFoto->execute();

            $idImg = $conexao->lastInsertId();

            return $idImg;
        }
    }

?>