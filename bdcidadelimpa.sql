-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Jun-2022 às 19:21
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdcidadelimpa1`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_denunciaFeita` (IN `pk_idDenuncia` INT, IN `imgDenuncia` VARCHAR(150), IN `nomeUsuario` VARCHAR(150), IN `imgUsuario` VARCHAR(500), IN `tituloDenuncia` VARCHAR(30), IN `descDenuncia` VARCHAR(255), IN `dataDenuncia` DATE, IN `cepDenuncia` VARCHAR(8), IN `fk_idUsuario` INT, IN `pk_Usuario` INT)  SELECT pk_idDenuncia, imgDenuncia,nomeUsuario,imgUsuario,tituloDenuncia,descDenuncia,dataDenuncia,cepDenuncia FROM tbDenuncia
                      INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_Usuario
                      WHERE pk_Usuario = pk_Usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_loginUsuario` (IN `emailUsuario` VARCHAR(150), IN `senhaUsuario` VARCHAR(150))  SELECT * FROM tbusuario WHERE emailUsuario = emailUsuario AND senhaUsuario = senhaUsuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_mostrarDenuncia` (IN `imgDenuncia` VARCHAR(500), IN `imgUsuario` VARCHAR(500), IN `nomeUsuario` VARCHAR(150), IN `tituloDenuncia` VARCHAR(30), IN `descDenuncia` VARCHAR(255), IN `dataDenuncia` DATE, IN `ufDenuncia` VARCHAR(2), IN `bairroDenuncia` VARCHAR(50), IN `cepDenuncia` VARCHAR(8), IN `ruaDenuncia` VARCHAR(50), IN `cidadeDenuncia` VARCHAR(50), IN `fk_idUsuario` INT, IN `pk_Usuario` INT)  SELECT imgDenuncia,imgUsuario,nomeUsuario,tituloDenuncia,descDenuncia,dataDenuncia,ufDenuncia,bairroDenuncia,cepDenuncia,ruaDenuncia,cidadeDenuncia FROM tbDenuncia
INNER JOIN tbUsuario ON tbDenuncia.fk_idUsuario = tbUsuario.pk_Usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_mostrarpontosmapa` (IN `coordeDenuncia` VARCHAR(50), IN `tituloDenuncia` VARCHAR(30), IN `descDenuncia` VARCHAR(255), IN `cepDenuncia` VARCHAR(8), IN `dataDenuncia` DATE, IN `campoCategoria` VARCHAR(100), IN `imgDenuncia` VARCHAR(500), IN `pk_idCategoria` INT, IN `fk_idCategoria` INT)  SELECT coordeDenuncia, tituloDenuncia, descDenuncia, cepDenuncia, DATE_FORMAT(`dataDenuncia`,'%d/%m/%Y') as dataDenuncia, campoCategoria,imgDenuncia FROM tbDenuncia 
                INNER JOIN tbcategoria 
                    ON tbcategoria.pk_idCategoria = tbdenuncia.fk_idCategoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_pesquisardenuncia` (IN `tituloDenuncia` VARCHAR(30), IN `descDenuncia` VARCHAR(255), IN `dataDenuncia` DATE, IN `nomeUsuario` VARCHAR(150), IN `imgUsuario` VARCHAR(500), IN `cepDenuncia` VARCHAR(8), IN `imgDenuncia` VARCHAR(500), IN `pk_Usuario` INT, IN `fk_idUsuario` INT)  SELECT tituloDenuncia,descDenuncia,dataDenuncia,nomeUsuario,imgUsuario,cepDenuncia,imgDenuncia FROM tbDenuncia
                      INNER JOIN tbUsuario ON tbUsuario.pk_Usuario = tbDenuncia.fk_idUsuario
                      WHERE tituloDenuncia LIKE '%$pesquisar%' OR descDenuncia LIKE '%$pesquisar%' OR nomeUsuario LIKE '%$pesquisar%'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_visualizarPerf` (IN `nomeUsuario` VARCHAR(150), IN `emailUsuario` VARCHAR(150), IN `senhaUsuario` VARCHAR(150), IN `numTelUsuario` VARCHAR(11), IN `imgUsuario` VARCHAR(500), IN `fk_idUsuario` INT, IN `pk_Usuario` INT)  SELECT nomeUsuario, emailUsuario, senhaUsuario, numTelUsuario, imgUsuario FROM tbusuario 
                        INNER JOIN tbtelusuario
                            ON tbtelusuario.fk_idUsuario = tbusuario.pk_Usuario
                                    WHERE pk_Usuario = pk_Usuario$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbadm`
