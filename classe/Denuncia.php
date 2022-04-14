<?php
    require_once("Conexao.php");

    class Denuncia{

        private $idDenuncia;
        private $descDenuncia;
        private $tituloDenuncia;
        private $dataDenuncia;
        private $ufDenuncia;
        private $logradouroDenuncia;
        private $bairroDenuncia;
        private $cepDenuncia;
        private $idImagemDenuncia;
        private $idUsuario;
        private $idCategoria;

        private $ruaDenuncia;
        private $cidadeDenuncia;


        //Métodos Getters
        public function getIdDenuncia(){
            return $this->idDenuncia;
        }
        public function getDescDenuncia(){
            return $this->descDenuncia;
        }
        public function getTituloDenuncia(){
            return $this->tituloDenuncia;
        }
        public function getDataDenuncia(){
            return $this->dataDenuncia;
        }
        public function getUfDenuncia(){
            return $this->ufDenuncia;
        }
        public function getLogradouroDenuncia(){
            return $this->logradouroDenuncia;
        }
        public function getBairroDenuncia(){
            return $this->bairroDenuncia;
        }
        public function getCepDenuncia(){
            return $this->cepDenuncia;
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
        public function getRuaDenuncia(){
            return $this->ruaDenuncia;
        }
        public function getCidadeDenuncia(){
            return $this->cidadeDenuncia;
        }

        //Métodos Setters
        public function setIdDenuncia($idDenuncia){
            $this->idDenuncia = $idDenuncia;
        }
        public function setDescDenuncia($descDenuncia){
            $this->descDenuncia = $descDenuncia;
        }
        public function setTituloDenuncia($tituloDenuncia){
            $this->tituloDenuncia = $tituloDenuncia;
        }
        public function setDataDenuncia($dataDenuncia){
            $this->dataDenuncia = $dataDenuncia;
        }
        public function setUfDenuncia($ufDenuncia){
            $this->ufDenuncia = $ufDenuncia;
        }
        public function setLogradouroDenuncia($logradouroDenuncia){
            $this->logradouroDenuncia = $logradouroDenuncia;
        }
        public function setBairroDenuncia($bairroDenuncia){
            $this->bairroDenuncia = $bairroDenuncia;
        }
        public function setCepDenuncia($cepDenuncia){
            $this->cepDenuncia = $cepDenuncia;
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
        public function setRuaDenuncia($ruaDenuncia){
            $this->ruaDenuncia= $ruaDenuncia;
        }
        public function setCidadeDenuncia($cidadeDenuncia){
            $this->cidadeDenuncia = $cidadeDenuncia;
        }


        public function denunciar($denuncia){
            $conexao = Conexao::pegarConexao();

            //Cadastro da Categoria
            $categoria = $_POST['categoria'];
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
            $teste = 1;
            //Cadastro da Denúncia
            $stmt = $conexao->prepare("INSERT INTO tbDenuncia(tituloDenuncia,descDenuncia,dataDenuncia,ufDenuncia,
            logradouroDenuncia,bairroDenuncia,cepDenuncia,ruaDenuncia,cidadeDenuncia,fk_idImgDenun,fk_idUsuario,fk_idCategoria)
            VALUES (?,?,?,?,?,?,?,?,?,'$idImagem','$teste','$idCat')");

            $stmt->bindValue(1,$denuncia->getTituloDenuncia());
            $stmt->bindValue(2,$denuncia->getDescDenuncia());
            $stmt->bindValue(3,$denuncia->getDataDenuncia());
            $stmt->bindValue(4,$denuncia->getUfDenuncia());
            $stmt->bindValue(5,$denuncia->getLogradouroDenuncia());
            $stmt->bindValue(6,$denuncia->getBairroDenuncia());
            $stmt->bindValue(7,$denuncia->getCepDenuncia());
            $stmt->bindValue(8,$denuncia->getRuaDenuncia());
            $stmt->bindValue(9,$denuncia->getCidadeDenuncia());

            $stmt->execute();
            
        }






    }




?>