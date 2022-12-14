-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2022 at 05:37 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buku`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(3, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(7, 'kjakjda', 'lolo@gmail.com', 'd6581d542c7eaf801284f084478b5fcc'),
(8, 'adman', 'adman@gmail.com', '77af70d33dc01eae2f3b0101bc396fd6'),
(9, 'nono', 'nono@gmail.com', 'c625ade02c3acde8e4d9de57fca78203'),
(10, 'nini', 'nini@gmail.com', 'db5cee64d8879581f189d71178dcb055'),
(11, 'nana', 'nana@gmail.com', '518d5f3401534f5c6c21977f12f60989');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `name`, `email`, `password`) VALUES
(1, 'aluu', 'aluu@gmail.com', '84fe07930990903f695e82bfc618cd3d'),
(4, 'yaya', 'yaya@gmail.com', '4409eae53c2e26a65cfc24b3a2359eb9'),
(6, 'icang', 'icang@gmail.com', '2e4640b95d249830692579dc409a577e'),
(12, 'hiha', 'hiha@gmail.com', '12a111aa14800f8626b50574fdd7f337'),
(18, 'nana', 'nana@gmail.com', '518d5f3401534f5c6c21977f12f60989'),
(19, 'jajajaja', 'jajajaja@gmail.com', '274883dcadb83028c76c3ccfadc7d9f4'),
(20, 'kakakak', 'kakakak@gmail.com', '237922b3d03c24e2f178e522180c167c'),
(21, 'kakdja', 'kjasdkjad@gmail.com', '978f9c8fa30137baf3b46e82f1e91e08'),
(22, 'jkjkj', 'kjkjkj@gmail.com', 'cb42e130d1471239a27fca6228094f0e'),
(23, 'pppp', 'pppp@gmail.com', '2d7acadf10224ffdabeab505970a8934'),
(24, 'mimo', 'mimo@gmail.com', 'f14cb5cf13c016653d8b6ab54def62bb'),
(25, 'mumu', 'mumu@gmail.com', '23c1622d0f5af8a8a8cd90dd1898f3cb'),
(26, 'mymy', 'mymy@gmail.com', '62695e8f3251b773f5337ce5245cc008'),
(27, 'kajja', 'kajja@gmail.com', '66ea63113585186a1bbfb13e81325507'),
(28, 'koko', 'koko@gmail.com', '37f525e2b6fc3cb4abd882f708ab80eb'),
(29, 'ioio', 'ioio@gmail.com', '17324235011af66d659cbb7a2d2cbe6e');

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `id` int(7) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `pesan` varchar(500) NOT NULL,
  `kepada` varchar(100) NOT NULL,
  `tanggal` datetime(2) NOT NULL,
  `keperluan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`id`, `nama`, `alamat`, `notelp`, `pesan`, `kepada`, `tanggal`, `keperluan`) VALUES
