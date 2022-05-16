-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 16-Maio-2022 às 10:31
-- Versão do servidor: 5.7.37-0ubuntu0.18.04.1
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sha_files`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `id_share` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `files`
--

INSERT INTO `files` (`id`, `id_share`, `file_name`, `size`) VALUES
(17, 15, '4bee75e1ee4d67140096ef07e2af0531.png', 241392),
(18, 15, 'fundo.jpg', 220688);

-- --------------------------------------------------------

--
-- Estrutura da tabela `share`
--

CREATE TABLE `share` (
  `id` int(11) NOT NULL,
  `code` varchar(42) NOT NULL,
  `url` varchar(150) NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `share`
--

INSERT INTO `share` (`id`, `code`, `url`, `expires`) VALUES
(15, '83006e97486386ae64763cf220633053', 'ccf91dba4d3b44017c833711361f7717', '2022-05-15 21:37:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `share`
--
ALTER TABLE `share`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `share`
--
ALTER TABLE `share`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
