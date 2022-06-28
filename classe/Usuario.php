    <?php
    
    require_once("Conexao.php");

    class Usuario{
        //Atributos do Úsuario

        private $idUsuario;
        private $nomeUsuario;
        private $senhaUsuario;
        private $emailUsuario;
        private $cepUsuario;
        private $imgUsuario;

        //Métodos Getters 
        public function getImgUsuario(){
            return $this->imgUsuario; 
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
        public function setImgUsuario($imgUsuario){
            $this->imgUsuario = $imgUsuario;
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

        //Método de verificar se o usuario já existe na hora do cadastro
        public function verificar($email,$senha){

            $conexao = Conexao::pegarConexao();

            $stmt = "SELECT * FROM tbusuario WHERE emailUsuario = :emailUsuario AND senhaUsuario = :senhaUsuario";

            $stmt = $conexao->prepare($stmt);

            $stmt->bindValue("emailUsuario",$email);
            $stmt->bindValue("senhaUsuario",$senha);

            $stmt->execute();

            //Verificando os usuarios que tem esse parâmetros
            if($stmt->rowCount()>0){
                

                return true;
            }
            else{

                return false;
            
            }
        }

        //Método de Cadastro do Usuario (Insert)
        public function cadastrar($usuario,$tel){
            
            $conexao = Conexao::pegarConexao();
            

            //Inserção do Usuario
            $stmt = $conexao->prepare("INSERT INTO tbUsuario(nomeUsuario,senhaUsuario,emailUsuario,cepUsuario,imgUsuario) 
            VALUES (?,?,?,?,?)");

            $stmt->bindValue(1,$usuario->getNomeUsuario());
            $stmt->bindValue(2,$usuario->getSenhaUsuario());
            $stmt->bindValue(3,$usuario->getEmailUsuario());
            $stmt->bindValue(4,$usuario->getcepUsuario());
            $stmt->bindValue(5,$usuario->getImgUsuario());

            $stmt->execute();
            $idUsuario = $conexao->lastInsertId();//id do Usuario Recém cadastrados

            // Inserção do telefone
            $stmtTel = $conexao->prepare("INSERT INTO tbTelUsuario VALUES(null,'$tel','$idUsuario');");	

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

                $_SESSION['idUsuario'] = $dados['pk_Usuario'];
                $_SESSION['nomeUsuario'] = $dados['nomeUsuario'];
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
            $query = "SELECT pk_idDenuncia, imgDenuncia,nomeUsuario,imgUsuario,tituloDenuncia,descDenuncia,dataDenuncia,cepDenuncia,fk_idCategoria, campoCategoria FROM tbDenuncia
                      INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_Usuario
                      INNER JOIN tbCategoria ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria
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
                                    WHERE pk_Usuario = $id";
            $query = $conexao->query($query);

            $query = $query->fetchAll();

            return $query;
        }

        public function verificarAdm(){
            $conexao = Conexao::pegarConexao();

            $idUsuario = $_SESSION['idUsuario'];

            $query = "SELECT COUNT(verificacaoAdm) FROM tbdenuncia
                        INNER JOIN tbusuario
                            ON tbUsuario.pk_Usuario = tbDenuncia.fk_idUsuario
                                WHERE pk_Usuario = $idUsuario AND verificacaoAdm = 'TRUE'
                                    GROUP BY pk_Usuario";

            $query = $conexao->query($query);

            $query = $query->fetchAll();

            return $query;
        }

        public function verificarAdmTabela(){
            $conexao = Conexao::pegarConexao();

            $idUsuario = $_SESSION['idUsuario'];

            $query = "SELECT * FROM tbdenuncia
                        INNER JOIN tbcategoria 
                                ON tbcategoria.pk_idCategoria = tbdenuncia.fk_idCategoria 
                                    WHERE fk_idUsuario = $idUsuario AND verificacaoAdm LIKE 'TRUE'";

            $query = $conexao->query($query);

            $query = $query->fetchAll();

            return $query;
        }



        //Método de o próprio usuario deletar a conta (DELETE)
        public function deletar(){
            $conexao = Conexao::pegarConexao();

            $id = $_SESSION['idUsuario'];
            
            $deleteDenuncia = $conexao->prepare("DELETE FROM tbDenuncia
                                                WHERE fk_idUsuario = '$id'");

            $deleteDenuncia->execute();

            $deleteTel = $conexao->prepare("DELETE FROM tbTelUsuario
                                        WHERE fk_idUsuario = $id");

            $deleteTel->execute();

            $deleteUsuario = $conexao->prepare("DELETE FROM tbUsuario
                                        WHERE pk_Usuario = $id");

            $deleteUsuario->execute();

        }

        //Método de Alterar Usuario com foto
        public function alterarImg($id, $nome, $tel, $senha,$caminhoImagem){
            $conexao = Conexao::pegarConexao();

            $alterarUsuario = $conexao->prepare("UPDATE tbUsuario 
                                                    SET
                                                    nomeUsuario = '$nome'
                                                    ,senhaUsuario = '$senha'
                                                    ,imgUsuario = '$caminhoImagem'
                                                        WHERE pk_Usuario = '$id'");

            $alterarUsuario->execute();

            $alterarTel = $conexao->prepare("UPDATE tbTelUsuario
                                                SET 
                                                    numTelUsuario = '$tel'
                                                    WHERE fk_idUsuario = '$id'");


            $alterarTel->execute();

        }

        //Método de Alterar sem  foto
        public function alterar($id, $nome, $tel, $senha){
            $conexao = Conexao::pegarConexao();

            $alterarUsuario = $conexao->prepare("UPDATE tbUsuario 
                                                    SET
                                                    nomeUsuario = '$nome'
                                                    ,senhaUsuario = '$senha'
                                                        WHERE pk_Usuario = '$id'");

            $alterarUsuario->execute();

            $alterarTel = $conexao->prepare("UPDATE tbTelUsuario
                                                SET 
                                                    numTelUsuario = '$tel'
                                                    WHERE fk_idUsuario = '$id'");


            $alterarTel->execute();

        }

        public function denunciaRealizada($idDenuncia){
            $conexao = Conexao::pegarConexao();

            $verficarDenuncia = $conexao->prepare("UPDATE tbDenuncia 
                                                    SET
                                                    statusDenuncia = 'Resolvida'
                                                    ,verificacaoAdm = ''
                                                        WHERE pk_idDenuncia = '$idDenuncia'");

            $verficarDenuncia->execute();
        }
        //////////////////////NILTON MUDOU


        //LIXOOOOOOOOOO
        public function respostaAdm($usuario){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT tituloDenuncia,bairroDenuncia,logradouroDenuncia,dataDenuncia,cepDenuncia,ruaDenuncia,
                      imgDenuncia,emailUsuario,textoRespAdm,ufDenuncia FROM tbRespAdm
                      INNER JOIN tbDenuncia ON tbRespAdm.fk_idDenuncia = tbDenuncia.pk_idDenuncia
                      INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_Usuario
                      INNER JOIN tbCategoria ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria
                      WHERE fk_idUsuario = '$usuario'";
            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;
        } 


        public function msgAdm($idUsuario){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT pk_idRespAdm,pk_idDenuncia, tituloDenuncia,bairroDenuncia,dataDenuncia,cepDenuncia,ruaDenuncia,
            imgDenuncia,emailUsuario,textoRespAdm,ufDenuncia FROM tbRespAdm
            INNER JOIN tbDenuncia ON tbRespAdm.fk_idDenuncia = tbDenuncia.pk_idDenuncia
                      INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_Usuario
                      INNER JOIN tbCategoria ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria
                      WHERE fk_idUsuario = '$idUsuario'";
            $query = $conexao->query($query);

            $query = $query->fetchAll();
            return $query;
        }
        

        public function contadorUsuario($usuario){
            $conexao = Conexao::pegarConexao();

            $query = "SELECT COUNT(pk_idRespAdm) FROM tbRespAdm
                      INNER JOIN tbDenuncia ON tbRespAdm.fk_idDenuncia = tbDenuncia.pk_idDenuncia
                      INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_Usuario
                      INNER JOIN tbCategoria ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria
                      WHERE pk_Usuario = '$usuario'
                      GROUP BY pk_Usuario";


            $query = $conexao->query($query);

            $query = $query->fetchAll();

            if(empty($query)){

                return 0;
            }
            else{
                return $query;
            }
        }      

    }

?>