--

CREATE TABLE `tbadm` (
  `pk_idAdm` int(11) NOT NULL,
  `nomeAdm` varchar(150) NOT NULL,
  `sobrenomeAdm` varchar(150) NOT NULL,
  `emailAdm` varchar(200) NOT NULL,
  `cep` varchar(14) NOT NULL,
  `senhaAdm` varchar(200) NOT NULL,
  `denunciaReslvAdm` int(11) NOT NULL,
  `imagemAdm` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoria`
--

CREATE TABLE `tbcategoria` (
  `pk_idCategoria` int(11) NOT NULL,
  `campoCategoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbcategoria`
--

INSERT INTO `tbcategoria` (`pk_idCategoria`, `campoCategoria`) VALUES
(1, 'Descarte Irregular de Lixo'),
(2, 'Casos de Dengue');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbchatbot`
--

CREATE TABLE `tbchatbot` (
  `pk_idChatBot` int(11) NOT NULL,
  `textoChatBot` varchar(300) NOT NULL,
  `fk_idUsuario` int(11) NOT NULL,
  `fk_idEcoponto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdenuncia`
--

CREATE TABLE `tbdenuncia` (
  `pk_idDenuncia` int(11) NOT NULL,
  `tituloDenuncia` varchar(30) NOT NULL,
  `descDenuncia` varchar(255) NOT NULL,
  `imgDenuncia` varchar(500) NOT NULL,
  `dataDenuncia` date NOT NULL,
  `ufDenuncia` varchar(2) NOT NULL,
  `bairroDenuncia` varchar(50) NOT NULL,
  `cepDenuncia` varchar(8) NOT NULL,
  `ruaDenuncia` varchar(50) NOT NULL,
  `cidadeDenuncia` varchar(50) NOT NULL,
  `coordeDenuncia` varchar(50) NOT NULL,
  `zonaDenuncia` varchar(15) NOT NULL,
  `fk_idUsuario` int(11) NOT NULL,
  `fk_idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbdenuncia`
--

INSERT INTO `tbdenuncia` (`pk_idDenuncia`, `tituloDenuncia`, `descDenuncia`, `imgDenuncia`, `dataDenuncia`, `ufDenuncia`, `bairroDenuncia`, `cepDenuncia`, `ruaDenuncia`, `cidadeDenuncia`, `coordeDenuncia`, `zonaDenuncia`, `fk_idUsuario`, `fk_idCategoria`) VALUES
(1, 'Lixo ', 'Lixo', 'imgDenuncia/Lixo.jpg', '2022-05-13', 'SP', 'Bela Vista', '06060220', 'Rua Alberto Torres', 'Osasco', 'lat: -23.5544783, lng: -46.7843427', '', 6, 1),
(2, 'Lixo Zona Norte', 'Lixo está incomodando moradores da região', 'imgDenuncia/lixo-ramos.jpg', '2022-05-13', 'SP', 'Bela Vista', '06060220', 'Rua Alberto Torres', 'Osasco', 'lat: -23.5544783, lng: -46.7843427', '', 6, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbecoponto`
--

CREATE TABLE `tbecoponto` (
  `pk_idEcoponto` int(11) NOT NULL,
  `ufEcoponto` varchar(2) NOT NULL,
  `logradouroEcoponto` varchar(50) NOT NULL,
  `bairroEcoponto` varchar(50) NOT NULL,
  `cepEcoponto` varchar(9) NOT NULL,
  `ruaEcoponto` varchar(100) NOT NULL,
  `coordeEcoponto` varchar(50) NOT NULL,
  `zonaEcoponto` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtelusuario`
--

CREATE TABLE `tbtelusuario` (
  `pk_TelUsuario` int(11) NOT NULL,
  `numTelUsuario` varchar(11) NOT NULL,
  `fk_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbtelusuario`
--

INSERT INTO `tbtelusuario` (`pk_TelUsuario`, `numTelUsuario`, `fk_idUsuario`) VALUES
(1, '(11) 97791-', 1),
(6, '', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `pk_Usuario` int(11) NOT NULL,
  `nomeUsuario` varchar(150) NOT NULL,
  `emailUsuario` varchar(150) NOT NULL,
  `senhaUsuario` varchar(150) NOT NULL,
  `cepUsuario` varchar(8) NOT NULL,
  `imgUsuario` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`pk_Usuario`, `nomeUsuario`, `emailUsuario`, `senhaUsuario`, `cepUsuario`, `imgUsuario`) VALUES
(1, 'Gui', 'gui@gmail.com', '123', '01548000', 'imgUsuario/leno-brego.jpg'),
(6, '', 'nilton@gmail.com', '123', '', 'imgUsuario/');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbadm`
--
ALTER TABLE `tbadm`
  ADD PRIMARY KEY (`pk_idAdm`);

--
-- Índices para tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  ADD PRIMARY KEY (`pk_idCategoria`);

--
-- Índices para tabela `tbchatbot`
--
ALTER TABLE `tbchatbot`
  ADD PRIMARY KEY (`pk_idChatBot`),
  ADD KEY `fk_idUsuario` (`fk_idUsuario`),
  ADD KEY `fk_idEcoponto` (`fk_idEcoponto`);

--
-- Índices para tabela `tbdenuncia`
--
ALTER TABLE `tbdenuncia`
  ADD PRIMARY KEY (`pk_idDenuncia`),
  ADD KEY `fk_idUsuario` (`fk_idUsuario`) USING BTREE,
  ADD KEY `fk_idCategoria` (`fk_idCategoria`) USING BTREE,
  ADD KEY `fk_idUsuario_2` (`fk_idUsuario`) USING BTREE;

--
-- Índices para tabela `tbecoponto`
--
ALTER TABLE `tbecoponto`
  ADD PRIMARY KEY (`pk_idEcoponto`);

--
-- Índices para tabela `tbtelusuario`
--
ALTER TABLE `tbtelusuario`
  ADD PRIMARY KEY (`pk_TelUsuario`),
  ADD KEY `fk_idUsuario` (`fk_idUsuario`);

--
-- Índices para tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD PRIMARY KEY (`pk_Usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbadm`
--
ALTER TABLE `tbadm`
  MODIFY `pk_idAdm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  MODIFY `pk_idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbchatbot`
--
ALTER TABLE `tbchatbot`
  MODIFY `pk_idChatBot` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbdenuncia`
--
ALTER TABLE `tbdenuncia`
  MODIFY `pk_idDenuncia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbecoponto`
--
ALTER TABLE `tbecoponto`
  MODIFY `pk_idEcoponto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbtelusuario`
--
ALTER TABLE `tbtelusuario`
  MODIFY `pk_TelUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `pk_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tbchatbot`
--
ALTER TABLE `tbchatbot`
  ADD CONSTRAINT `tbchatbot_ibfk_1` FOREIGN KEY (`fk_idUsuario`) REFERENCES `tbusuario` (`pk_Usuario`),
  ADD CONSTRAINT `tbchatbot_ibfk_2` FOREIGN KEY (`fk_idEcoponto`) REFERENCES `tbecoponto` (`pk_idEcoponto`);

--
-- Limitadores para a tabela `tbdenuncia`
--
ALTER TABLE `tbdenuncia`
  ADD CONSTRAINT `tbdenuncia_ibfk_1` FOREIGN KEY (`fk_idCategoria`) REFERENCES `tbcategoria` (`pk_idCategoria`),
  ADD CONSTRAINT `tbdenuncia_ibfk_3` FOREIGN KEY (`fk_idUsuario`) REFERENCES `tbusuario` (`pk_Usuario`);

--
-- Limitadores para a tabela `tbtelusuario`
--
ALTER TABLE `tbtelusuario`
  ADD CONSTRAINT `tbtelusuario_ibfk_1` FOREIGN KEY (`fk_idUsuario`) REFERENCES `tbusuario` (`pk_Usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
