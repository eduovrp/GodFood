-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23-Jun-2015 às 04:24
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u288492055_food`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adicionais`
--

CREATE TABLE IF NOT EXISTS `adicionais` (
  `id_adicional` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_adicional`),
  KEY `fk_adicioanais_categorias` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `adicionais`
--

INSERT INTO `adicionais` (`id_adicional`, `nome`, `valor`, `id_categoria`) VALUES
(1, 'Cheddar', '0.50', 9),
(2, 'Bacon', '0.50', 9),
(3, 'Catupiry', '0.50', 9),
(4, 'Calabreza', '0.50', 9),
(5, 'Queijo', '0.50', 9),
(6, 'Lombo', '0.50', 9),
(7, 'Palmito', '0.50', 9),
(8, 'Cheddar', '3.00', 10),
(9, 'Catupiry', '2.50', 10),
(10, 'Cheddar', '3.00', 10),
(11, 'Catupiry', '2.50', 10),
(12, 'Calabresa', '3.50', 10),
(15, 'Catupiry', '2.00', 13),
(16, 'Cheddar', '2.50', 13),
(17, 'Calabresa', '2.50', 13),
(20, 'Catupiry', '4.00', 11),
(21, 'Cheddar', '4.50', 11),
(22, 'Calabresa', '4.50', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bordas`
--

CREATE TABLE IF NOT EXISTS `bordas` (
  `id_borda` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `valor` decimal(6,2) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_borda`),
  KEY `fk_bordas_categorias` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `bordas`
--

INSERT INTO `bordas` (`id_borda`, `nome`, `valor`, `id_categoria`) VALUES
(1, 'Cheddar', '3.00', 10),
(2, 'Catupiry', '2.50', 10),
(3, 'Calabresa', '3.50', 10),
(4, 'Goiabada', '2.50', 10),
(5, 'Doce de Leite', '2.50', 10),
(6, 'Catupiry', '2.00', 13),
(7, 'Cheddar', '2.50', 13),
(8, 'Calabresa', '2.50', 13),
(9, 'Goiabada ', '2.00', 13),
(10, 'Doce de leite', '2.00', 13),
(11, 'Catupiry', '4.00', 11),
(12, 'Cheddar', '4.50', 11),
(13, 'Calabresa', '4.50', 11),
(14, 'Goiabada', '4.00', 11),
(15, 'Doce de Leite', '4.00', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `2sabores` char(3) CHARACTER SET latin1 NOT NULL DEFAULT 'Não',
  PRIMARY KEY (`id_categoria`),
  KEY `fk_categorias_restaurantes` (`id_restaurante`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nome`, `id_restaurante`, `2sabores`) VALUES
(9, 'Mini Esfirra', 5, 'Não'),
(10, 'Calzone', 5, 'Não'),
(11, 'Pizza Grande', 5, 'Sim'),
(12, 'Pizza Doce', 5, 'Não'),
(13, 'Mini Pizza', 5, 'Não'),
(18, 'Bebidas', 5, 'Não'),
(19, 'Pizza Grande', 8, 'Não'),
(20, 'Bebidas', 8, 'Não');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE IF NOT EXISTS `cidades` (
  `id_cidade` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado` int(11) NOT NULL,
  `nome` varchar(72) COLLATE utf8_unicode_ci NOT NULL,
  `cep` char(9) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_cidade`),
  KEY `fk_com_estados` (`id_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `cidades`
--

INSERT INTO `cidades` (`id_cidade`, `id_estado`, `nome`, `cep`) VALUES
(1, 1, 'Três Fronteiras', '15770-000'),
(2, 1, 'Santa Fé do Sul', '15775-000'),
(3, 1, 'Jales', '15700-000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades_entregas`
--

CREATE TABLE IF NOT EXISTS `cidades_entregas` (
  `id_cidade_entrega` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `cep` varchar(9) NOT NULL,
  PRIMARY KEY (`id_cidade_entrega`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `cidades_entregas`
--

INSERT INTO `cidades_entregas` (`id_cidade_entrega`, `nome`, `cep`) VALUES
(1, 'Santa Fé do Sul - SP', '15775-000'),
(2, 'Três Fronteiras - SP', '15770-000'),
(3, 'Jales - SP', '15700-000'),
(4, 'Ilha Solteira - SP', '15385-000'),
(6, 'Fernandópolis - SP', '15600-000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE IF NOT EXISTS `enderecos` (
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(80) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(90) NOT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `referencia` varchar(200) DEFAULT NULL,
  `estado` char(2) CHARACTER SET latin1 NOT NULL,
  `cidade` varchar(75) NOT NULL,
  `cep` char(9) CHARACTER SET latin1 NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_endereco`),
  KEY `fk_com_usuarios` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`id_endereco`, `logradouro`, `numero`, `bairro`, `complemento`, `referencia`, `estado`, `cidade`, `cep`, `id_usuario`) VALUES
(2, 'Rua José Claudio Fogaça', '875', 'Centro', '', '', 'SP', 'Três Fronteiras', '15770-000', 2),
(3, 'Rua 15', '115', 'Centro', 'Casa', 'Perto da Padaria dos peishe', 'SP', 'Santa Fé do Sul', '15775-000', 2),
(4, 'Rua são paulo de piratininga', '1818', 'Bartolão', '', '', 'SP', 'Santa Fé do Sul', '15775-000', 2),
(5, 'Rua dos Admin', '666', 'Centro', '', '', 'SP', 'Santa Fé do Sul', '15775-000', 8),
(8, 'Rua Antônio Carlos de Almeida', '352', 'Orestes Borges', '', '', 'SP', 'SANTA FE DO SUL', '15775-000', 8),
(9, 'Rua Antônio Carlos de Almeida', '352', 'centro', '', '', 'SP', 'Santa Fé do Sul', '15775-000', 25),
(10, 'Rua José Claudio Fogaça', '875', 'Centro', '', '', 'SP', 'Três Fronteiras', '15770-000', 34),
(11, 'av 7', '214', 'st  helena', 'casa', 'nenhuma', 'sp', 'fernandopolis', '15600-000', 38),
(12, 'rua tal', '2', 'centro', '', '', 'SP', 'Jales', '15775-000', 38),
(13, 'dsadsadsad', '1', 'saddsfsda', '', '', 'SP', 'Jales', '15700-000', 38),
(14, 'Av. Navarro de Andrade', '347', 'Centro', '', '', 'SP', 'Santa Fé do Sul', '15775-000', 41),
(15, 'Av. Ana rocha de oliveira', '548', 'Centro', '', '', 'SP', 'Três Fronteiras', '15770-000', 41),
(16, 'Avenida Presidente Vargas', '173', 'Centro', '', '', 'SP', 'Três Fronteitas', '15775-000', 42),
(17, 'Rua Dos Eucaliptos', '90', 'Jardim Universitário 2', '', '', 'SP', 'Santa Fé do Sul', '15775-000', 43);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entregas_restaurantes`
--

CREATE TABLE IF NOT EXISTS `entregas_restaurantes` (
  `id_entrega` int(11) NOT NULL AUTO_INCREMENT,
  `id_cidade_entrega` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `taxa` decimal(5,2) unsigned NOT NULL,
  PRIMARY KEY (`id_entrega`),
  KEY `fk_entrega_cidade` (`id_cidade_entrega`),
  KEY `fk_entrega_restaurantes` (`id_restaurante`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Extraindo dados da tabela `entregas_restaurantes`
--

INSERT INTO `entregas_restaurantes` (`id_entrega`, `id_cidade_entrega`, `id_restaurante`, `taxa`) VALUES
(22, 1, 5, '0.00'),
(23, 2, 5, '5.00'),
(24, 3, 5, '6.00'),
(25, 4, 5, '3.00'),
(26, 6, 5, '1.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `cod_estados` int(11) NOT NULL DEFAULT '0',
  `sigla` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(72) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cod_estados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `estados`
--

INSERT INTO `estados` (`cod_estados`, `sigla`, `nome`) VALUES
(1, 'SP', 'São Paulo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE IF NOT EXISTS `funcionarios` (
  `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(25) DEFAULT 'Sem telefone',
  `usuario` varchar(20) NOT NULL,
  `senha` char(128) CHARACTER SET latin1 NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_funcionario`),
  KEY `fk_funcionarios_restaurantes` (`id_restaurante`),
  KEY `fk_funcionarios_niveis` (`id_nivel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id_funcionario`, `nome`, `cpf`, `telefone`, `usuario`, `senha`, `id_nivel`, `id_restaurante`, `data`) VALUES
(1, 'Funcionario Teste', '612.818.181-81', '(15) - 15151-5151', 'teste', '176b9dd7906dd9919b94aa17686d282628daee473bfe3576677959e87a8320d4f15c33fc5e1a98be9d44d789b828164ee748706b7c758db58d706cdb6cea692c', 2, 5, '2015-05-20 18:59:36'),
(2, 'Proprietario Teste', '848.484.844-54', '(15) - 81801-8181', 'proprietario', '176b9dd7906dd9919b94aa17686d282628daee473bfe3576677959e87a8320d4f15c33fc5e1a98be9d44d789b828164ee748706b7c758db58d706cdb6cea692c', 4, 5, '2015-05-20 19:02:14'),
(3, 'teste1', '128.372.183-71', '(15) - 8181-8181', 'teste1', '176b9dd7906dd9919b94aa17686d282628daee473bfe3576677959e87a8320d4f15c33fc5e1a98be9d44d789b828164ee748706b7c758db58d706cdb6cea692c', 3, 8, '2015-05-25 19:19:01'),
(4, 'Teste', '312.932.198-38', '(17) - 8888-8888', 'teste3', 'b6c39372ed94b613747bb6ad156cfdfaeb4b2302b77097f8a2aabb58efedb679146f13dbf18f5bf2fd01f2f61945d7b42f8684dff598849fbc150779005ad18f', 2, 5, '2015-06-10 00:24:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_pedido`
--

CREATE TABLE IF NOT EXISTS `itens_pedido` (
  `id_item_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `id_adicional` int(11) DEFAULT NULL,
  `adicional` varchar(40) DEFAULT 'Nenhum',
  `id_borda` int(11) DEFAULT NULL,
  `borda` varchar(40) DEFAULT 'Não',
  `obs` varchar(160) DEFAULT NULL,
  `valor_unit` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id_item_pedido`),
  KEY `fk_itens_pedido` (`id_pedido`),
  KEY `fk_itens_produtos` (`id_produto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

--
-- Extraindo dados da tabela `itens_pedido`
--

INSERT INTO `itens_pedido` (`id_item_pedido`, `id_pedido`, `id_produto`, `qtd`, `id_adicional`, `adicional`, `id_borda`, `borda`, `obs`, `valor_unit`) VALUES
(54, 23, 23, 1, NULL, 'Nenhum', NULL, 'Não', '', '20.00'),
(55, 24, 17, 5, NULL, 'Nenhum', NULL, 'Não', '', '2.30'),
(56, 24, 28, 1, NULL, 'Nenhum', NULL, 'Não', '', '1.80'),
(57, 25, 10, 1, NULL, 'Nenhum', NULL, 'Não', '', '22.50'),
(58, 26, 25, 2, 12, 'Calabresa', 2, 'Catupiry', '', '33.50'),
(59, 27, 25, 1, NULL, 'Nenhum', 4, 'Goiabada', '', '30.00'),
(60, 28, 22, 1, NULL, 'Nenhum', NULL, 'Não', '', '10.00'),
(61, 28, 17, 1, 3, 'Catupiry', NULL, 'Não', '', '2.80'),
(62, 29, 25, 2, NULL, 'Nenhum', 1, 'Cheddar', '', '30.50'),
(63, 30, 16, 1, NULL, 'Nenhum', NULL, 'Não', '', '1.80'),
(64, 30, 6, 1, 11, 'Catupiry', 4, 'Goiabada', '', '24.00'),
(65, 31, 4, 1, NULL, 'Nenhum', NULL, 'Não', '', '19.00'),
(66, 31, 8, 1, 11, 'Catupiry', NULL, 'Não', '', '19.50'),
(67, 32, 4, 1, NULL, 'Nenhum', NULL, 'Não', '', '19.00'),
(68, 32, 8, 1, 11, 'Catupiry', NULL, 'Não', '', '19.50'),
(69, 33, 16, 3, 6, 'Lombo', NULL, 'Não', '', '2.30'),
(70, 33, 9, 1, NULL, 'Nenhum', NULL, 'Não', '', '18.00'),
(74, 36, 16, 20, 3, 'Catupiry', NULL, 'Não', '', '2.30'),
(75, 37, 16, 20, 3, 'Catupiry', NULL, 'Não', '', '2.30'),
(76, 38, 14, 1, NULL, 'Nenhum', NULL, 'Não', '', '25.50'),
(77, 39, 10, 1, NULL, 'Nenhum', 14, 'Goiabada', '', '26.50'),
(78, 40, 10, 1, NULL, 'Nenhum', NULL, 'Não', '', '22.50'),
(79, 41, 10, 1, NULL, 'Nenhum', NULL, 'Não', '', '22.50'),
(80, 41, 20, 1, NULL, 'Nenhum', NULL, 'Não', '', '8.20'),
(81, 42, 14, 1, NULL, 'Nenhum', NULL, 'Não', '', '25.50'),
(82, 42, 10, 1, 21, 'Cheddar', NULL, 'Não', '', '27.00'),
(83, 43, 14, 1, NULL, 'Nenhum', NULL, 'Não', '', '25.50'),
(84, 44, 10, 1, NULL, 'Nenhum', NULL, 'Não', '', '22.50'),
(85, 44, 13, 1, NULL, 'Nenhum', NULL, 'Não', '', '29.50'),
(86, 45, 14, 1, NULL, 'Nenhum', NULL, 'Não', '', '25.50'),
(87, 45, 10, 1, 20, 'Catupiry', 13, 'Calabresa', '', '31.00'),
(88, 46, 4, 1, NULL, 'Nenhum', NULL, 'Não', '', '19.00'),
(89, 46, 8, 1, NULL, 'Nenhum', NULL, 'Não', '', '17.00'),
(90, 47, 10, 1, NULL, 'Nenhum', NULL, 'Não', '', '22.50'),
(91, 48, 10, 1, NULL, 'Nenhum', NULL, 'Não', '', '22.50'),
(93, 50, 16, 1, NULL, 'Nenhum', NULL, 'Não', '', '1.80'),
(94, 50, 17, 1, 7, 'Palmito', NULL, 'Não', '', '2.80'),
(95, 50, 6, 1, NULL, 'Nenhum', NULL, 'Não', '', '19.00'),
(96, 51, 4, 1, NULL, 'Nenhum', NULL, 'Não', '', '19.00'),
(97, 52, 10, 1, 22, 'Calabresa', 12, 'Cheddar', '', '31.50'),
(98, 52, 16, 1, 3, 'Catupiry', NULL, 'Não', '', '2.30'),
(99, 52, 18, 1, 1, 'Cheddar', NULL, 'Não', '', '2.80'),
(100, 53, 10, 1, NULL, 'Nenhum', 14, 'Goiabada', '', '26.50'),
(101, 54, 8, 1, NULL, 'Nenhum', NULL, 'Não', '', '17.00'),
(102, 54, 6, 1, 10, 'Cheddar', 5, 'Doce de Leite', '', '24.50'),
(103, 54, 4, 1, NULL, 'Nenhum', NULL, 'Não', 'sem tomate', '19.00'),
(104, 55, 13, 1, 22, 'Calabresa', 11, 'Catupiry', '', '38.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--

CREATE TABLE IF NOT EXISTS `mensagens` (
  `id_mensagem` int(11) NOT NULL AUTO_INCREMENT,
  `id_restaurante` int(11) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `mensagem` varchar(256) NOT NULL,
  `exibir` char(3) CHARACTER SET latin1 NOT NULL DEFAULT 'Não',
  PRIMARY KEY (`id_mensagem`),
  KEY `fk_mensagens_restaurantes` (`id_restaurante`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `mensagens`
--

INSERT INTO `mensagens` (`id_mensagem`, `id_restaurante`, `tipo`, `mensagem`, `exibir`) VALUES
(2, 5, 'alert-warning', 'Atenção: Você está em um ambiente de teste, nenhum pedido será registrado oficialmente nem entregue, caso encontre algum problema, bug ou erro, por favor, entre em contato conosco. Agradecemos sua compreenção.', 'Sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `niveis_usuarios`
--

CREATE TABLE IF NOT EXISTS `niveis_usuarios` (
  `id_nivel` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `sub_nome` varchar(20) NOT NULL,
  PRIMARY KEY (`id_nivel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `niveis_usuarios`
--

INSERT INTO `niveis_usuarios` (`id_nivel`, `nome`, `sub_nome`) VALUES
(1, 'Bronze', 'Usuario'),
(2, 'Prata', 'Funcionario'),
(3, 'Ouro', 'Gerente'),
(4, 'Platina', 'Proprietario'),
(5, 'God', 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamentos`
--

CREATE TABLE IF NOT EXISTS `pagamentos` (
  `id_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `data_pagamento` varchar(45) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  PRIMARY KEY (`id_pagamento`),
  KEY `fk_pagamentos_pedidos1_idx` (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `data` timestamp NULL DEFAULT NULL,
  `valor_total` decimal(8,2) NOT NULL,
  `valor_pago` decimal(8,2) NOT NULL,
  `taxa_entrega` decimal(6,2) DEFAULT '0.00',
  `id_usuario` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_cidade_entrega` int(11) NOT NULL,
  `endereco` varchar(256) NOT NULL,
  `data_pgto` timestamp NULL DEFAULT NULL,
  `data_confirm` timestamp NULL DEFAULT NULL,
  `data_delivery` timestamp NULL DEFAULT NULL,
  `data_entrega` timestamp NULL DEFAULT NULL,
  `data_error` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `fk_pedidos_usuario1_idx` (`id_usuario`),
  KEY `fk_pedidos_restaurantes` (`id_restaurante`),
  KEY `fk_pedidos_cidade_entrega` (`id_cidade_entrega`),
  KEY `fk_pedidos_enderecos` (`endereco`(255)),
  KEY `fk_status_pedidos` (`id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `data`, `valor_total`, `valor_pago`, `taxa_entrega`, `id_usuario`, `id_restaurante`, `id_status`, `id_cidade_entrega`, `endereco`, `data_pgto`, `data_confirm`, `data_delivery`, `data_entrega`, `data_error`) VALUES
(23, '2015-06-01 19:20:24', '20.00', '22.90', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-01 19:21:03', '2015-06-01 19:21:26', '2015-06-01 19:21:28', '2015-06-01 19:21:29', NULL),
(24, '2015-06-01 19:50:05', '13.30', '16.20', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-02 11:08:00', '2015-06-02 12:03:05', '2015-06-02 12:03:08', '2015-06-02 12:03:09', NULL),
(25, '2015-06-02 12:04:42', '22.50', '25.40', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-02 12:05:25', '2015-06-02 12:05:55', '2015-06-02 12:05:56', '2015-06-02 12:05:58', NULL),
(26, '2015-06-02 13:46:52', '67.00', '69.90', '0.00', 2, 5, 7, 1, 'Rua são paulo de piratininga, 1818 - Bartolão / Santa Fé do Sul - SP', '2015-06-02 13:47:53', '2015-06-02 13:48:36', '2015-06-02 13:48:38', '2015-06-02 13:48:40', NULL),
(27, '2015-06-02 22:17:16', '30.00', '32.90', '0.00', 2, 5, 7, 1, 'Rua são paulo de piratininga, 1818 - Bartolão / Santa Fé do Sul - SP', '2015-06-02 22:17:41', '2015-06-02 22:17:47', '2015-06-02 22:17:49', '2015-06-02 22:17:50', NULL),
(28, '2015-06-02 22:31:21', '12.80', '15.70', '0.00', 2, 5, 7, 1, 'Rua são paulo de piratininga, 1818 - Bartolão / Santa Fé do Sul - SP', '2015-06-02 22:32:16', '2015-06-02 22:33:23', '2015-06-02 22:33:25', '2015-06-02 22:33:27', NULL),
(29, '2015-06-02 22:34:05', '61.00', '63.90', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-02 22:35:36', '2015-06-02 22:35:47', '2015-06-02 22:35:49', '2015-06-02 22:35:51', NULL),
(30, '2015-06-02 23:24:26', '25.80', '28.70', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-02 23:24:44', '2015-06-03 12:34:14', '2015-06-03 12:34:16', '2015-06-03 16:28:38', NULL),
(31, '2015-06-02 23:30:39', '38.50', '41.40', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-02 23:31:27', '2015-06-03 12:34:20', '2015-06-03 16:28:40', '2015-06-03 16:28:42', NULL),
(32, '2015-06-03 00:25:55', '38.50', '41.40', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-03 00:26:16', '2015-06-03 16:28:32', '2015-06-03 16:28:44', '2015-06-03 16:28:48', NULL),
(33, '2015-06-03 00:37:15', '24.90', '27.80', '0.00', 8, 5, 7, 1, 'Rua dos Admin, 666 - Centro / Santa Fé do Sul - SP', '2015-06-03 00:37:51', '2015-06-03 16:28:35', '2015-06-03 16:28:46', '2015-06-03 16:28:50', NULL),
(36, '2015-06-03 15:17:55', '46.00', '48.90', '0.00', 25, 5, 1, 1, 'Rua Antônio Carlos de Almeida, 352 - centro / Santa Fé do Sul - SP', NULL, NULL, NULL, NULL, NULL),
(37, '2015-06-03 15:18:23', '46.00', '48.90', '0.00', 25, 5, 1, 1, 'Rua Antônio Carlos de Almeida, 352 - centro / Santa Fé do Sul - SP', NULL, NULL, NULL, NULL, NULL),
(38, '2015-06-03 15:19:05', '25.50', '28.40', '0.00', 25, 5, 1, 1, 'Rua Antônio Carlos de Almeida, 352 - centro / Santa Fé do Sul - SP', NULL, NULL, NULL, NULL, NULL),
(39, '2015-06-03 22:13:03', '26.50', '29.40', '0.00', 2, 5, 1, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', NULL, NULL, NULL, NULL, NULL),
(40, '2015-06-03 22:28:24', '22.50', '25.40', '0.00', 2, 5, 7, 1, 'Rua são paulo de piratininga, 1818 - Bartolão / Santa Fé do Sul - SP', '2015-06-03 22:28:52', '2015-06-03 22:36:35', '2015-06-03 22:36:42', '2015-06-03 22:36:45', NULL),
(41, '2015-06-03 22:33:15', '30.70', '33.60', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-03 22:33:41', '2015-06-03 22:40:10', '2015-06-03 22:40:13', '2015-06-03 22:40:15', NULL),
(42, '2015-06-03 22:47:25', '52.50', '55.40', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-03 22:47:39', '2015-06-03 22:51:39', '2015-06-03 22:51:43', '2015-06-03 22:51:46', NULL),
(43, '2015-06-03 23:02:18', '25.50', '28.40', '0.00', 2, 5, 7, 1, 'Rua são paulo de piratininga, 1818 - Bartolão / Santa Fé do Sul - SP', '2015-06-03 23:02:32', '2015-06-04 17:18:32', '2015-06-04 17:18:39', '2015-06-04 17:18:58', NULL),
(44, '2015-06-04 17:10:20', '52.00', '54.90', '0.00', 34, 5, 7, 2, 'Rua José Claudio Fogaça, 875 - Centro / Três Fronteiras - SP', '2015-06-04 17:10:38', '2015-06-04 17:18:36', '2015-06-04 17:18:55', '2015-06-04 17:19:00', NULL),
(45, '2015-06-04 17:42:51', '56.50', '59.40', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-04 17:43:08', '2015-06-04 17:46:24', '2015-06-04 17:46:30', '2015-06-04 17:46:38', NULL),
(46, '2015-06-06 02:12:29', '36.00', '38.90', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-06 02:12:52', '2015-06-06 02:13:43', '2015-06-06 02:13:46', '2015-06-06 02:13:48', NULL),
(47, '2015-06-06 04:09:50', '22.50', '25.40', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-06 04:10:07', '2015-06-09 20:00:51', '2015-06-09 20:00:54', '2015-06-09 20:01:02', NULL),
(48, '2015-06-08 17:24:49', '22.50', '25.40', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-08 17:25:13', '2015-06-09 20:00:49', '2015-06-09 20:00:56', '2015-06-09 20:01:06', NULL),
(50, '2015-06-08 15:45:29', '29.60', '32.50', '6.00', 38, 5, 7, 3, 'dsadsadsad, 1 - saddsfsda / Jales - SP', '2015-06-08 15:47:34', '2015-06-09 20:00:47', '2015-06-09 20:00:58', '2015-06-09 20:01:08', NULL),
(51, '2015-06-08 15:45:43', '19.00', '21.90', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-08 15:46:48', '2015-06-09 15:30:49', '2015-06-09 15:30:56', '2015-06-09 15:31:06', NULL),
(52, '2015-06-09 15:28:30', '41.60', '44.50', '5.00', 2, 5, 1, 2, 'Rua José Claudio Fogaça, 875 - Centro / Três Fronteiras - SP', NULL, NULL, NULL, NULL, NULL),
(53, '2015-06-09 19:59:46', '26.50', '29.40', '0.00', 2, 5, 7, 1, 'Rua 15, 115 - Centro / Santa Fé do Sul - SP', '2015-06-09 20:00:13', '2015-06-09 20:00:45', '2015-06-09 20:01:00', '2015-06-09 20:01:10', NULL),
(54, '2015-06-09 21:12:49', '60.50', '63.40', '0.00', 41, 5, 7, 2, 'Av. Ana rocha de oliveira, 548 - Centro / Três Fronteiras - SP', '2015-06-09 21:13:21', '2015-06-09 21:17:02', '2015-06-09 21:17:40', '2015-06-09 21:17:53', NULL),
(55, '2015-06-10 15:41:40', '38.00', '40.90', '0.00', 42, 5, 7, 1, 'Avenida Presidente Vargas, 173 - Centro / Três Fronteitas - SP', '2015-06-10 15:43:54', '2015-06-10 15:46:25', '2015-06-10 16:50:57', '2015-06-10 16:51:09', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `descricao` varchar(256) NOT NULL DEFAULT '-',
  `id_categoria` int(11) NOT NULL,
  `status` char(1) CHARACTER SET latin1 NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_com_restaurantes` (`id_restaurante`),
  KEY `fk_com_categorias` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `valor`, `id_restaurante`, `descricao`, `id_categoria`, `status`) VALUES
(4, 'Português', '19.00', 5, 'mussarela, presunto, palmito, ovo, milho, ervilha, tomate e cebola', 10, '1'),
(5, '4 Queijos', '19.00', 5, 'mussarela, provolone, parmesão e catupiry', 10, '1'),
(6, 'Frango Especial', '19.00', 5, 'frango desfiado, salame, calabresa, tomate, azeitona e cebola', 10, '1'),
(7, 'Bauru', '16.00', 5, 'mussarela, presunto e tomate', 10, '1'),
(8, 'Frango c/ Catupiry', '17.00', 5, 'mussarela, frango desfiado e catupiry', 10, '1'),
(9, 'Vegetariano', '18.00', 5, 'mussarela, milho, ervilha, tomate, palmito, azeitona e cebola', 10, '1'),
(10, 'Americana', '22.50', 5, 'mussarela, presunto, tomate e azeitona', 11, '1'),
(11, 'Aliche', '26.00', 5, 'mussarela, aliche, tomate e azeitona', 11, '1'),
(12, 'Calabresa', '21.00', 5, 'calabresa e cebola', 11, '1'),
(13, 'Frango Especial', '29.50', 5, 'mussarela, frango desfiado, bacon, milho, tomate e azeitona', 11, '1'),
(14, 'Brigadeiro', '25.50', 5, 'leite condensado, mussarela, chocolate e chocolate granulado', 12, '1'),
(15, 'Pretígio', '25.50', 5, ' leite condensado, mussarela e goiabada', 12, '1'),
(16, 'Lombo c/ Catupiry', '1.80', 5, 'lombo e catupiry', 9, '1'),
(17, 'Portuguesa', '2.30', 5, 'mussarela, presunto, milho, ervilha ovo e tomate', 9, '1'),
(18, 'Bacon Especial', '2.30', 5, 'mussarela, bacon, palmito e catupiry', 9, '1'),
(19, 'Mista', '10.80', 5, 'mussarela, provolone, lombo canadense, calabresa, tomate, azeitona e alho frito', 13, '1'),
(20, 'Moda da Casa', '8.20', 5, 'mussarela, calabresa, tomate, milho, ervilha, ovo, palmito, azeitona e cebola', 13, '1'),
(21, 'Portuguesa especial', '12.80', 5, 'mussarela, provolone, presunto, lombo canadense, calabresa, ervilha, tomate, ovo palmito e azeitona', 13, '1'),
(22, 'Provolombo ', '10.00', 5, 'mussarela, provolone, lombo canadense, tomate e azeitona', 13, '1'),
(23, 'Sabor e Requinte II', '20.00', 5, 'mussarela e carne louca', 10, '1'),
(24, 'Calabresa c/ Queijo', '17.00', 5, 'mussarela, calabresa e cebola', 10, '1'),
(25, 'Toscana', '27.50', 5, 'mussarela, calabresa moída tomate seco e azeitona', 10, '1'),
(26, 'Sabor e Requinte I', '18.50', 5, 'carne cozida e desfiada, temperada c/ tomate, cebola e pimentão (carne louca)', 10, '1'),
(27, 'Portuguesa', '2.30', 5, 'mussarela, presunto, milho, ervilha ovo e tomate', 9, '1'),
(28, 'Bauru ', '1.80', 5, 'mussarela, presunto e tomate', 9, '1'),
(35, 'Coca-Cola 2L', '6.50', 5, '-', 18, '1'),
(36, '4 Queijos', '28.50', 8, '4 Queijos diferentes mas parecem iguais', 19, '1'),
(37, 'Frango c/ Catupiry', '26.50', 8, 'Frango com Catupiry', 19, '1'),
(38, 'Caipira ', '28.00', 8, 'Frango, bacon, catupiry, mussarela e alho', 19, '1'),
(39, 'Suco de Laranja 1L', '6.50', 8, '-', 20, '1'),
(40, 'Suco de Maracujá 500ml', '3.50', 8, '-', 20, '1'),
(41, 'Brócolis com Bacon', '27.00', 8, 'Presunto, Queijo, Brócolis, Tomate e Bacon', 19, '1'),
(42, 'Pizza de Berinjela', '29.00', 5, 'Berinjela e Carne Moida', 11, '1'),
(43, 'Guaravita 2L', '4.90', 5, '-', 18, '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `restaurantes`
--

CREATE TABLE IF NOT EXISTS `restaurantes` (
  `id_restaurante` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  `tempo_entrega` varchar(10) NOT NULL,
  `razao_social` varchar(120) NOT NULL,
  `cnpj` varchar(30) NOT NULL,
  `fone` varchar(20) DEFAULT NULL,
  `nome_fantasia` varchar(120) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'Fechado',
  `logradouro` varchar(150) NOT NULL,
  `numero` varchar(7) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(80) NOT NULL,
  `fav` int(11) NOT NULL DEFAULT '0',
  `hora_abert` time DEFAULT NULL,
  `hora_fech` time DEFAULT NULL,
  `compra_minima` decimal(6,2) NOT NULL DEFAULT '0.00',
  `taxa_servico` decimal(6,2) NOT NULL DEFAULT '2.90',
  `taxa_paypal` decimal(6,2) NOT NULL DEFAULT '6.40',
  `taxa_adm` decimal(6,2) NOT NULL DEFAULT '6.50',
  PRIMARY KEY (`id_restaurante`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `restaurantes`
--

INSERT INTO `restaurantes` (`id_restaurante`, `tipo`, `tempo_entrega`, `razao_social`, `cnpj`, `fone`, `nome_fantasia`, `status`, `logradouro`, `numero`, `bairro`, `cidade`, `fav`, `hora_abert`, `hora_fech`, `compra_minima`, `taxa_servico`, `taxa_paypal`, `taxa_adm`) VALUES
(5, 'Pizzaria', '40 min', 'Restaurante de Teste 1', '15.785.215/1881-85', '(17) - 3631-2313', 'Restaurante de Teste 1', 'Aberto', 'Av. Navarro de Andrade', '1188', 'Centro', 'Santa Fé do Sul - SP', 1, '18:00:00', '23:30:00', '10.00', '2.90', '6.40', '9.00'),
(6, 'Lanchonete', '35 min', 'Restaurante de Teste 2', '12.313.123/1312-31', '(12) - 3123-1231', 'Restaurante de Teste 2', 'Fechado', 'Av. Navarro de Andrade', '1330', 'Centro', 'Santa Fé do Sul - SP', 0, '19:00:00', '00:30:00', '12.00', '2.90', '6.40', '8.00'),
(7, 'Lanchonete', '40 min', 'Restaurante de Teste 3', '23.123.123/0013-13', '(13) - 1237-1236', 'Restaurante de Teste 3', 'Fechado', 'Av. Navarro de Andrade', '566', 'Centro', 'Santa Fé do Sul - SP', 0, '20:00:00', '00:00:00', '15.00', '2.90', '6.40', '6.50'),
(8, 'Pizzaria', '50 min', 'Restaurante de Teste 4', '12.387.123/8173-87', '(18) - 2371-8237', 'Restaurante de Teste 4', 'Fechado', 'Av. Navarro de Andrade', '956', 'Centro', 'Santa Fé do Sul - SP', 0, '18:30:00', '23:50:00', '10.00', '1.00', '6.40', '8.00'),
(9, 'Lanchonete', '40 min', 'Restaurante de Teste 5', '12.312.738/2173-82', '(17) - 7371-3713', 'Restaurante de Teste 5', 'Fechado', 'Praça Stélio M. Toureiro', '1', 'Centro', 'Santa Fé do Sul - SP', 0, '18:00:00', '23:30:00', '15.00', '2.90', '6.40', '6.50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_pgto`
--

CREATE TABLE IF NOT EXISTS `status_pgto` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `status_pgto`
--

INSERT INTO `status_pgto` (`id_status`, `nome`) VALUES
(1, 'Aguardando Confirmação de Pagamento'),
(2, 'Pagamento não confirmado pela operadora de crédito'),
(3, 'Pedido cancelado, Erro ao efetuar o pagamento'),
(4, 'Pagamento Confirmado, aguarde'),
(5, 'Pedido recebido pelo restaurante, aguarde enquanto preparamos sua refeição'),
(6, 'Seu pedido ja foi preparado e encontra-se em transporte para entrega'),
(7, 'Pedido entregue com sucesso! Obrigado pela preferência :)'),
(8, 'Ocorreu um erro ao preparar sua refeição, por favor entre em contato conosco o mais rapido possivel'),
(9, 'Pedido cancelado por inconsistência nos dados, por favor entre em contato conosco o mais rapido possivel'),
(10, 'Atenção: Seu pagamento está pendente em nosso sistema, acesse sua conta no paypal e verifique');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subscribes`
--

CREATE TABLE IF NOT EXISTS `subscribes` (
  `id_subs` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_subs`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Extraindo dados da tabela `subscribes`
--

INSERT INTO `subscribes` (`id_subs`, `email`) VALUES
(13, 'admin@godfood.com.br'),
(9, 'contato@godfood.com.br'),
(1, 'eduovrp@gmail.com'),
(2, 'eduovrp@hotmail.com'),
(17, 'guilhermebs_26@hotmail.com'),
(30, 'joilsomen@hotmail.com'),
(32, 'leticinha_donatoni@hotmail.com'),
(24, 'marcosfernando7@gmail.com'),
(33, 'nathalia.esteves1996@hotmail.com'),
(3, 'stripersduuh@hotmail.com'),
(28, 'teste@godfood.com.br'),
(26, 'teste@hotmail.com'),
(14, 'wzana@outlook.com.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarifas`
--

CREATE TABLE IF NOT EXISTS `tarifas` (
  `id_tarifa` int(11) NOT NULL AUTO_INCREMENT,
  `id_restaurante` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `vTotal_Pago` decimal(6,2) NOT NULL,
  `vTotal_Pedido` decimal(6,2) NOT NULL,
  `vLiquido_Restaurante` decimal(6,2) NOT NULL,
  `vLiquido_Adm` decimal(6,2) NOT NULL,
  `vTaxas_Restaurante` decimal(6,2) NOT NULL,
  `vTarifa_pgto` decimal(6,2) NOT NULL,
  `vTotal_Tarifas` decimal(6,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `taxa_paypal_porc` decimal(6,2) NOT NULL DEFAULT '6.40',
  `taxa_paypal_60` decimal(6,2) NOT NULL DEFAULT '0.60',
  `taxa_adm` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_tarifa`),
  KEY `fk_pedidos_tarifas` (`id_pedido`),
  KEY `fk_tarifas_restaurantes` (`id_restaurante`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Extraindo dados da tabela `tarifas`
--

INSERT INTO `tarifas` (`id_tarifa`, `id_restaurante`, `id_pedido`, `data`, `vTotal_Pago`, `vTotal_Pedido`, `vLiquido_Restaurante`, `vLiquido_Adm`, `vTaxas_Restaurante`, `vTarifa_pgto`, `vTotal_Tarifas`, `status`, `taxa_paypal_porc`, `taxa_paypal_60`, `taxa_adm`) VALUES
(25, 5, 23, '2015-06-01 19:20:24', '22.90', '20.00', '16.32', '4.51', '3.68', '2.07', '6.58', 1, '6.40', '0.60', '9'),
(26, 5, 24, '2015-06-01 19:50:06', '16.20', '13.30', '10.65', '3.91', '2.65', '1.64', '5.55', 1, '6.40', '0.60', '9'),
(27, 5, 25, '2015-06-02 12:04:42', '25.40', '22.50', '18.44', '4.74', '4.07', '2.23', '6.97', 1, '6.40', '0.60', '9'),
(28, 5, 26, '2015-06-02 13:46:52', '69.90', '67.00', '56.08', '8.74', '10.92', '5.07', '13.82', 1, '6.40', '0.60', '9'),
(29, 5, 27, '2015-06-02 22:17:16', '32.90', '30.00', '24.78', '5.41', '5.22', '2.71', '8.12', 1, '6.40', '0.60', '9'),
(30, 5, 28, '2015-06-02 22:31:21', '15.70', '12.80', '10.23', '3.87', '2.57', '1.60', '5.47', 1, '6.40', '0.60', '9'),
(31, 5, 29, '2015-06-02 22:34:05', '63.90', '61.00', '51.01', '8.20', '9.99', '4.69', '12.89', 1, '6.40', '0.60', '9'),
(32, 5, 30, '2015-06-02 23:24:44', '28.70', '25.80', '21.23', '5.04', '4.57', '2.44', '7.47', 1, '6.40', '0.60', '9'),
(33, 5, 31, '2015-06-02 23:31:27', '41.40', '38.50', '31.97', '6.18', '6.53', '3.25', '9.43', 1, '6.40', '0.60', '9'),
(34, 5, 32, '2015-06-03 00:26:16', '41.40', '38.50', '31.97', '6.18', '6.53', '3.25', '9.43', 1, '6.40', '0.60', '9'),
(35, 5, 33, '2015-06-03 00:37:51', '27.80', '24.90', '20.47', '4.96', '4.43', '2.38', '7.33', 1, '6.40', '0.60', '9'),
(38, 5, 36, '2015-06-03 15:17:55', '48.90', '46.00', '38.32', '6.85', '7.68', '3.73', '10.58', 0, '6.40', '0.60', '9'),
(39, 5, 37, '2015-06-03 15:18:23', '48.90', '46.00', '38.32', '6.85', '7.68', '3.73', '10.58', 0, '6.40', '0.60', '9'),
(40, 5, 38, '2015-06-03 15:19:05', '28.40', '25.50', '20.97', '5.01', '4.53', '2.42', '7.43', 0, '6.40', '0.60', '9'),
(41, 5, 39, '2015-06-03 22:13:03', '29.40', '26.50', '21.82', '5.10', '4.68', '2.48', '7.58', 0, '6.40', '0.60', '9'),
(42, 5, 40, '2015-06-03 22:28:52', '25.40', '22.50', '18.44', '4.74', '4.07', '2.23', '6.97', 1, '6.40', '0.60', '9'),
(43, 5, 41, '2015-06-03 22:33:41', '33.60', '30.70', '25.37', '5.48', '5.33', '2.75', '8.23', 1, '6.40', '0.60', '9'),
(44, 5, 42, '2015-06-03 22:47:39', '55.40', '52.50', '43.82', '7.44', '8.69', '4.15', '11.59', 1, '6.40', '0.60', '9'),
(45, 5, 43, '2015-06-03 23:02:32', '28.40', '25.50', '20.97', '5.01', '4.53', '2.42', '7.43', 1, '6.40', '0.60', '9'),
(46, 5, 44, '2015-06-04 17:10:38', '54.90', '52.00', '43.39', '7.39', '8.61', '4.11', '11.51', 1, '6.40', '0.60', '9'),
(47, 5, 45, '2015-06-04 17:43:08', '59.40', '56.50', '47.20', '7.80', '9.30', '4.40', '12.20', 1, '6.40', '0.60', '9'),
(48, 5, 46, '2015-06-06 02:12:52', '38.90', '36.00', '29.86', '5.95', '6.14', '3.09', '9.04', 1, '6.40', '0.60', '9'),
(49, 5, 47, '2015-06-06 04:10:07', '25.40', '22.50', '18.44', '4.74', '4.07', '2.23', '6.97', 1, '6.40', '0.60', '9'),
(50, 5, 48, '2015-06-08 17:25:13', '25.40', '22.50', '18.44', '4.74', '4.07', '2.23', '6.97', 1, '6.40', '0.60', '9'),
(52, 5, 50, '2015-06-08 18:47:09', '32.50', '23.60', '24.44', '5.38', '5.16', '2.68', '8.06', 1, '6.40', '0.60', '9'),
(53, 5, 51, '2015-06-08 18:46:23', '21.90', '19.00', '15.47', '4.42', '3.53', '2.00', '6.43', 1, '6.40', '0.60', '9'),
(54, 5, 52, '2015-06-09 15:28:30', '44.50', '36.60', '34.59', '6.46', '7.01', '3.45', '9.91', 0, '6.40', '0.60', '9'),
(55, 5, 53, '2015-06-09 22:59:47', '29.40', '26.50', '21.82', '5.10', '4.68', '2.48', '7.58', 1, '6.40', '0.60', '9'),
(56, 5, 54, '2015-06-10 00:12:55', '63.40', '60.50', '50.58', '8.16', '9.92', '4.66', '12.82', 1, '6.40', '0.60', '9'),
(57, 5, 55, '2015-06-10 18:43:28', '40.90', '38.00', '31.55', '6.13', '6.45', '3.22', '9.35', 1, '6.40', '0.60', '9');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `cpf` char(14) CHARACTER SET latin1 NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `id_nivel` int(11) NOT NULL DEFAULT '1',
  `usr_ativo` tinyint(1) NOT NULL DEFAULT '0',
  `hash_ativar_conta` varchar(40) DEFAULT NULL,
  `senha_reset_hash` char(40) CHARACTER SET latin1 DEFAULT NULL,
  `senha_reset_timestamp` timestamp NULL DEFAULT NULL,
  `rememberme_token` varchar(64) DEFAULT NULL,
  `failed_login` tinyint(1) NOT NULL DEFAULT '0',
  `last_failed_login` int(10) DEFAULT NULL,
  `data_registro` timestamp NULL DEFAULT NULL,
  `ip_registro` varchar(39) NOT NULL DEFAULT '0.0.0.0',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `user_UNIQUE` (`login`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  KEY `fk_usuarios_niveis` (`id_nivel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `login`, `senha`, `email`, `nome`, `cpf`, `telefone`, `celular`, `id_nivel`, `usr_ativo`, `hash_ativar_conta`, `senha_reset_hash`, `senha_reset_timestamp`, `rememberme_token`, `failed_login`, `last_failed_login`, `data_registro`, `ip_registro`) VALUES
(2, 'admin', 'aa382912594903549b16f6c6aeef58020972330df8183ccadc6b267c5efee6b7b3260ec020e9e3a5140bfcd9d61ebdbdc152b6c0a41173b704e7f74ed99a1ffc', 'teste@gmail.com', 'Eduardo Lopes', '000.000.000-00', '', '', 5, 1, NULL, NULL, NULL, NULL, 0, NULL, '2015-04-15 14:46:18', '127.0.0.1'),
(8, 'eduovrp1', '4817714bd05c0ea638e51189e367f0bb03085d221d6d3f1eaf8ba465819535a3321444fbf994896929a8b79f0991025b970f70d597049d425a27176d8994896a', 'admin@godfood.com.br', 'Admin', '111.111.111-11', '', '', 5, 1, NULL, NULL, NULL, NULL, 0, NULL, '2015-05-22 12:36:21', '127.0.0.1'),
(25, 'marcosfs', '74356d9220a841e320651007e509399ebf389fee5a817df9192f47dbacf1d1f7a10063a364f61c39b3c9807ec17970c882cc9eec098c20834933195fd3a6b599', 'marcosfernando7@gmail.com', 'Marcos Fernando', '777.777.777-77', '', '(17) - 99609-8049', 1, 1, NULL, NULL, NULL, NULL, 0, NULL, '2015-06-03 15:14:03', '186.225.145.106'),
(34, 'teste', 'aa382912594903549b16f6c6aeef58020972330df8183ccadc6b267c5efee6b7b3260ec020e9e3a5140bfcd9d61ebdbdc152b6c0a41173b704e7f74ed99a1ffc', 'eduovrp@godfood.com.br', 'Eduardo Lopes', '222.222.222-22', '', '(17) - 99764-0291', 1, 1, NULL, NULL, NULL, NULL, 0, NULL, '2015-06-04 17:01:51', '187.10.35.158'),
(38, 'jrsimensato', '50e61808ed28c0b0be9ada99c3e0b51e0d30aecccd823472a1ec9f1aec87c0ed70188cf3d5c314f8f2855a4f17fac56908584af2e9688f6a99a1f16ebd9763ae', 'juniorsimensato@outlook.com', 'onivaldo simensato junior', '400.219.628-39', '(17) - 3442-5882', '(17) - 99625-4065', 1, 1, NULL, NULL, NULL, NULL, 0, NULL, '2015-08-06 15:18:34', '177.234.146.154'),
(40, 'joilso', '507b1d0a3252b0f2f1ed99b3ae07c4538009991dd708aa8a094614ce4892cad5d6ba349514773dc20589e875aa992ebb516d8a56d39fb1dbafbb5d210f28b1f0', 'joilsomen@hotmail.com', 'Joilso Meira Novais', '039.000.801-00', '(17) - 3641-2099', '(17) - 99109-2211', 1, 1, NULL, NULL, NULL, NULL, 0, NULL, '2015-06-09 23:49:20', '177.234.146.154'),
(41, 'eduovrp', 'aa382912594903549b16f6c6aeef58020972330df8183ccadc6b267c5efee6b7b3260ec020e9e3a5140bfcd9d61ebdbdc152b6c0a41173b704e7f74ed99a1ffc', 'eduovrp@hotmail.com', 'Eduardo Lopes', '367.584.768-39', '', '(17) - 99764-0291', 5, 1, NULL, NULL, '2015-06-10 22:19:51', NULL, 0, NULL, '2015-06-10 00:09:58', '177.234.146.154'),
(42, 'le_yee', '8e6d54edb1c1fd0b83a2d631ce21e71a81585780da28203a581fde1a1acbf64efe3c85e3047d53c6d82d924e27e07c40f4875dab5c3db44f8efab29fba12286a', 'leticinha_donatoni@hotmail.com', 'Letícia Donatoni Marim', '368.782.268-05', '(17) - 3691-1283', '(17) - 99702-2833', 1, 1, NULL, NULL, NULL, NULL, 0, NULL, '2015-06-10 18:28:32', '177.234.146.154'),
(43, 'Nathalia Esteves', '42da7425fa9c6ad72042a2dea2c762578f74bedd84424ae41df27e6967e9c99e5867bf69d23d58089f3a101670111df6d0d9fcee8341dd35e973264db824babe', 'nathalia.esteves1996@hotmail.com', 'Nathalia Silva Esteves', '456.825.288-16', '(17) - 3631-0841', '(17) - 99604-2539', 1, 0, 'daf10525e2bf19f3ba25fdf1efb1d41943f95e45', NULL, NULL, NULL, 0, NULL, '2015-06-10 18:50:15', '177.234.146.154');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `adicionais`
--
ALTER TABLE `adicionais`
  ADD CONSTRAINT `fk_adicioanais_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Limitadores para a tabela `bordas`
--
ALTER TABLE `bordas`
  ADD CONSTRAINT `fk_bordas_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Limitadores para a tabela `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_categorias_restaurantes` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`);

--
-- Limitadores para a tabela `cidades`
--
ALTER TABLE `cidades`
  ADD CONSTRAINT `fk_com_estados` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`cod_estados`);

--
-- Limitadores para a tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `fk_com_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `entregas_restaurantes`
--
ALTER TABLE `entregas_restaurantes`
  ADD CONSTRAINT `fk_entrega_cidade` FOREIGN KEY (`id_cidade_entrega`) REFERENCES `cidades_entregas` (`id_cidade_entrega`),
  ADD CONSTRAINT `fk_entrega_restaurantes` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`);

--
-- Limitadores para a tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `fk_funcionarios_niveis` FOREIGN KEY (`id_nivel`) REFERENCES `niveis_usuarios` (`id_nivel`),
  ADD CONSTRAINT `fk_funcionarios_restaurantes` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`);

--
-- Limitadores para a tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD CONSTRAINT `fk_itens_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `fk_itens_produtos` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD CONSTRAINT `fk_mensagens_restaurantes` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`);

--
-- Limitadores para a tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `fk_pagamentos_pedidos1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_cidade_entrega` FOREIGN KEY (`id_cidade_entrega`) REFERENCES `cidades_entregas` (`id_cidade_entrega`),
  ADD CONSTRAINT `fk_pedidos_restaurantes` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`),
  ADD CONSTRAINT `fk_pedido_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `fk_status_pedidos` FOREIGN KEY (`id_status`) REFERENCES `status_pgto` (`id_status`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `fk_produtos_restaurantes` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`);

--
-- Limitadores para a tabela `tarifas`
--
ALTER TABLE `tarifas`
  ADD CONSTRAINT `fk_tarifas_pedidos` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `fk_tarifas_restaurantes` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
