-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/11/2023 às 00:15
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tiktok`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `lifevideo`
--

CREATE TABLE `lifevideo` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `video` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lifevideo`
--

INSERT INTO `lifevideo` (`id`, `usuario`, `views`, `titulo`, `descricao`, `video`, `data`) VALUES
(3, 1, 20, 'Matteo Terrivel', 'Muito fofo', '650a3977e55b6_cfad3d0732a7227b7df698182b7a71dd.mp4', '2023-10-02 03:26:51'),
(4, 27, 23, 'Danço muito KKK', 'vem que vem kkk', '650a39e66ce49_9eb3afe001b5f5c4e4067dc5bfd18739.mp4', '2023-11-08 01:48:40'),
(5, 1, 28, 'Quando não tem nada pra fazer ', 'Adoro', '650a3b35b703c_e612fef303b74e62a263db4c9260f535.mp4', '2023-11-08 01:51:40'),
(6, 27, 21, 'Volta será', 'Xuxu', '650a46ba140a2_49386490435cc8b2b506c9a87391eeed.mp4', '2023-11-13 19:10:32'),
(7, 1, 18, 'Mais brabo sou eu', 'Kkkkkk nem falo nada', '650a6b035b6f8_295f1a430027c95c1681ab1bda103ba2.mp4', '2023-10-20 06:40:44'),
(8, 20, 17, 'Toda Toda', 'Domingo de manha', '6511da07ae712_d471aee71b1a7cb8fcda0705ef26e453.mp4', '2023-10-20 06:40:47'),
(9, 21, 14, 'love me', 'love me', '6511dadf148dc_df3b9d2db1a1a57a7aa376811d2d7fb1.mp4', '2023-11-08 01:51:07'),
(10, 21, 15, 'Anna Heolisa', 'Anna Heolisa', '6511dafe22be7_e8467174299b2206b61cdb2eef45e0ae.mp4', '2023-11-08 01:51:08'),
(11, 21, 12, 'Anna Heolisa', 'Anna Heolisa', '6511db0c2c5f3_9d398e7b30f1872c9abd5c5f3fe2dc77.mp4', '2023-11-08 01:51:29'),
(12, 21, 14, 'Anna Heolisa', 'Anna Heolisa', '6511db14ba5c1_3b582c4a25290cf664f4676e34f6ce3b.mp4', '2023-11-13 19:10:30'),
(13, 21, 13, 'Anna Heolisa', 'Anna Heolisa', '6511db4756dcf_a44223a9475bc9545ede04d2f3739680.mp4', '2023-11-08 01:51:14'),
(14, 21, 10, 'Anna Heolisa', 'Anna Heolisa', '6511db4f1e205_1615aa69d710a3a0d13843a3d944a603.mp4', '2023-11-08 01:51:18'),
(15, 21, 17, 'Anna Heolisa', 'Anna Heolisa', '6511db5a14f4f_fed3a4b2a54c97f0d4d15dc13b8b2ad7.mp4', '2023-10-21 07:12:12'),
(16, 21, 12, 'Anna Heolisa', 'Anna Heolisa', '6511db5fa3f43_8dfbe16561cbb9ee544135adfaf20e7d.mp4', '2023-11-13 19:10:27'),
(17, 21, 12, '#viral #linda', '#viral #linda', '6519eb1e2c428_f2e97e1eada20b344f8092cbee14ce9a.mp4', '2023-11-08 01:48:56'),
(18, 21, 8, 'Arguilha', 'Arguilha', '6519eb359774f_afbbb6edcaad710d01a263fe45948b35.mp4', '2023-11-08 01:51:02'),
(19, 21, 7, 'Scret.me', 'Scret.me', '6519eb62704e0_4e54bcad031d405aaa505e14d54f1099.mp4', '2023-11-08 01:48:46'),
(20, 28, 2, 'Garota vem Nk', 'Garota vem Nk', '651a354465603_a9fdfd49548f7980a6c2bb2f6d8181c5.mp4', '2023-11-08 01:51:10'),
(21, 28, 4, 'Garota vem Nk', 'Garota vem Nk', '651a354bb333c_96f89140717e575bb9f9c11c0226e2a7.mp4', '2023-10-21 07:12:25'),
(22, 28, 5, 'Garota vem Nk', 'Garota vem Nk', '651a355408360_dff332ea0d8d7c92dae5e3641bd480fb.mp4', '2023-11-08 01:51:12'),
(23, 28, 3, '#viral #linda', 'amo', '651a3864aee6a_305dfbb69fc25a8ecb1bb25a78e78c26.mp4', '2023-11-08 01:51:16'),
(24, 28, 5, 'Toda Toda', 'Bom', '651a3d24e2e91_bd3effcebf67001d2e3e29d5c5f5ea45.mp4', '2023-11-08 01:48:58'),
(25, 28, 5, 'Saaaaai do meu perfil desgraçada', 'Sem descrição.', '651a3d454cdd1_40eaac51adacd1708b9386a7652c8e85.mp4', '2023-11-13 19:10:33'),
(26, 28, 6, 'pijama', 'curte', '651a3d5642b9f_ffa64700e17d6166171e719c160ca431.mp4', '2023-11-13 19:10:27'),
(27, 28, 2, 'Efeito Balada', 'Vem baladinha', '651a3d690ef7d_5e2ede8e3d51628314fdef2c0068ba02.mp4', '2023-11-08 01:51:25'),
(28, 28, 3, 'HD #viral #lima', 'HD #viral #lima', '651a3d7d8fa6a_88e6b4a8bfb6626ccc5e7e06dcb47a16.mp4', '2023-11-08 01:49:50'),
(29, 28, 4, 'Vermelho', 'Vermelho combina em mim ...', '651a3d92ef5fa_2379e111de6afcabd7721ed5bf7a5669.mp4', '2023-11-08 01:46:20'),
(30, 28, 2, 'Nois', 'Nois', '651a3daa000df_e440c28e938822964d3a828fe8565ad9.mp4', '2023-11-08 01:44:39'),
(31, 28, 1, 'popoxuda', 'popoxuda', '651a3dc31e895_99e898094d5626b419bbdfbf57d7a2f1.mp4', '2023-10-20 06:40:39'),
(32, 28, 2, 'Magrinha mas me garanto', 'Magrinha mas me garanto', '651a3dd22cb27_44452b715ded2f8e8c62e6390fd033d3.mp4', '2023-10-20 06:39:38'),
(33, 28, 2, '#viral #linda', '#viral #linda', '651a3ddded183_80375d08c2aa61ab2439d063f2732cb2.mp4', '2023-11-08 01:48:27'),
(34, 28, 4, 'bum bum bum', 'bum bum bum', '651a3df139e45_9f4f4d03159b758c65463b08eff7ec48.mp4', '2023-10-21 07:12:39'),
(35, 28, 3, 'Garota vem Nk', 'Garota vem Nk', '651a3e034aa62_edb9628c996415a0a88e047e55af26a4.mp4', '2023-11-08 01:51:22'),
(36, 28, 2, 'Vermelho', 'Vermelho combina em mim ...', '651a3e0e2d8a9_1b26c09f48be35cd49ba45eb4189a576.mp4', '2023-11-08 01:48:07'),
(37, 28, 1, '😇 Ficou ruim mas pra mim ficou bom.', '😇 Ficou ruim mas pra mim ficou bom.', '651a3e4c054cb_f1d2d2411fad6a5ca1745f44a8d37225.mp4', '2023-10-07 08:07:40'),
(38, 28, 2, '#viral #linda', '#viral #linda', '651a3e577af53_ffad851441c880395c3d06508a401be9.mp4', '2023-11-08 01:51:04'),
(39, 28, 5, 'Garota vem Nk', 'Vermelho combina em mim ...', '651a3e617d919_a9be16ae6875d1a793470bd19cfcade8.mp4', '2023-11-13 19:10:31'),
(40, 1, 0, 'Eu no trabalho ', 'Só jesus', '654ae97aee8b2_9298e82a2d00a945e019a62e0120fb99.mp4', '2023-11-08 01:50:50');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lifevideo_seguidores`
--

CREATE TABLE `lifevideo_seguidores` (
  `id` int(11) NOT NULL,
  `seguidor` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lifevideo_seguidores`
