-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Jun-2022 às 04:45
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
  `nomeAdm` varchar(150) NOT NULL,
  `sobrenomeAdm` varchar(150) NOT NULL,
  `emailAdm` varchar(200) NOT NULL,
  `cep` varchar(14) NOT NULL,
  `senhaAdm` varchar(200) NOT NULL,
  `denunciaReslvAdm` int(11) NOT NULL,
  `imagemAdm` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbadm`
--

INSERT INTO `tbadm` (`pk_idAdm`, `nomeAdm`, `sobrenomeAdm`, `emailAdm`, `cep`, `senhaAdm`, `denunciaReslvAdm`, `imagemAdm`) VALUES
(1, 'Adm', 'Adm', 'Adm@gmail.com', '10022555', '123', 8, NULL);

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
  `cepDenuncia` varchar(10) NOT NULL,
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
(16, 'Nossa que legal', 'sdssadas', 'imgDenuncia/', '17/06/2022', 'SP', 'Jardim Bartira', '08152130', 'Rua Carrossel', 'São Paulo', 'lat: -23.5119082, lng: -46.4112154', 'Zona Leste', '', 6, 1),
(18, 'sdasd', 'sdas', 'imgDenuncia/', '17/06/2022', 'SP', 'Jardim Nélia', '08142680', 'Rua Inês Sabino', 'São Paulo', 'lat: -23.5557714, lng: -46.6395571', 'Zona Norte', '', 6, 1),
(19, 'Descarte de lixo', 'Muito lixo', 'imgDenuncia/', '18/06/2022', 'SP', 'Jardim Silva Teles', '08160-00', 'Rua Aricanga', 'São Paulo', 'lat: -23.4958356, lng: -46.411385', 'Zona Leste', '', 6, 1),
(21, 'a', 'asdasdsdsad', 'imgDenuncia/', '18/06/2022', 'SP', 'Jardim Nélia', '08142-68', 'Rua Inês Sabino', 'São Paulo', 'lat: -23.5557714, lng: -46.6395571', 'Zona Leste', '', 6, 1),
(25, 'Lixo Tiête', 'bjb', 'imgDenuncia/th (4).jpg', '19/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5549133, lng: -46.4156954', 'Zona Leste', '', 1, 1),
(26, 'Lixo Tiête', 'lsl', 'imgDenuncia/th (4).jpg', '19/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5549093, lng: -46.4157249', 'Zona Leste', '', 1, 1),
(28, 'Lixo Tiête', 'jbshbxhxsxssx', 'imgDenuncia/th (4).jpg', '19/06/2022', 'SP', 'Bela Vista', '06060-220', 'Rua Alberto Torres', 'Osasco', 'lat: -23.5544852, lng: -46.7843437', 'Zona Leste', '', 1, 2),
(30, 'Lixo Tiête', 'oo', 'imgDenuncia/th (4).jpg', '19/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5539949, lng: -46.4147634', 'Zona Sul', '', 1, 1),
(31, 'Lixo Tiête', 'kokk', 'imgDenuncia/th (4).jpg', '19/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5539948, lng: -46.4149019', 'Zona Leste', '', 1, 1),
(32, 'Lixo Tiête', 'ooj', 'imgDenuncia/th (4).jpg', '19/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5549093, lng: -46.4157249', 'Zona Leste', '', 1, 1),
(33, 'Lixo Tiête', 'iii', 'imgDenuncia/th (4).jpg', '19/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5549093, lng: -46.4157249', 'Zona Sul', '', 1, 1),
(34, 'Lixo Tiête', 'i', 'imgDenuncia/th (4).jpg', '19/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5549093, lng: -46.4157249', 'Zona Leste', '', 1, 2),
(35, 'Lixo Tiête', 'jjj', 'imgDenuncia/th (4).jpg', '19/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5549093, lng: -46.4157249', 'Zona Leste', '', 1, 2),
(36, 'Lixo Tiête', 'kk', 'imgDenuncia/th (4).jpg', '19/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5549093, lng: -46.4157249', 'Zona Norte', '', 1, 1),
(37, 'Lixo Tiête', ' zn', 'imgDenuncia/th (4).jpg', '19/06/2022', 'SP', 'Bela Vista', '06060-220', 'Rua Alberto Torres', 'Osasco', 'lat: -23.5554133, lng: -46.7843185', 'Zona Norte', '', 1, 1),
(38, 'Lixo Guaianases', 'lk', 'imgDenuncia/th (4).jpg', '19/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5539948, lng: -46.4149019', 'Zona Norte', '', 1, 1),
(39, 'Lixo Tiête', 'ddd', 'imgDenuncia/th (4).jpg', '19/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5549093, lng: -46.4157249', 'Zona Leste', '', 1, 1),
(41, 'Lixo Tiête', 'pop', 'imgDenuncia/default.jpg', '19/06/2022', 'SP', 'Vila Marilena', '08411-330', 'Rua General Rocha Calado', 'São Paulo', 'lat: -23.5549093, lng: -46.4157249', 'Zona Leste', '', 1, 2),
(42, 'Lixo Tiête', 'jjj', 'imgDenuncia/caue.jpg', '19/06/2022', 'SP', 'Bela Vista', '06060-220', 'Rua Alberto Torres', 'Osasco', 'lat: -23.5557175, lng: -46.7845236', 'Zona Leste', '', 1, 1);

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
  `zonaEcoponto` varchar(15) NOT NULL,
  `numeroEcoponto` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbecoponto`
