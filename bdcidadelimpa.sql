-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Abr-2022 às 19:00
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdcidadelimpa`
--

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
(1, ''),
(2, ''),
(3, ''),
(4, ''),
(5, ''),
(6, ''),
(7, ''),
(8, 'Descarte de lixo'),
(9, 'Descarte de lixo'),
(10, 'Descarte de lixo'),
(11, 'Descarte de lixo'),
(12, 'Descarte de lixo'),
(13, 'Descarte de lixo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdenuncia`
--

CREATE TABLE `tbdenuncia` (
  `pk_idDenuncia` int(11) NOT NULL,
  `tituloDenuncia` varchar(30) NOT NULL,
  `descDenuncia` varchar(255) NOT NULL,
  `dataDenuncia` date NOT NULL,
  `ufDenuncia` varchar(2) NOT NULL,
  `bairroDenuncia` varchar(50) NOT NULL,
  `cepDenuncia` varchar(8) DEFAULT NULL,
  `ruaDenuncia` varchar(50) DEFAULT NULL,
  `cidadeDenuncia` varchar(50) DEFAULT NULL,
  `fk_idImgDenun` int(11) DEFAULT NULL,
  `fk_idUsuario` int(11) DEFAULT NULL,
  `fk_idCategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbdenuncia`
--

INSERT INTO `tbdenuncia` (`pk_idDenuncia`, `tituloDenuncia`, `descDenuncia`, `dataDenuncia`, `ufDenuncia`, `bairroDenuncia`, `cepDenuncia`, `ruaDenuncia`, `cidadeDenuncia`, `fk_idImgDenun`, `fk_idUsuario`, `fk_idCategoria`) VALUES
(1, '', '', '0000-00-00', 'SP', 'Jardim Bartira', '08152130', 'Rua Carrossel', 'São Paulo', 9, 1, 9),
(4, '', '', '2022-04-20', 'SP', 'Jardim Bartira', '08152130', 'Rua Carrossel', 'São Paulo', 12, 1, 12),
(5, '', '', '2022-04-20', 'SP', 'Jardim Bartira', '08152130', 'Rua Carrossel', 'São Paulo', 13, 1, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbimgdenun`
--

CREATE TABLE `tbimgdenun` (
  `pk_idImgDenun` int(11) NOT NULL,
  `imgDenuncia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbimgdenun`
--

INSERT INTO `tbimgdenun` (`pk_idImgDenun`, `imgDenuncia`) VALUES
(1, 'imgDenuncia/Desert.jpg'),
(2, 'imgDenuncia/Hydrangeas.jpg'),
(3, 'imgDenuncia/'),
(4, 'imgDenuncia/'),
(5, 'imgDenuncia/'),
(6, 'imgDenuncia/'),
(7, 'imgDenuncia/'),
(8, 'imgDenuncia/'),
(9, 'imgDenuncia/'),
(10, 'imgDenuncia/'),
(11, 'imgDenuncia/'),
(12, 'imgDenuncia/'),
(13, 'imgDenuncia/');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbimgusuario`
--

CREATE TABLE `tbimgusuario` (
  `pk_idImgUsuario` int(11) NOT NULL,
  `imgUsuario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbimgusuario`
--

INSERT INTO `tbimgusuario` (`pk_idImgUsuario`, `imgUsuario`) VALUES
(1, 'imgUsuario/Koala.jpg');

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
(1, '11985722916', 1);

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
  `fk_idImgUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`pk_Usuario`, `nomeUsuario`, `emailUsuario`, `senhaUsuario`, `cepUsuario`, `fk_idImgUsuario`) VALUES
(1, 'Nilton ', 'nilton@gmail.com', '123', '08152-13', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  ADD PRIMARY KEY (`pk_idCategoria`);

--
-- Índices para tabela `tbdenuncia`
--
ALTER TABLE `tbdenuncia`
  ADD PRIMARY KEY (`pk_idDenuncia`),
  ADD UNIQUE KEY `fk_idImgDenun` (`fk_idImgDenun`),
  ADD KEY `fk_idUsuario` (`fk_idUsuario`) USING BTREE,
  ADD KEY `fk_idCategoria` (`fk_idCategoria`) USING BTREE,
  ADD KEY `fk_idUsuario_2` (`fk_idUsuario`) USING BTREE;

--
-- Índices para tabela `tbimgdenun`
--
ALTER TABLE `tbimgdenun`
  ADD PRIMARY KEY (`pk_idImgDenun`);

--
-- Índices para tabela `tbimgusuario`
--
ALTER TABLE `tbimgusuario`
  ADD PRIMARY KEY (`pk_idImgUsuario`);

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
  ADD PRIMARY KEY (`pk_Usuario`),
  ADD UNIQUE KEY `fk_idImgUsuario` (`fk_idImgUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  MODIFY `pk_idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tbdenuncia`
--
ALTER TABLE `tbdenuncia`
  MODIFY `pk_idDenuncia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tbimgdenun`
--
ALTER TABLE `tbimgdenun`
  MODIFY `pk_idImgDenun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tbimgusuario`
--
ALTER TABLE `tbimgusuario`
  MODIFY `pk_idImgUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbtelusuario`
--
ALTER TABLE `tbtelusuario`
  MODIFY `pk_TelUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `pk_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tbdenuncia`
--
ALTER TABLE `tbdenuncia`
  ADD CONSTRAINT `tbdenuncia_ibfk_1` FOREIGN KEY (`fk_idCategoria`) REFERENCES `tbcategoria` (`pk_idCategoria`),
  ADD CONSTRAINT `tbdenuncia_ibfk_2` FOREIGN KEY (`fk_idImgDenun`) REFERENCES `tbimgdenun` (`pk_idImgDenun`),
  ADD CONSTRAINT `tbdenuncia_ibfk_3` FOREIGN KEY (`fk_idUsuario`) REFERENCES `tbusuario` (`pk_Usuario`);

--
-- Limitadores para a tabela `tbtelusuario`
--
ALTER TABLE `tbtelusuario`
  ADD CONSTRAINT `tbtelusuario_ibfk_1` FOREIGN KEY (`fk_idUsuario`) REFERENCES `tbusuario` (`pk_Usuario`);

--
-- Limitadores para a tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD CONSTRAINT `tbusuario_ibfk_1` FOREIGN KEY (`fk_idImgUsuario`) REFERENCES `tbimgusuario` (`pk_idImgUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
