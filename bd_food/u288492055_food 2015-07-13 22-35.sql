-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14-Jul-2015 às 03:35
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
  `status` char(1) CHARACTER SET latin1 NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_adicional`),
  KEY `fk_adicioanais_categorias` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Extraindo dados da tabela `adicionais`
--

INSERT INTO `adicionais` (`id_adicional`, `nome`, `valor`, `id_categoria`, `status`) VALUES
(1, 'Cheddar', '0.50', 9, '1'),
(2, 'Bacon', '0.50', 9, '1'),
(3, 'Catupiry', '0.50', 9, '1'),
(4, 'Calabreza', '0.50', 9, '1'),
(5, 'Queijo', '0.50', 9, '1'),
(6, 'Lombo', '0.50', 9, '1'),
(7, 'Palmito', '0.50', 9, '1'),
(8, 'Cheddar', '3.00', 10, '1'),
(9, 'Catupiry', '2.50', 10, '1'),
(10, 'Bacon', '3.00', 10, '1'),
(11, 'Tomate', '1.50', 10, '1'),
(12, 'Calabresa', '3.50', 10, '1'),
(15, 'Catupiry', '2.00', 13, '1'),
(16, 'Cheddar', '2.50', 13, '1'),
(17, 'Calabresa', '2.50', 13, '1'),
(20, 'Catupiry', '4.00', 11, '1'),
(21, 'Cheddar', '4.50', 11, '1'),
(22, 'Calabresa', '4.50', 11, '1'),
(23, 'Queijo', '4.00', 11, '1'),
(24, 'Tomate', '0.50', 9, '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bordas`
--