--

INSERT INTO `tbecoponto` (`pk_idEcoponto`, `ufEcoponto`, `logradouroEcoponto`, `bairroEcoponto`, `cepEcoponto`, `ruaEcoponto`, `coordeEcoponto`, `zonaEcoponto`, `numeroEcoponto`) VALUES
(1, 'SP', 'São Paulo', 'Jardim Bartira', '08152130', 'Rua Carrossel', 'lat: -23.5115478, lng: -46.4110822', 'Zona Leste', '264'),
(2, 'SP', 'São Paulo', 'São João Clímaco', '04240050', 'Rua Vicente Gaspar', 'lat: -23.6177114, lng: -46.5874794', 'Zona Norte', ''),
(3, 'SP', 'São Paulo', 'Jardim Indaiá', '08141130', 'Rua Antônio Leme da Guerra', 'lat: -23.5157698, lng: -46.3975747', 'Zona Norte', ''),
(4, 'SP', 'São Paulo', 'Vila Buenos Aires', '03624090', 'Rua Diário de São Paulo', 'lat: -23.5143774, lng: -46.5169547', 'Zona Oeste', ''),
(5, 'SP', 'São Paulo', 'Vila Mariana', '04015030', 'Rua Nakaya', 'lat: -23.5862992, lng: -46.6451601', 'Zona Norte', '1'),
(6, 'SP', 'São Paulo', 'Jardim Reimberg', '04845200', 'Rua Alba Valdez', 'lat: -23.750614, lng: -46.6964036', 'Zona Leste', ''),
(7, 'SP', 'São Paulo', 'Jardim Russo', '05205050', 'Rua Campo do Olival', 'lat: -23.407705, lng: -46.7656429', 'Zona Leste', '55'),
(8, 'SP', 'São Paulo', 'Vila Joaniza', '04404140', 'Rua Bemaventurança', 'lat: -23.6746855, lng: -46.6598304', 'Zona Sul', '55'),
(9, 'SP', 'São Paulo', 'Jardim Nossa Senhora do Rosário', '7918120', 'Rua Deputado Doutor Aldo Lupo', 'lat: -23.5557714, lng: -46.6395571', 'Leste', '200'),
(10, 'SP', 'São Paulo', 'Cidade Vista Verde', '12223400', 'Rua Caraíbas', 'lat: -23.1818597, lng: -45.8300832', 'Norte', '400'),
(11, 'SP', 'São Paulo', 'Jardim Nossa Senhora do Rosário', '7918120', 'Rua Deputado Doutor Aldo Lupo', 'lat: -23.5557714, lng: -46.6395571', 'Leste', '200'),
(12, 'SP', '', 'Jardim Bartira', '08152-130', 'Rua Carrossel', 'lat: -23.5115478, lng: -46.4110822', 'Zona Norte', '264');

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
  `cepUsuario` varchar(8) NOT NULL,
  `imgUsuario` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`pk_Usuario`, `nomeUsuario`, `emailUsuario`, `senhaUsuario`, `cepUsuario`, `imgUsuario`) VALUES
(1, 'Gui', 'gui@gmail.com', '123', '01548000', 'imgUsuario/leno-brego.jpg'),
(6, '', 'nilton@gmail.com', '123', '', 'imgUsuario/'),
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
  MODIFY `pk_idDenuncia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `tbecoponto`
--
ALTER TABLE `tbecoponto`
  MODIFY `pk_idEcoponto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Limitadores para a tabela `tbtelusuario`
--
ALTER TABLE `tbtelusuario`
  ADD CONSTRAINT `tbtelusuario_ibfk_1` FOREIGN KEY (`fk_idUsuario`) REFERENCES `tbusuario` (`pk_Usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
