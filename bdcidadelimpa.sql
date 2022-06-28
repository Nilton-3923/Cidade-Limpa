-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Jun-2022 às 03:04
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

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
-- Estrutura da tabela `tbadm`
--

CREATE TABLE `tbadm` (
  `pk_idAdm` int(11) NOT NULL,
  `loginAdm` varchar(150) NOT NULL,
  `emailAdm` varchar(200) NOT NULL,
  `senhaAdm` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbadm`
--

INSERT INTO `tbadm` (`pk_idAdm`, `loginAdm`, `emailAdm`, `senhaAdm`) VALUES
(1, 'Adm', 'Adm@gmail.com', '123');

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
  `dataDenuncia` varchar(13) NOT NULL,
  `ufDenuncia` varchar(2) NOT NULL,
  `bairroDenuncia` varchar(50) NOT NULL,
  `cepDenuncia` varchar(9) NOT NULL,
  `ruaDenuncia` varchar(50) NOT NULL,
  `cidadeDenuncia` varchar(50) NOT NULL,
  `coordeDenuncia` varchar(50) NOT NULL,
  `zonaDenuncia` varchar(15) NOT NULL,
  `statusDenuncia` varchar(50) NOT NULL,
  `fk_idUsuario` int(11) NOT NULL,
  `fk_idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbdenuncia`
--

INSERT INTO `tbdenuncia` (`pk_idDenuncia`, `tituloDenuncia`, `descDenuncia`, `imgDenuncia`, `dataDenuncia`, `ufDenuncia`, `bairroDenuncia`, `cepDenuncia`, `ruaDenuncia`, `cidadeDenuncia`, `coordeDenuncia`, `zonaDenuncia`, `statusDenuncia`, `fk_idUsuario`, `fk_idCategoria`) VALUES
(44, 'Lixo em Na rua', 'Lixo na minha rua tá fogo', 'imgDenuncia/atencao.png', '27/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5549093, lng: -46.4157249', 'Zona Leste', 'Não Resolvida', 1, 1),
(45, 'Casos de Dengue', 'Casos de Dengue por conta de lixo', 'imgDenuncia/verificado.png', '27/06/2022', 'SP', 'Bela Vista', '06060-220', 'Rua Alberto Torres', 'Osasco', 'lat: -23.5553781, lng: -46.7844741', 'Zona Norte', 'Não Resolvida', 1, 2),
(46, 'Lixo Guaianases', 'Lixo', 'imgDenuncia/atencao.png', '27/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5549093, lng: -46.4157249', 'Zona Norte', 'Não Resolvida', 1, 1),
(47, 'Lixo Guaianases', 'lixo', 'imgDenuncia/', '27/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5544294, lng: -46.4149617', 'Zona Leste', 'Não Resolvida', 1, 1),
(48, 'Lixo Tiête', 'jvj', 'imgDenuncia/', '27/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5539949, lng: -46.4147634', 'Zona Oeste', 'Não Resolvida', 1, 1);

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
  `cidadeEcoponto` varchar(200) NOT NULL,
  `coordeEcoponto` varchar(50) NOT NULL,
  `zonaEcoponto` varchar(15) NOT NULL,
  `numeroEcoponto` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbecoponto`
--

INSERT INTO `tbecoponto` (`pk_idEcoponto`, `ufEcoponto`, `logradouroEcoponto`, `bairroEcoponto`, `cepEcoponto`, `ruaEcoponto`, `cidadeEcoponto`, `coordeEcoponto`, `zonaEcoponto`, `numeroEcoponto`) VALUES
(13, 'SP', 'São Paulo', 'Vila Aricanduva', '03501-010', 'Praça Lúcia Mekhitarian', 'São Paulo', 'lat: -23.537391, lng: -46.5475099', 'Zona Leste', '200'),
(14, 'SP', 'São Paulo', 'Vila Carrão', '03447-140', 'Rua Rancharia', 'São Paulo', 'lat: -23.5506627, lng: -46.5249843', 'Zona Leste', '500'),
(15, 'SP', 'São Paulo', 'Jardim das Rosas (Zona Leste)', '03909-060', 'Rua Olívia Trindade Pinto', 'São Paulo', 'lat: -23.5878068, lng: -46.5095125', 'Zona Leste', '100'),
(16, 'SP', 'São Paulo', 'Jardim Nice', '03905-090', 'Rua Professora Alzira de Oliveira Gilioli', 'São Paulo', 'lat: -23.580803, lng: -46.5145582', 'Zona Leste', '400'),
(17, 'SP', 'São Paulo', 'Ferreira', '05524-000', 'Rua Caminho do Engenho', 'São Paulo', 'lat: -23.5965996, lng: -46.7442267', 'Zona Oeste', '800'),
(18, 'SP', 'São Paulo', 'Jardim Sarah', '05382-140', 'Rua Paulino Baptista Conti', 'São Paulo', 'lat: -23.5767652, lng: -46.761696', 'Zona Oeste', '1'),
(19, 'SP', 'São Paulo', 'Morumbi', '05651-002', 'Avenida Giovanni Gronchi', 'São Paulo', 'lat: -23.6100262, lng: -46.7268579', 'Zona Oeste', '3413'),
(20, 'SP', 'São Paulo', 'Conjunto Habitacional Instituto Adventista', '05868-600', 'Rua Rosifloras', 'São Paulo', 'lat: -23.6642031, lng: -46.7753902', 'Zona Sul', '301');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbrespadm`
--

CREATE TABLE `tbrespadm` (
  `pk_idRespAdm` int(11) NOT NULL,
  `dataRespAdm` varchar(13) NOT NULL,
  `textoRespAdm` varchar(300) NOT NULL,
  `denunciaVerificada` varchar(30) NOT NULL,
  `fk_idDenuncia` int(11) NOT NULL,
  `fk_idAdm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbrespadm`
--

INSERT INTO `tbrespadm` (`pk_idRespAdm`, `dataRespAdm`, `textoRespAdm`, `denunciaVerificada`, `fk_idDenuncia`, `fk_idAdm`) VALUES
(3, '27/06/2022', 'Estamos verificando se essa denúncia foi resolvida?', 'Verificada', 44, 1),
(4, '27/06/2022', 'Estamos verificando se essa denúncia foi resolvida?', 'Verificada', 45, 1),
(5, '27/06/2022', 'Olá amigo', 'Verificada', 46, 1),
(6, '27/06/2022', 'olha lixo', 'Verificada', 47, 1),
(7, '27/06/2022', 'Estamos verificando se essa denúncia foi resolvida?', 'Verificada', 48, 1);

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
(8, '1197778855', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `pk_Usuario` int(11) NOT NULL,
  `nomeUsuario` varchar(150) NOT NULL,
  `emailUsuario` varchar(150) NOT NULL,
  `senhaUsuario` varchar(150) NOT NULL,
  `cepUsuario` varchar(9) NOT NULL,
  `imgUsuario` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`pk_Usuario`, `nomeUsuario`, `emailUsuario`, `senhaUsuario`, `cepUsuario`, `imgUsuario`) VALUES
(1, 'Gui', 'gui@gmail.com', '123', '01548000', 'imgUsuario/leno-brego.jpg'),
(7, 'Nycolas', 'nyco@gmail.com', '123', '08152130', NULL),
(9, 'Cristiano Ronaldo', 'cr7@gmail.com', '123', '08411-31', 'imgUsuario/th (4).jpg');

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
-- Índices para tabela `tbrespadm`
--
ALTER TABLE `tbrespadm`
  ADD PRIMARY KEY (`pk_idRespAdm`),
  ADD KEY `tbrespadm_ibfk_1` (`fk_idDenuncia`),
  ADD KEY `fk_idAdm` (`fk_idAdm`);

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
  MODIFY `pk_idAdm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `pk_idDenuncia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `tbecoponto`
--
ALTER TABLE `tbecoponto`
  MODIFY `pk_idEcoponto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tbrespadm`
--
ALTER TABLE `tbrespadm`
  MODIFY `pk_idRespAdm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tbtelusuario`
--
ALTER TABLE `tbtelusuario`
  MODIFY `pk_TelUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `pk_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- Limitadores para a tabela `tbrespadm`
--
ALTER TABLE `tbrespadm`
  ADD CONSTRAINT `tbrespadm_ibfk_1` FOREIGN KEY (`fk_idDenuncia`) REFERENCES `tbdenuncia` (`pk_idDenuncia`),
  ADD CONSTRAINT `tbrespadm_ibfk_2` FOREIGN KEY (`fk_idAdm`) REFERENCES `tbadm` (`pk_idAdm`);

--
-- Limitadores para a tabela `tbtelusuario`
--
ALTER TABLE `tbtelusuario`
  ADD CONSTRAINT `tbtelusuario_ibfk_1` FOREIGN KEY (`fk_idUsuario`) REFERENCES `tbusuario` (`pk_Usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
