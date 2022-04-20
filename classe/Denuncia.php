<?php
    require_once("Conexao.php");

    class Denuncia{

        private $idDenuncia;

        private $descDenuncia;
        private $tituloDenuncia;
        private $dataDenuncia;

        private $cepDenuncia;
        private $ufDenuncia;
        private $bairroDenuncia;
        private $ruaDenuncia;
        private $cidadeDenuncia;

        private $idImagemDenuncia;
        private $idUsuario;
        private $idCategoria;



        //Métodos Getters

        # PK e FK
        public function getIdDenuncia(){
            return $this->idDenuncia;
        }
        public function getIdImagemDenuncia(){
            return $this->idImagemDenuncia;
        }
        public function getIdUsuario(){
            return $this->idUsuario;
        }
        public function getIdCategoria(){
            return $this->idCategoria;
        }
        

        # Descrições e data
        public function getDescDenuncia(){
            return $this->descDenuncia;
        }
        public function getTituloDenuncia(){
            return $this->tituloDenuncia;
        }
        public function getDataDenuncia(){
            return $this->dataDenuncia;
        }

        # Localização
        public function getCepDenuncia(){
            return $this->cepDenuncia;
        }
        public function getUfDenuncia(){
            return $this->ufDenuncia;
        }
        public function getBairroDenuncia(){
            return $this->bairroDenuncia;
        }
        public function getRuaDenuncia(){
            return $this->ruaDenuncia;
        }
        public function getCidadeDenuncia(){
            return $this->cidadeDenuncia;
        }


        //Métodos Setters

        #PK e FK
        public function setIdDenuncia($idDenuncia){
            $this->idDenuncia = $idDenuncia;
        }
        public function setIdImagemDenuncia($idImagemDenuncia){
            $this->idImagemDenuncia = $idImagemDenuncia;
        }
        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }
        public function setIdCategoria($idCategoria){
            $this->idCategoria = $idCategoria;
        }


        #Descrição e data
        public function setDescDenuncia($descDenuncia){
            $this->descDenuncia = $descDenuncia;
        }
        public function setTituloDenuncia($tituloDenuncia){
            $this->tituloDenuncia = $tituloDenuncia;
        }
        public function setDataDenuncia($dataDenuncia){
            $this->dataDenuncia = $dataDenuncia;
        }

        #Localização
        public function setUfDenuncia($ufDenuncia){
            $this->ufDenuncia = $ufDenuncia;
        }
        public function setBairroDenuncia($bairroDenuncia){
            $this->bairroDenuncia = $bairroDenuncia;
        }
        public function setCepDenuncia($cepDenuncia){
            $this->cepDenuncia = $cepDenuncia;
        }
        public function setRuaDenuncia($ruaDenuncia){
            $this->ruaDenuncia= $ruaDenuncia;
        }
        public function setCidadeDenuncia($cidadeDenuncia){
            $this->cidadeDenuncia = $cidadeDenuncia;
        }


        public function denunciar($denuncia){
            $conexao = Conexao::pegarConexao();

            //Cadastro da Categoria
            $categoria = "Descarte de lixo";//$_POST['categoria'];
            $stmtCat = $conexao->prepare("INSERT INTO tbCategoria VALUES(null,'$categoria')");
            $stmtCat->execute();

            $idCat = $conexao->lastInsertId();

            //Cadastro da Foto da Denuncia
            $nomeImagem = $_FILES['fotoDenuncia']['name'];
            $arquivoImagem = $_FILES['fotoDenuncia']['tmp_name'];

            $caminhoImagem = "imgDenuncia/".$nomeImagem;
            move_uploaded_file($arquivoImagem,$caminhoImagem);

            $stmtImg = $conexao->prepare("INSERT INTO tbImgdenun VALUES(null,'$caminhoImagem')");

            $stmtImg->execute();

            $idImagem = $conexao->lastInsertId();

            //Cadastro da Denúncia
            $stmtDenuncia = $conexao->prepare(
                "INSERT INTO tbDenuncia
                    (tituloDenuncia,descDenuncia,dataDenuncia,ufDenuncia,bairroDenuncia,cepDenuncia,ruaDenuncia,cidadeDenuncia,fk_idUsuario,fk_idImgDenun,fk_idCategoria)
                        VALUES (?,?,?,?,?,?,?,?,?,'$idImagem','$idCat')"
            );

            $stmtDenuncia->bindValue(1,$denuncia->getTituloDenuncia());
            $stmtDenuncia->bindValue(2,$denuncia->getDescDenuncia());
            $stmtDenuncia->bindValue(3,$denuncia->getDataDenuncia());

            $stmtDenuncia->bindValue(4,$denuncia->getUfDenuncia());
            $stmtDenuncia->bindValue(5,$denuncia->getBairroDenuncia());
            $stmtDenuncia->bindValue(6,$denuncia->getCepDenuncia());
            $stmtDenuncia->bindValue(7,$denuncia->getRuaDenuncia());
            $stmtDenuncia->bindValue(8,$denuncia->getCidadeDenuncia());

            $stmtDenuncia->bindValue(9,$denuncia->getIdUsuario());

            $stmtDenuncia->execute();
            

        }






    }




?>