(130, 'hehi', 'aku dimana', '88239', 'isi isi isis', 'Bagian3-Bapak Siapa', '2022-08-25 21:12:00.00', 'kuda kuda'),
(150, 'nasdj', 'njansj', '923840', 'ini juga', 'Bagian3-Bapak Siapa', '2022-09-13 13:20:00.00', 'mau makan'),
(152, 'yoyo', 'akuaku', '921839', 'apa ya', 'Bagian3-Pada Siapa', '2022-09-13 20:29:00.00', 'aku mau apa ya'),
(165, 'jalu', 'diciamis', '85223812398', 'aku mau makan', 'SISKOHAT-Bapak Siapa', '2022-09-14 13:00:00.00', 'makan kuy'),
(174, 'dimas', 'di sana aja', '2871928', 'aku tidak tau mau  apa', 'Bagian1-Ibu Siapa', '2022-09-15 11:59:00.00', 'mendaki gunung'),
(187, 'jajaja', 'kemana', '081321088973', 'nanimo', 'Bagian1-Bapak Siapa', '2022-09-20 11:31:00.00', 'ntah lah'),
(188, 'kurniawan ', 'disana dan sininisii ', '082112690903', 'kemaana smekansea', 'Bagian1-Ibu Siapa', '2022-10-03 14:42:00.00', 'kiktaikajsenjnasj'),
(189, 'kurniawan ', 'dkaiansdk', '082112690903', 'kjaskdjks', 'Bagian1-Ibu Siapa', '2022-10-04 09:53:00.00', 'akjskdajdkjk'),
(190, 'kurniawan ', 'dkaiansdk', '082112690903', 'kjaskdjks', 'Bagian1-Ibu Siapa', '2022-10-04 09:53:00.00', 'akjskdajdkjk'),
(191, 'jalu', 'disakaka', '082112690903', 'tidak adadadada', 'Bagian1-Bapak Siapa', '2022-10-04 10:40:00.00', 'kakakakakaka'),
(192, 'kokoo', 'kikajks', '082112690903', 'kajsa', 'hjhjh-cgfdgf&gfhgfhg@gmail.com', '2022-10-06 14:39:00.00', 'kikikiki'),
(193, 'wdada', 'sda', '55464', 'sdfsf', 'siapa@gmail.com', '2022-10-10 21:57:00.00', 'svdssd'),
(195, 'Dolorem sapiente dol', 'Dignissimos fugit i', '93', 'Aliquid culpa reici', 'siapa', '2018-03-08 23:34:00.00', 'Voluptate ullam ea n'),
(196, 'wdada', 'sda', '55464', 'sdfsf', 'siapa@gmail.com', '2022-10-10 21:57:00.00', 'svdssd'),
(197, 'wdada', 'sda', '0921310', 'sdfsf', 'Bapak Siapa', '2022-10-10 21:57:00.00', 'svdssd'),
(199, 'dari ini', 'alaksaks', '0821371', 'asjhdas', 'Bapak Siapa', '2022-10-10 22:39:00.00', 'kadsjlasjdl'),
(200, 'jksajd', 'kjaskdjas', '90912310', 'jkjd', 'Bapak Siapa', '2022-10-13 13:49:00.00', 'ljlsadsad'),
(201, 'admin', 'Disini', '0923423', 'tidak ada', 'Bapak Siapa', '2022-10-13 14:06:00.00', 'haha'),
(202, 'admin', 'disini', '2342', 'tidak ada', 'Bapak Siapa', '2022-10-13 14:14:00.00', 'jjj'),
(203, 'admin', 'diciamis', '0129312', 'aku mau makan', 'Bapak Siapa', '2022-10-13 14:17:00.00', 'makan kuy'),
(204, 'yaya', 'dimana', '3453452423', 'jgjhg', 'Bapak Siapa', '2022-10-13 14:18:00.00', 'Untuk Diskusi'),
(205, 'yayaya', 'yysysya', '029383293', 'yayayayay', 'SISKOHAT-Bapak Siapa', '2022-10-14 15:03:00.00', 'yyayayaya'),
(206, 'admin', 'Disini', '584', 'aku mau makan', 'SISKOHAT-Bapak Siapa', '2022-10-14 16:46:00.00', 'Untuk Diskusi'),
(207, 'admin', 'Disini', '584', 'aku mau makan', 'SISKOHAT-Bapak Siapa', '2022-10-14 16:46:00.00', 'Untuk Diskusi'),
(208, 'jaja', 'jjaja', '1230', 'jajajj', 'Bagian1-Bapak Siapa', '2022-10-20 15:14:00.00', 'jaja'),
(209, 'Laborum Pariatur E', 'Qui magnam cupiditat', '45', 'Consequatur ipsum cu', 'Bagian3-Pada Siapa', '1981-11-26 05:58:00.00', 'Sed proident dolore'),
(210, 'Suscipit voluptatibu', 'Amet voluptatibus a', '57', 'Dicta sint voluptat', 'mnamna-Jojo&suprijota@gmail.com', '2019-08-27 12:05:00.00', 'Id id dolor dignissi'),
(211, 'jakjas', 'kasjd', '9824902', 'jksfal', 'Bagian1-Ibu Siapa', '2022-10-20 19:54:00.00', 'jhkahdsk'),
(213, 'kasndkjas', 'nsjkncakjsdn', '09301231', 'mamdasklm', 'Bagian1-Pada Siapa', '2022-10-20 20:12:00.00', 'saldkasldka'),
(215, 'asdakj', 'kjasdak', '8029103', 'askdask', 'SISKOHAT-Bapak Siapa', '2022-10-24 11:21:00.00', 'kjaskdjak'),
(216, 'kikiki', 'ikiaskkiaskias', '082112690903', 'disini', 'Bagian2-Ibu Siapa', '2022-10-28 10:10:00.00', 'ininin'),
(217, 'koko', 'disini', '0921309123', 'kokokokokoko', 'SISKOHAT-Bapak Siapa', '2022-10-31 21:41:00.00', 'kokokokokoko'),
(218, 'klkl', 'klklkl', '0985234567', 'qwerty', 'SISKOHAT-Bapak Siapa', '2022-10-31 22:10:00.00', 'QWERTY'),
(219, 'klkl', 'klklkl', '0985234567', 'qwerty', 'SISKOHAT-Bapak Siapa', '2022-10-31 22:10:00.00', 'QWERTY'),
(220, 'klkl', 'klklkl', '0985234567', 'qwerty', 'SISKOHAT-Bapak Siapa', '2022-10-31 22:10:00.00', 'QWERTY');

-- --------------------------------------------------------

--
-- Table structure for table `tujuan`
--

CREATE TABLE `tujuan` (
  `id` int(8) NOT NULL,
  `bagiann` varchar(100) NOT NULL,
  `namaa` varchar(100) NOT NULL,
  `emailtujuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tujuan`
--

INSERT INTO `tujuan` (`id`, `bagiann`, `namaa`, `emailtujuan`) VALUES
(16, '1.Bagian ini', 'Jalu Giri ', 'abangjalugiri@gmail.com'),
(18, '2.Bagian itu', 'Hooh', 'jalugiri0@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tujuan`
--
ALTER TABLE `tujuan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `tujuan`
--
ALTER TABLE `tujuan`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
