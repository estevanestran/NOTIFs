-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/09/2023 às 19:23
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`) VALUES
(1, 'Auxílios'),
(2, 'Bolsas'),
(3, 'Comunicados'),
(4, 'Cursos'),
(5, 'Editais'),
(6, 'Eventos'),
(7, 'Oportunidades');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_noticia`
--

CREATE TABLE `categoria_noticia` (
  `id_categoria` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `categoria_noticia`
--

INSERT INTO `categoria_noticia` (`id_categoria`, `id_noticia`) VALUES
(1, 67),
(6, 81),
(6, 82),
(7, 88),
(6, 91);

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `curso`
--

INSERT INTO `curso` (`id`, `nome`) VALUES
(1, 'Administração'),
(2, 'Desenvolvimento de sistemas'),
(3, 'Eletrônica'),
(4, 'Engenharia eletrônica'),
(5, 'Análise e desenvolvimento de sistemas'),
(6, 'Automação industrial'),
(7, 'Logística'),
(8, 'Matemática'),
(9, 'Comércio'),
(10, 'Manutenção e suporte em informática'),
(11, 'Gestão de projetos e inovação'),
(12, 'Educação: integração de saberes'),
(13, 'Linguagens contemporâneas e ensino'),
(14, 'PROFMAT'),
(16, 'Sem curso');

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso_noticia`
--

CREATE TABLE `curso_noticia` (
  `id_curso` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `curso_noticia`
--

INSERT INTO `curso_noticia` (`id_curso`, `id_noticia`) VALUES
(2, 88),
(1, 91);

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `subtitulo` varchar(350) NOT NULL,
  `corpo` varchar(8000) NOT NULL,
  `data_noticia` date NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `foto` varchar(500) DEFAULT NULL,
  `alerta` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `noticia`
--

INSERT INTO `noticia` (`id`, `titulo`, `subtitulo`, `corpo`, `data_noticia`, `id_usuario`, `foto`, `alerta`) VALUES
(67, 'teste', 'teste', '<p>teste</p>', '2023-08-16', 81, '../uploads/64dd002a4486d.png', NULL),
(81, 'taylor swift anuncia 1989 TV', 'ebaaaa', '<p>&eacute; o aoty</p>', '2023-08-20', 1, '../uploads/64e22cec8719b.jpeg', 0),
(82, 'Encontro busca conscientização sobre as diferentes formas de violência contra a mulher no dia 22/08, às 19h30min', ' O Campus Canoas convida a comunidade a participar da palestra Recomeçar é possível sem violência, em alusão ao Agosto Lilás. Neste mês, comemora-se o aniversário da Lei Maria da Penha, que em 2023 completa 17 anos.', '<p>A atividade acontece na ter&ccedil;a-feira, 22 de agosto, a partir das 19h30min, na Sala B 01, e &eacute; fruto de parceria entre o N&uacute;cleo de Estudos e Pesquisas em G&ecirc;nero e Sexualidade (Nepgs), a Coordenadoria de Assist&ecirc;ncia Estudantil (CAE) e a Secretaria da Mulher de Canoas.</p>', '2023-08-20', 75, '../uploads/64e26de86bb78.png', 1),
(88, 'nmdnldd', 'ndmsd', '<p>wopeiwpoewl</p>', '2023-08-22', 1, '../uploads/64e3e1c3a4503.png', 0),
(91, 'teste', 'teste', '<p>teste</p>', '2023-08-28', 1, '../uploads/64ecfd9296ae9.png', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(70) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `pedido` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `estado`, `id_curso`, `pedido`) VALUES
(1, 'Estevan Estran Pinheiro', '02150142@aluno.canoas.ifrs.edu.br', '$2y$10$JVRzH4rCVYPASNvTLPjqj.lGkH553/r6wqGQRNMwtvNkwKfbxu7yK', 'administrador', 16, 0),
(75, 'estevan', 'teste3@aluno.canoas.ifrs.edu.br', '$2y$10$uFI2ky/ziQooK6fJo3CyCez4JFgCyXyGLhQM8/hQFVcIN5BUGM7Xu', 'promovido', 16, 0),
(79, 'novo teste', 'novoteste@canoas.ifrs.edu.br', '$2y$10$Qbtc1k43dKCwUEQGvjCWMOODmGOVwxj5UqQe27xD/2h/GI8lFptIG', 'comum', 2, 1),
(81, 'Euuuu', 'estevan@canoas.ifrs.edu.br', '$2y$10$92.5JbOIpm6zqyWwPG0qD.fWZzU2/eT.wZvWQbhXXUOJf/rnbfzKe', 'comum', 1, 0),
(87, 'Estevan', 'estevanestran@gmail.com', '$2y$10$1qZIb4REOEO7xCR/pHcb1.iXWmDkU0D4ms3.1lqVCCzlUQ1NvZiSa', 'comum', 16, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categoria_noticia`
--
ALTER TABLE `categoria_noticia`
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `fk_id_noticia` (`id_noticia`);

--
-- Índices de tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `curso_noticia`
--
ALTER TABLE `curso_noticia`
  ADD KEY `id_noticia` (`id_noticia`),
  ADD KEY `curso_id` (`id_curso`);

--
-- Índices de tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`id_usuario`),
  ADD KEY `noticia_id` (`id_noticia`);

--
-- Índices de tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_curso` (`id_curso`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `categoria_noticia`
--
ALTER TABLE `categoria_noticia`
  ADD CONSTRAINT `fk_id_noticia` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `curso_noticia`
--
ALTER TABLE `curso_noticia`
  ADD CONSTRAINT `curso_id` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_noticia` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `noticia_id` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_id` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `id_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
