-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2023 at 09:12 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kktshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `namecate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `namecate`) VALUES
(10, 'Dirty Coins'),
(11, 'Hades'),
(12, 'Paradox');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230222081739', '2023-02-22 09:17:50', 538),
('DoctrineMigrations\\Version20230222101332', '2023-02-22 11:13:43', 98),
('DoctrineMigrations\\Version20230222101553', '2023-02-22 11:15:57', 39),
('DoctrineMigrations\\Version20230223041633', '2023-02-23 05:16:42', 477),
('DoctrineMigrations\\Version20230223041807', '2023-02-23 05:18:14', 115),
('DoctrineMigrations\\Version20230223094534', '2023-02-23 10:45:44', 68),
('DoctrineMigrations\\Version20230223185623', '2023-02-23 19:56:31', 636),
('DoctrineMigrations\\Version20230224031737', '2023-02-24 04:17:45', 927),
('DoctrineMigrations\\Version20230224033439', '2023-02-24 04:34:44', 163);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `userorder_id` int(11) NOT NULL,
  `total` double NOT NULL,
  `datecreate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `userorder_id`, `total`, `datecreate`) VALUES
(28, 10, 36, '2023-02-25'),
(29, 9, 17, '2023-02-25'),
(30, 9, 18, '2023-02-25'),
(31, 9, 64, '2023-02-25'),
(32, 9, 19, '2023-02-25'),
(33, 3, 37, '2023-02-25'),
(34, 9, 17, '2023-02-25'),
(35, 9, 35, '2023-02-25'),
(36, 9, 18, '2023-02-25'),
(37, 9, 35, '2023-02-25'),
(38, 9, 17, '2023-02-26'),
(44, 9, 18, '2023-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `orderid_id` int(11) NOT NULL,
  `quantity` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `product_id`, `orderid_id`, `quantity`) VALUES
(26, 1, 28, 2),
(27, 2, 29, 1),
(28, 1, 30, 1),
(29, 3, 31, 4),
(30, 6, 32, 1),
(31, 2, 33, 1),
(32, 4, 33, 1),
(33, 2, 34, 1),
(34, 2, 35, 1),
(35, 1, 35, 1),
(36, 1, 36, 1),
(37, 2, 37, 1),
(38, 1, 37, 1),
(39, 2, 38, 1),
(40, 1, 44, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `namep` varchar(255) NOT NULL,
  `pricep` double NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `namep`, `pricep`, `image`, `description`, `category_id`) VALUES
(1, 'DirtyCoins Logo T-shirt', 18, 'coins4-63f76d2b1a7ca.jpg', 'Material: Dense Cotton, comfortable fit, the image on the front of the shirt applies high technology.', 10),
(2, 'DirtyCoins x 16Typh The Rapper T-Shirt', 17, 'coins1-63f76e5288b6a.jpg', 'The front lapel is embroidered with a limited tag for the collab, the collar is embroidered with a tag with size information and product material, and the side of the shirt is embroidered with an additional tag.', 10),
(3, 'Spray Logo T-Shirt - Black', 16, 'coins3-63f76eb542680.jpg', 'The print on the front and back of the shirt applies manual silk screen printing technology and Trame printing.', 10),
(4, 'DirtyCoins Print Cardigan', 20, 'coins2-63f76f232d165.jpg', 'Material: cotton felt. 2 body pockets. DirtyCoins logo texture applies silkscreen printing technique. Left chest embroidered with DirtyCoins logo. Ribbed hem, hem and cuffs. New Ivory/Green color scheme', 10),
(5, 'GLOSSY TEE', 17, 'hades3-63f76f8fece82.jpg', 'Regular fit. Large print \"H\" logo on the front of the shirt combined with a blur effect. Embroidered logo on sleeve. Material: 2-way cotton', 11),
(6, 'GOOD VIBE POLO', 19, 'hades2-63f7740163df1.jpg', 'The pattern of the whole shirt is silk-screen printed. Use breathable cotton fabric. Shirt stand form.', 11),
(7, 'SAIGON VINTAGE TEE', 15, 'hades1-63f7771db3c3f.jpg', 'Saigon architecture is silkscreen printed. Neck shirt. Logo embroidered on sleeve.', 11),
(8, 'Hades Hoodie', 22, 'hades4-63f77b813959c.jpg', 'Embroidered logo on the hat, sleeves and body with the same color of the shirt. The print on the shirt applies silk-screen printing technology', 11),
(9, 'Paradox THE REVERIE TEE', 18, 'paradox1-63f7795565106.jpg', 'Artwork THE TOKEN MONOGRAM TEE (Black) is a black t-shirt with a unique and impressive token design, based on 100% cotton t-shirt material, both giving you a feeling of comfort and expressing your personality. separate count.', 12),
(10, 'Paradox loose sleeved T-shirt', 16, 'paradox2-63f779ba09cec.jpg', 'PARADOX NATURE LOGO TEE (Baby Blue) wide-form T-shirt is a high-quality and high-quality basic t-shirt, with embossed motifs of the logo and brand name on the front chest and back.', 12),
(11, 'Paradox THE REVERIE TEE (Black) T-shirt', 18, 'paradox3-63f77a7043052.jpg', 'Artwork THE REVERIE TEE (Black) is a black t-shirt with an art sculpture image based on Basic T-shirt material.', 12),
(12, 'PARADOX ONE PIECE OVER-PRINTED JACKET', 19, 'paradox4-63f77b4694cbe.jpg', 'Proudly made in Vietnam by Paradox itself – is a Local Brand that has been present in the market for many years. 2 layers of micro-parachute fabric (umbrella)', 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `phone`, `address`) VALUES
(3, 'admin@123.com', '[\"ROLE_ADMIN\"]', '$2y$13$jqRGjdgE1X6iNazoZBjaeuzSqTiLi7smuxyIRxE3iyGr4yyXk9TIa', 'admin', '0901020304', 'Tra Vinh'),
(9, 'kiet@123.com', '[\"ROLE_USER\"]', '$2y$13$Dk1VxTBr2Q/.VaRHxDdyJ.Zk5TiLMTiNfHMnkWT2Hd25jkIHGmd4a', 'voquockiet', '0946280290', 'Can Tho'),
(10, 'siuuu@123.com', '[\"ROLE_USER\"]', '$2y$13$7CuFQCMnioQF8o2zL0w7jeg1RhxOI.lNuuzfgB7eQjU2.S0AKLBNi', 'siuuu', '113', 'VN'),
(19, 'kiet@11.com', '[\"ROLE_USER\"]', '$2y$13$RF9LOAScsGb5svy8njZhHON8X2/m.mxf9k29GXPAxHsb4VxP9GjjO', 'voquockiet', '0946280290', 'Can Tho');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BA388B7A76ED395` (`user_id`),
  ADD KEY `IDX_BA388B74584665A` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F5299398A1DA924F` (`userorder_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ED896F464584665A` (`product_id`),
  ADD KEY `IDX_ED896F466F90D45B` (`orderid_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B74584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_BA388B7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398A1DA924F` FOREIGN KEY (`userorder_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `FK_ED896F464584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_ED896F466F90D45B` FOREIGN KEY (`orderid_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
