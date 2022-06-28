-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Jun-2022 às 00:38
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
(2, 'Descarte com Água Parada'),
(3, 'Descarte Orgânico'),
(4, 'Descarte de Entulho'),
(5, 'Descarte de Resíduo Tóxico');

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
(44, 'Está me atrapalhando!', 'Preciso que alguém venha limpar, está cheirando mal e não consigo andar pela calsada', 'imgDenuncia/lixo.jpg', '28/06/2022', 'SP', 'Jardim São Carlos (Zona Leste)', '08411-530', 'Rua Aracazeiro', 'São Paulo', 'lat: -23.5568282, lng: -46.4133316', 'Zona Leste', 'Não Resolvida', 1, 1),
(46, 'Há insetos estranhos', 'Há um acúmulo de água parada aqui.', 'imgDenuncia/agua.webp', '28/06/2022', 'SP', 'Vila Ema', '03277-030', 'Rua Roberto Morel', 'São Paulo', 'lat: -23.58386, lng: -46.5461581', 'Zona Leste', 'Não Resolvida', 1, 2),
(48, 'Está impossibilitando minha pa', 'Descartaram entulho no meio da rua!!', 'imgDenuncia/entulho-na-rua.jpg', '28/06/2022', 'SP', 'Jardim Nair', '08071-130', 'Rua Rafael Zimbardi', 'São Paulo', 'lat: -23.4900846, lng: -46.4459136', 'Zona Leste', 'Não Resolvida', 10, 4);

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
(20, 'SP', 'São Paulo', 'Conjunto Habitacional Instituto Adventista', '05868-600', 'Rua Rosifloras', 'São Paulo', 'lat: -23.6642031, lng: -46.7753902', 'Zona Sul', '301'),
(21, 'SP', 'São Paulo', 'Parque Fernanda', '05889-230', 'Rua Antônio Canon', 'São Paulo', 'lat: -23.6720648, lng: -46.7909595', 'Zona Sul', '400'),
(22, 'SP', 'São Paulo', 'Parque Arariba', '05778-180', 'Rua Caio Graco da Silva Prado', 'São Paulo', 'lat: -23.6384692, lng: -46.7560749', 'Zona Sul', '1235'),
(23, 'SP', 'São Paulo', 'Vila Andrade', '05729-100', 'Rua Campo Novo do Sul', 'São Paulo', 'lat: -23.6380934, lng: -46.7415898', 'Zona Sul', '500'),
(24, 'SP', 'São Paulo', 'Paraíso do Morumbi', '05706-300', 'Rua Irapará', 'São Paulo', 'lat: -23.6226533, lng: -46.7250532', 'Zona Oeste', '73'),
(34, 'SP', 'São Paulo', 'Imirim', '02537-000', 'Rua Padre João Gualberto', 'São Paulo', 'lat: -23.490477, lng: -46.6534463', 'Zona Norte', '3168'),
(35, 'SP', 'São Paulo', 'Jardim Centenário', '02882-030', 'Avenida Félix Alves Pereira', 'São Paulo', 'lat: -23.5557714, lng: -46.6395571', 'Zona Norte', '113'),
(36, 'SP', 'São Paulo', 'Vila Santista', '02560-220', 'Travessa Geraldo Ferraz', 'São Paulo', 'lat: -23.4931207, lng: -46.6706479', 'Zona Norte', '38'),
(37, 'SP', 'São Paulo', 'Jardim Antártica', '02652-170', 'Rua Dom Aquino', 'São Paulo', 'lat: -23.4568645, lng: -46.6591389', 'Zona Norte', '103'),
(38, 'SP', 'São Paulo', 'Vila Palmeiras', '02725-030', 'Rua Antônio Rates', 'São Paulo', 'lat: -23.4965808, lng: -46.6838586', 'Zona Norte', '1'),
(39, 'SP', 'São Paulo', 'Balneário Mar Paulista', '04467-000', 'Estrada do Alvarenga', 'São Paulo', 'lat: -23.6954148, lng: -46.6515951', 'Zona Norte', '2475'),
(40, 'SP', 'São Paulo', 'Balneário Mar Paulista', '04467-000', 'Estrada do Alvarenga', 'São Paulo', 'lat: -23.6954148, lng: -46.6515951', 'Zona Sul', '2475'),
(41, 'SP', 'São Paulo', 'Jardim Itacolomi', '04385-090', 'Rua Visconde de Santa Isabel', 'São Paulo', 'lat: -23.6631055, lng: -46.6580814', 'Zona Sul', '131'),
(51, 'SP', 'São Paulo', 'Parque Guarani', '08235-620', 'Rua Manuel Alves da Rocha', 'São Paulo', 'lat: -23.5208853, lng: -46.4635939', 'Zona Leste', '584'),
(52, 'SP', 'São Paulo', 'Jardim Nossa Senhora do Carmo', '08275-310', 'Rua Machado Nunes', 'São Paulo', 'lat: -23.5790199, lng: -46.486113', 'Zona Leste', '95'),
(55, 'SP', 'São Paulo', 'Vila Santa Cruz (Zona Leste)', '08411-010', 'Rua da Passagem Funda', 'São Paulo', 'lat: -23.5552296, lng: -46.4129776', 'Zona Leste', '250'),
(56, 'SP', 'São Paulo', 'Jardim São Carlos (Zona Leste)', '08062-520', 'Rua El Rey', 'São Paulo', 'lat: -23.5095788, lng: -46.4721889', 'Zona Leste', '508'),
(57, 'SP', 'São Paulo', 'Jardim Santa Margarida', '08191-250', 'Rua Duarte Martins Mourão', 'São Paulo', 'lat: -23.478025, lng: -46.3830729', 'Zona Leste', '307'),
(58, 'SP', 'São Paulo', 'Liberdade', '01517-100', 'Viaduto 31 de Março', 'São Paulo', 'lat: -23.5564135, lng: -46.6288282', 'Zona Oeste', '198'),
(59, 'SP', 'São Paulo', 'Parque Residencial Oratorio', '03266-200', 'Rua João Gregório Lemos', 'São Paulo', 'lat: -23.5991018, lng: -46.5350304', 'Zona Leste', '307'),
(60, 'SP', 'São Paulo', 'Conjunto Residencial Sitio Oratório', '03978-310', 'Rua dos Voras', 'São Paulo', 'lat: -23.6233137, lng: -46.509249', 'Zona Sul', '25'),
(61, 'SP', 'Santo André', 'Vila Linda', '09175-670', 'Rua Grajaú', 'São Paulo', 'lat: -23.6870417, lng: -46.517953', 'Zona Sul', '45');

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
(8, '1197778855', 9),
(9, '(11) 98726-', 10);

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
(1, 'Guilherme', 'gui@gmail.com', '123', '01548000', 'imgUsuario/leno-brego.jpg'),
(7, 'Nycolas', 'nyco@gmail.com', '123', '08152130', NULL),
(9, 'Cristiano Ronaldo', 'cr7@gmail.com', '123', '08411-31', 'imgUsuario/th (4).jpg'),
(10, 'Ricardo Freire', 'ricardo@gmail.com', '123', '08411-530', 'imgUsuario/ricardo.jpg');

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
  MODIFY `pk_idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `pk_idEcoponto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de tabela `tbrespadm`
--
ALTER TABLE `tbrespadm`
  MODIFY `pk_idRespAdm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbtelusuario`
--
ALTER TABLE `tbtelusuario`
  MODIFY `pk_TelUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `pk_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