--

INSERT INTO `lifevideo_seguidores` (`id`, `seguidor`, `usuario`) VALUES
(4, 1, 1),
(5, 27, 1),
(6, 27, 27),
(8, 1, 21),
(9, 1, 27),
(10, 27, 21),
(11, 21, 27),
(12, 21, 1),
(13, 21, 20),
(19, 1, 20),
(20, 1, 28);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `imagem` varchar(128) DEFAULT NULL,
  `nome` varchar(64) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `imagem`, `nome`, `sexo`, `email`, `senha`, `cadastro`) VALUES
(1, '665d265263bfacb6f5bc7e3d1ee40e75.jpg', 'Luiz Bruno', 'masculino', 'luizbruno@luizbruno.com', '731c5f6cf91fd394933985702947a3728b76ede5', '2022-07-25 13:24:34'),
(19, '3af96ac6b7accf29c5237c135347be8d.jpg', 'Brenda Souza', 'feminino', 'brendasouza@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2023-01-29 19:11:08'),
(20, '20_profile.png', 'Kemily', 'feminino', 'kemilli@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2023-01-29 19:12:31'),
(21, 'c69c5f922bd777bc44d9bf591198933c.jpg', 'Anna Heloisa', '', 'heloisa@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2023-01-29 19:14:18'),
(22, 'cec54cf88b37550a7a514913db181e40.jpg', 'Luxlo', 'feminino', 'Luxlo@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2023-01-29 19:15:18'),
(23, '48d29277a8d16f56c9cfd994109c1e50.jpg', 'Camila', 'feminino', 'camila@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2023-01-29 19:36:31'),
(24, '1bf2d706156dab19590bca51174035d1.jpg', 'Fabricia', 'feminino', 'fabricia@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2023-01-29 20:10:28'),
(25, '74d03c08d7c60970125f96b6f637fdd8.jpg', 'Marcela', 'feminino', 'marcela@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2023-02-15 19:30:49'),
(27, '6fb86df054c12a65d9e7444cc59c2d2d.jpg', 'Mirella Santos', 'feminino', 'mirellasantos1um4@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2023-07-21 23:52:36'),
(28, '31a7b99c09cdb150eae52645f4ab9052.jpg', 'Nah Lk Martins', 'feminino', 'namartins@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2023-10-02 00:10:11'),
(29, '8b97bc6b4c5fa58abdd8e913afa1c654.jpg', 'Sakura Uchira', 'feminino', 'sakurauchira@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2023-10-24 03:05:22');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `lifevideo`
--
ALTER TABLE `lifevideo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `lifevideo_seguidores`
--
ALTER TABLE `lifevideo_seguidores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lifevideo`
--
ALTER TABLE `lifevideo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `lifevideo_seguidores`
--
ALTER TABLE `lifevideo_seguidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