CREATE TABLE IF NOT EXISTS `bordas` (
  `id_borda` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `valor` decimal(6,2) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `status` char(1) CHARACTER SET latin1 NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_borda`),
  KEY `fk_bordas_categorias` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `bordas`
--

INSERT INTO `bordas` (`id_borda`, `nome`, `valor`, `id_categoria`, `status`) VALUES
(1, 'Cheddar', '3.00', 10, '1'),
(2, 'Catupiry', '2.50', 10, '0'),
(3, 'Calabresa', '3.50', 10, '1'),
(4, 'Goiabada', '2.50', 10, '1'),
(5, 'Doce de Leite', '2.50', 10, '1'),
(6, 'Catupiry', '2.00', 13, '1'),
(7, 'Cheddar', '2.50', 13, '1'),
(8, 'Calabresa', '2.50', 13, '1'),
(9, 'Goiabada ', '2.00', 13, '1'),
(10, 'Doce de leite', '2.00', 13, '1'),
(11, 'Catupiry', '4.00', 11, '1'),
(12, 'Cheddar', '4.50', 11, '1'),
(13, 'Calabresa', '4.50', 11, '1'),
(14, 'Goiabada', '4.00', 11, '1'),
(15, 'Doce de Leite', '4.00', 11, '1'),
(16, 'Brigadeiro', '4.00', 12, '0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nome`, `id_restaurante`, `2sabores`) VALUES
(9, 'Mini Esfirra', 5, 'Não'),
(10, 'Calzone', 5, 'Sim'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

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
(17, 'Rua Dos Eucaliptos', '90', 'Jardim Universitário 2', '', '', 'SP', 'Santa Fé do Sul', '15775-000', 43),
(18, 'Rua Jose Claudio Fogaça', '875', 'Centro', '', '', 'SP', 'Santa Fe do Sul', '15775-000', 44),
(19, 'Rua Jose Claudio Fogaça', '875', 'Centro', '', '', 'SP', 'Três Fronteiras', '15770-000', 44),
(20, 'Rua 7 de Setembro', '222', 'São Francisco', '', '', 'SP', 'Santa Fé do Sul', '15775-000', 45),
(21, 'Av. Teste', '554', 'Centro', '', '', 'SP', 'Jales', '15700-000', 41),
(22, 'Rua dos Testes 2', '8855', 'Centro', '', '', 'SP', 'Fernandópolis', '15600-000', 41),
(23, 'Rua dos Testes', '123', 'Jd Rafael', '', '', 'SP', 'Três Fronteiras', '15770-000', 41),
(24, 'Av. das Tretas', '669', 'Mamilos', '', '', 'SP', 'Três Fronteiras', '15770-000', 41),
(25, 'Rua das Avenidas', '338', 'Alameda', 'Perto do negocio la', 'sim', 'SP', 'Três Fronteiras', '15770-000', 41),
(26, 'Endereço dos Endereços', '884', 'Centro', '', '', 'SP', 'Santa Fé do Sul', '15775-000', 41),
(27, 'Rua das ilhas', '443', 'Solteiras', '', '', 'SP', 'Ilha Solteira', '15385-000', 41);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Extraindo dados da tabela `entregas_restaurantes`
--

INSERT INTO `entregas_restaurantes` (`id_entrega`, `id_cidade_entrega`, `id_restaurante`, `taxa`) VALUES
(22, 1, 5, '0.00'),
(23, 2, 5, '2.00'),
(24, 3, 5, '3.00'),
(25, 4, 5, '3.00'),
(26, 6, 5, '1.00'),
(27, 1, 6, '0.00'),
(28, 1, 8, '0.00');

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
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_funcionario`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `usuario_2` (`usuario`),
  KEY `fk_funcionarios_restaurantes` (`id_restaurante`),
  KEY `fk_funcionarios_niveis` (`id_nivel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id_funcionario`, `nome`, `cpf`, `telefone`, `usuario`, `senha`, `id_nivel`, `id_restaurante`, `data`) VALUES
(1, 'Funcionario Teste', '612.818.181-81', '(15) - 15151-5151', 'teste', '176b9dd7906dd9919b94aa17686d282628daee473bfe3576677959e87a8320d4f15c33fc5e1a98be9d44d789b828164ee748706b7c758db58d706cdb6cea692c', 2, 5, '2015-05-20 18:59:36'),
(2, 'Proprietario Teste', '848.484.844-54', '(15) - 81801-8181', 'proprietario', '176b9dd7906dd9919b94aa17686d282628daee473bfe3576677959e87a8320d4f15c33fc5e1a98be9d44d789b828164ee748706b7c758db58d706cdb6cea692c', 4, 5, '2015-05-20 19:02:14'),
(3, 'teste1', '128.372.183-71', '(15) - 8181-8181', 'teste1', '176b9dd7906dd9919b94aa17686d282628daee473bfe3576677959e87a8320d4f15c33fc5e1a98be9d44d789b828164ee748706b7c758db58d706cdb6cea692c', 3, 8, '2015-05-25 19:19:01'),
(4, 'Teste', '312.932.198-38', '(17) - 8888-8888', 'teste3', 'b6c39372ed94b613747bb6ad156cfdfaeb4b2302b77097f8a2aabb58efedb679146f13dbf18f5bf2fd01f2f61945d7b42f8684dff598849fbc150779005ad18f', 2, 5, '2015-06-10 00:24:07'),
(5, 'teste2', '123.812.738-21', '', 'teste2', '176b9dd7906dd9919b94aa17686d282628daee473bfe3576677959e87a8320d4f15c33fc5e1a98be9d44d789b828164ee748706b7c758db58d706cdb6cea692c', 4, 6, '2015-06-24 01:14:22'),
(6, 'funcionario1', '128.372.183-71', '', 'funcionario1', '176b9dd7906dd9919b94aa17686d282628daee473bfe3576677959e87a8320d4f15c33fc5e1a98be9d44d789b828164ee748706b7c758db58d706cdb6cea692c', 2, 8, '2015-07-01 19:58:16'),
(7, 'dono1', '128.321.837-12', '', 'dono1', '176b9dd7906dd9919b94aa17686d282628daee473bfe3576677959e87a8320d4f15c33fc5e1a98be9d44d789b828164ee748706b7c758db58d706cdb6cea692c', 4, 8, '2015-07-01 20:29:06'),
(10, 'teste19', '128.372.183-72', '', 'teste19', '176b9dd7906dd9919b94aa17686d282628daee473bfe3576677959e87a8320d4f15c33fc5e1a98be9d44d789b828164ee748706b7c758db58d706cdb6cea692c', 2, 8, '2015-07-01 20:41:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens`
--

CREATE TABLE IF NOT EXISTS `imagens` (
  `id_imagem` int(11) NOT NULL AUTO_INCREMENT,
  `banner_index` varchar(100) DEFAULT NULL,
  `alt` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_imagem`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `imagens`
--

INSERT INTO `imagens` (`id_imagem`, `banner_index`, `alt`) VALUES
(9, 'images/banner.jpg', 'Pizza'),
(10, 'images/banner1.jpg', 'Sushi'),
(11, 'images/banner2.jpg', 'Lanche'),
(12, 'images/banner3.jpg', 'Esfirra');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_pedido`
--

CREATE TABLE IF NOT EXISTS `itens_pedido` (
  `id_item_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `produto` varchar(200) DEFAULT NULL,
  `qtd` int(11) NOT NULL,
  `id_adicional` int(11) DEFAULT NULL,
  `adicional` varchar(40) DEFAULT 'Nenhum',
  `id_borda` int(11) DEFAULT NULL,
  `borda` varchar(40) DEFAULT 'Não',
  `obs` varchar(160) DEFAULT NULL,
  `valor_unit` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id_item_pedido`),
  KEY `fk_itens_pedido` (`id_pedido`),
  KEY `fk_itens_produtos` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=205 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=129 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

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
(39, 'Suco de Laranja 1L', '6.50', 8, '-', 18, '0'),
(40, 'Suco de Maracujá 500ml', '3.50', 8, '-', 18, '1'),
(41, 'Brócolis com Bacon', '27.00', 8, 'Presunto, Queijo, Brócolis, Tomate e Bacon', 19, '1'),
(42, 'Pizza de Berinjela', '29.00', 5, 'Berinjela e Carne Moida', 11, '1'),
(43, 'Guaravita 2L', '4.90', 5, '-', 18, '1'),
(44, 'Cotuba 600ml', '2.00', 5, '-', 18, '1');

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
(6, 'Lanchonete', '35 min', 'Restaurante de Teste 2', '12.313.123/1312-31', '(12) - 3123-1231', 'Restaurante de Teste 2', 'Aberto', 'Av. Navarro de Andrade', '1330', 'Centro', 'Santa Fé do Sul - SP', 0, '19:00:00', '00:30:00', '12.00', '2.90', '6.40', '8.00'),
(7, 'Lanchonete', '40 min', 'Restaurante de Teste 3', '23.123.123/0013-13', '(13) - 1237-1236', 'Restaurante de Teste 3', 'Fechado', 'Av. Navarro de Andrade', '566', 'Centro', 'Santa Fé do Sul - SP', 0, '20:00:00', '00:00:00', '15.00', '2.90', '6.40', '6.50'),
(8, 'Pizzaria', '50 min', 'Restaurante de Teste 4', '12.387.123/8173-87', '(18) - 2371-8237', 'Restaurante de Teste 4', 'Aberto', 'Av. Navarro de Andrade', '956', 'Centro', 'Santa Fé do Sul - SP', 0, '18:30:00', '23:50:00', '10.00', '1.00', '6.40', '8.00'),
(9, 'Lanchonete', '40 min', 'Restaurante de Teste 5', '12.312.738/2173-82', '(17) - 7371-3713', 'Restaurante de Teste 5', 'Fechado', 'Praça Stélio M. Toureiro', '1', 'Centro', 'Santa Fé do Sul - SP', 0, '18:00:00', '23:30:00', '15.00', '2.90', '6.40', '6.50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_pgto`
--

CREATE TABLE IF NOT EXISTS `status_pgto` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL,
  `status_reduzido` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `status_pgto`
--

INSERT INTO `status_pgto` (`id_status`, `nome`, `status_reduzido`) VALUES
(1, 'Aguardando Confirmação de Pagamento', 'Aguardando Confirmação de Pagamento.'),
(2, 'Pagamento não confirmado pela operadora de crédito', 'Pagamento não confirmado.'),
(3, 'Pedido cancelado, Erro ao efetuar o pagamento', 'Pedido cancelado, Erro ao efetuar o pagamento.'),
(4, 'Pagamento Confirmado, aguarde', 'Pagamento Confirmado, aguarde.'),
(5, 'Pedido recebido pelo restaurante, aguarde enquanto preparamos sua refeição', 'Pedido recebido pelo restaurante, aguarde.'),
(6, 'Seu pedido ja foi preparado e encontra-se em transporte para entrega', 'Seu pedido ja foi preparado e encontra-se em transporte.'),
(7, 'Pedido entregue com sucesso! Obrigado pela preferência, esperamos seu retorno em breve :)', 'Pedido entregue com sucesso! Obrigado pela preferência.'),
(8, 'Ocorreu um erro ao preparar sua refeição, por favor entre em contato conosco o mais rapido possivel', 'Ocorreu um erro ao preparar sua refeição.'),
(9, 'Pedido cancelado por inconsistência nos dados, por favor entre em contato conosco o mais rapido possivel', 'Pedido cancelado por inconsistência nos dados'),
(10, 'Atenção: Seu pagamento está pendente em nosso sistema, acesse sua conta no paypal e verifique', 'Seu pagamento está pendente em nosso sistema.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subscribes`
--

CREATE TABLE IF NOT EXISTS `subscribes` (
  `id_subs` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_subs`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

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
(34, 'matheus.sfs95@gmail.com'),
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
  `status` int(1) NOT NULL DEFAULT '1',
  `taxa_paypal_porc` decimal(6,2) NOT NULL DEFAULT '4.49',
  `taxa_paypal_60` decimal(6,2) NOT NULL DEFAULT '0.00',
  `taxa_adm` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_tarifa`),
  KEY `fk_pedidos_tarifas` (`id_pedido`),
  KEY `fk_tarifas_restaurantes` (`id_restaurante`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=135 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

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
(41, 'eduovrp', 'aa382912594903549b16f6c6aeef58020972330df8183ccadc6b267c5efee6b7b3260ec020e9e3a5140bfcd9d61ebdbdc152b6c0a41173b704e7f74ed99a1ffc', 'eduovrp@gmail.com', 'Eduardo Lopes', '367.584.768-39', '', '(17) - 99764-0291', 5, 1, NULL, NULL, '2015-06-10 22:19:51', NULL, 0, NULL, '2015-06-10 00:09:58', '177.234.146.154'),
(42, 'le_yee', '8e6d54edb1c1fd0b83a2d631ce21e71a81585780da28203a581fde1a1acbf64efe3c85e3047d53c6d82d924e27e07c40f4875dab5c3db44f8efab29fba12286a', 'leticinha_donatoni@hotmail.com', 'Letícia Donatoni Marim', '368.782.268-05', '(17) - 3691-1283', '(17) - 99702-2833', 1, 1, NULL, NULL, NULL, NULL, 0, NULL, '2015-06-10 18:28:32', '177.234.146.154'),
(43, 'Nathalia Esteves', '42da7425fa9c6ad72042a2dea2c762578f74bedd84424ae41df27e6967e9c99e5867bf69d23d58089f3a101670111df6d0d9fcee8341dd35e973264db824babe', 'nathalia.esteves1996@hotmail.com', 'Nathalia Silva Esteves', '456.825.288-16', '(17) - 3631-0841', '(17) - 99604-2539', 1, 0, 'daf10525e2bf19f3ba25fdf1efb1d41943f95e45', NULL, NULL, NULL, 0, NULL, '2015-06-10 18:50:15', '177.234.146.154'),
(44, 'guiilopes', 'b6f255c0d564ff7ba293811b13c0f8028928c43f67842696567b44d7067322fd6c608fe1b36999a0c0a09a63ebe1ab80d19e37cde9ed201ce770439a1b73186c', 'guii-lopes@hotmail.com', 'GUILHERME LOPES', '394.742.068-48', '', '(17) - 99151-4510', 1, 1, NULL, NULL, NULL, NULL, 0, NULL, '2015-06-18 20:27:33', '187.10.35.8'),
(45, 'math', '232ba70f52d7e8d1eb0b16e284d111748755480bb99c1d3cd6a856458f13f457ae18170aa33505619390f85638f618708efdc08fe6e636a1400ec2a843c54346', 'matheus.sfs95@gmail.com', 'Matheus Augusto Santana da Silva', '455.621.928-02', '', '(17) - 99623-9953', 5, 1, NULL, NULL, NULL, NULL, 0, NULL, '2015-06-24 04:51:16', '201.93.18.103'),
(47, 'teste5', '176b9dd7906dd9919b94aa17686d282628daee473bfe3576677959e87a8320d4f15c33fc5e1a98be9d44d789b828164ee748706b7c758db58d706cdb6cea692c', 'eduovrp@hotmail.com', 'Teste5', '018.548.028-44', '', '(17) - 99764-0291', 1, 1, NULL, '4a52bd55e5ac5926d63a1c5be7f3eb1f3c332b87', '2015-06-30 16:54:04', NULL, 0, NULL, '2015-06-24 11:23:51', '187.11.172.251');

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
  ADD CONSTRAINT `fk_itens_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `fk_itens_pedidos` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`);

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
