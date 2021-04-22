-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 22, 2021 at 06:18 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`) VALUES
(1, 'Suitable for furniture'),
(2, 'Straight-grained.'),
(3, 'Kiln dried'),
(4, 'Easy to work'),
(5, 'Versatile'),
(6, 'Smooth surface'),
(7, 'Budget-friendly'),
(8, 'Heat-tolerant'),
(9, 'Buoyant'),
(10, 'Suitable for staining'),
(11, 'Strong');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Hardwood'),
(2, 'Softwood');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `address` varchar(256) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `address`, `phone`, `user_id`, `image_id`) VALUES
(7, '1234 Test Street, Co. Limerick', '0851114321', 17, 13),
(8, '23 test street', '085-1111111', 18, 21),
(9, '23 test street', '085-121345', 19, 25),
(11, '23 test user on new form', '085-141223', 21, 27),
(12, 'Drogheda\r\nCo. Louth', '01-1234567', 22, 28),
(14, '23 michael mouse boulevard', '01-842934', 27, 29),
(15, '40 clare boulevard, mayo', '085-0782932', 28, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `filename` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`) VALUES
(13, 'UPLOAD_DIR/1613606686602daf1e7e143.jpg'),
(14, 'UPLOAD_DIR/1613614811602dcedb55295.jpg'),
(15, 'UPLOAD_DIR/1613616066602dd3c2e6fc5.jpeg'),
(16, 'UPLOAD_DIR/1613616095602dd3dfd8c3c.jpeg'),
(17, 'UPLOAD_DIR/1613616114602dd3f2d140c.jpeg'),
(18, 'UPLOAD_DIR/1613616131602dd4037a1ad.png'),
(19, 'UPLOAD_DIR/1613616163602dd423c6235.png'),
(20, 'UPLOAD_DIR/1613616182602dd43668d65.jpeg'),
(21, 'UPLOAD_DIR/1613650084602e58a425914.jpg'),
(22, 'UPLOAD_DIR/1613654889602e6b6968433.jpg'),
(23, 'UPLOAD_DIR/1613655342602e6d2ed0744.jpg'),
(24, 'UPLOAD_DIR/1613655370602e6d4a47ac0.jpg'),
(25, 'UPLOAD_DIR/1613699815602f1ae7543a3.jpg'),
(26, 'UPLOAD_DIR/1614786229603faeb5c395f.jpg'),
(27, 'UPLOAD_DIR/1614786657603fb061eaca1.jpg'),
(28, 'UPLOAD_DIR/161841897760771d212dd11.jpg'),
(29, 'UPLOAD_DIR/1618437476607765644b418.jpg'),
(30, 'UPLOAD_DIR/1618941385607f15c9bcb0e.jpg'),
(31, 'UPLOAD_DIR/1618954700607f49cc1505a.jpg'),
(32, 'UPLOAD_DIR/1618954736607f49f06061a.jpg'),
(33, 'UPLOAD_DIR/1618954748607f49fc82e7e.jpg'),
(34, 'UPLOAD_DIR/1618957678607f556e9db74.png'),
(35, 'UPLOAD_DIR/1618958026607f56cadcfd7.jpg'),
(36, 'UPLOAD_DIR/1618958150607f5746c421b.jpg'),
(37, 'UPLOAD_DIR/1618962824607f6988dbe72.jpg'),
(38, 'UPLOAD_DIR/16190157616080385153f61.jpg'),
(39, 'UPLOAD_DIR/161901577860803862a748d.jpg'),
(40, 'UPLOAD_DIR/161901719360803de9537d4.jpg'),
(41, 'UPLOAD_DIR/161901722660803e0a62b34.jpg'),
(42, 'UPLOAD_DIR/161902107860804d163b966.jpg'),
(43, 'UPLOAD_DIR/1619021975608050977ffa1.jpg'),
(44, 'UPLOAD_DIR/161902247160805287993bf.jpg'),
(45, 'UPLOAD_DIR/16190226066080530ebc10a.jpg'),
(46, 'UPLOAD_DIR/16190226826080535a507f3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `related_images`
--

CREATE TABLE `related_images` (
  `id` int(11) NOT NULL,
  `filename` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `related_images`
--

INSERT INTO `related_images` (`id`, `filename`) VALUES
(1, 'UPLOAD_DIR/1618957687607f55775fc9b.jpg'),
(2, 'UPLOAD_DIR/1618957695607f557f9578a.jpg'),
(3, 'UPLOAD_DIR/1618957701607f558549d83.jpg'),
(4, 'UPLOAD_DIR/1618958038607f56d6caa21.jpg'),
(5, 'UPLOAD_DIR/1618958044607f56dcd8233.jpg'),
(6, 'UPLOAD_DIR/1618958050607f56e2c6754.jpg'),
(7, 'UPLOAD_DIR/1618958150607f5746ca1e1.jpg'),
(8, 'UPLOAD_DIR/1618958150607f5746ce1ff.jpg'),
(9, 'UPLOAD_DIR/1618958150607f5746cfe5f.jpg'),
(10, 'UPLOAD_DIR/1618962824607f6988df294.jpg'),
(11, 'UPLOAD_DIR/1618962824607f6988e3ad6.jpg'),
(12, 'UPLOAD_DIR/1618962824607f6988e7802.jpg'),
(13, 'UPLOAD_DIR/1618963966607f6dfeab7ce.jpg'),
(14, 'UPLOAD_DIR/1618963966607f6dfeb1bb2.jpg'),
(15, 'UPLOAD_DIR/1618963966607f6dfeb56a9.jpg'),
(16, 'UPLOAD_DIR/1618964053607f6e55a7c97.jpg'),
(17, 'UPLOAD_DIR/1618964059607f6e5b7a705.jpg'),
(18, 'UPLOAD_DIR/1618964064607f6e603a306.jpg'),
(19, 'UPLOAD_DIR/1618964232607f6f0822bd7.jpg'),
(20, 'UPLOAD_DIR/1618964236607f6f0caef98.jpg'),
(21, 'UPLOAD_DIR/1618964241607f6f1194184.jpg'),
(22, 'UPLOAD_DIR/1618964337607f6f71f2f4e.jpg'),
(23, 'UPLOAD_DIR/1618964338607f6f7201a75.jpg'),
(24, 'UPLOAD_DIR/1618964338607f6f7202d9e.jpg'),
(25, 'UPLOAD_DIR/1618964369607f6f91efbad.jpg'),
(26, 'UPLOAD_DIR/1618964369607f6f91f196e.jpg'),
(27, 'UPLOAD_DIR/1618964369607f6f91f2f16.jpg'),
(28, 'UPLOAD_DIR/1618964379607f6f9bd3859.jpg'),
(29, 'UPLOAD_DIR/1618964379607f6f9bd6920.jpg'),
(30, 'UPLOAD_DIR/1618964379607f6f9bd8303.jpg'),
(31, 'UPLOAD_DIR/1618964439607f6fd7ae5af.jpg'),
(32, 'UPLOAD_DIR/1618964439607f6fd7b5dbe.jpg'),
(33, 'UPLOAD_DIR/1618964439607f6fd7b7b72.jpg'),
(34, 'UPLOAD_DIR/1618964802607f71421287b.jpg'),
(35, 'UPLOAD_DIR/1618964802607f71421b865.jpg'),
(36, 'UPLOAD_DIR/1618964802607f71421cd55.jpg'),
(37, 'UPLOAD_DIR/1618966054607f7626e61ce.jpg'),
(38, 'UPLOAD_DIR/1618966054607f7626ee086.jpg'),
(39, 'UPLOAD_DIR/1618966054607f7626f39e6.jpg'),
(40, 'UPLOAD_DIR/1618966255607f76ef2608f.jpg'),
(41, 'UPLOAD_DIR/1618966255607f76ef27f54.jpg'),
(42, 'UPLOAD_DIR/1618966255607f76ef294e9.jpg'),
(43, 'UPLOAD_DIR/161901577860803862a921f.jpg'),
(44, 'UPLOAD_DIR/161901577860803862ab2e2.jpg'),
(45, 'UPLOAD_DIR/161901577860803862acb1e.jpg'),
(46, 'UPLOAD_DIR/16190224796080528f7095a.jpg'),
(47, 'UPLOAD_DIR/161902248560805295b37c5.jpg'),
(48, 'UPLOAD_DIR/16190224906080529a6b01c.jpg'),
(49, 'UPLOAD_DIR/16190226066080530ec4d67.jpg'),
(50, 'UPLOAD_DIR/16190226066080530ecaa7d.jpg'),
(51, 'UPLOAD_DIR/16190226066080530ecc0c4.jpg'),
(52, 'UPLOAD_DIR/16190226826080535a5394c.jpg'),
(53, 'UPLOAD_DIR/16190226826080535a57abc.jpg'),
(54, 'UPLOAD_DIR/16190226826080535a5b633.jpg'),
(55, 'UPLOAD_DIR/1619034795608082ab46086.jpg'),
(56, 'UPLOAD_DIR/1619035090608083d2ccb5a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`) VALUES
(1, 'admin'),
(4, 'customer'),
(3, 'employee'),
(2, 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `timbers`
--

CREATE TABLE `timbers` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `minimum_order` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timbers`
--

INSERT INTO `timbers` (`id`, `title`, `description`, `price`, `category_id`, `minimum_order`, `image_id`) VALUES
(1, 'Iroko', 'Iroko is quite commonly used as an inexpensive alternative to Teak (they are very similar in density, grain structure and colour after ageing), due to Teak’s scarce nature and strict export laws.', '22.00', 1, 22, 14),
(2, 'American Alder', 'Alder is a hardwood which is slowly gaining a rising popularity due to its natural beauty, workability and versatility. It is more frequently found in the Northwest regions of California and Southwestern parts of Canada. It is in the same family as the birch tree, so it often shares similar applications.', '40.00', 1, 22, 15),
(3, 'Ash', 'Ash wood can be somewhat difficult to find currently, especially due to the recent issues with the Emerald Ash borer, an invasive pest which caused many of these trees to prematurely die. If you live in the areas where Ash trees are native and grow abundantly, it will be easier to find this wood than if you live somewhere that does not.', '32.00', 2, 45, 16),
(4, 'Cherry', 'Cherry is a beautiful wood which comes from the American Black Cherry fruit tree. This wood often starts as a light pink color that darkens and changes to a reddish hue over time. Cherry wood can sometimes have black flecking, which occurs naturally from mineral deposits over time.', '88.00', 1, 22, 17),
(5, 'Red Oak', 'Perhaps one of the most loved hardwoods, oak is a very popular choice for woodworkers, especially in building furniture and high quality heirloom pieces that can last for generations.', '102.00', 1, 50, 18),
(6, 'Yellow Birch', 'Birch is a hardwood which is easy to find and often one of the more affordable hardwood species at local lumberyards and home centers.', '28.00', 2, 22, 19),
(7, 'Fir', 'Fir is another great economical and strong softwood to consider working with for beginning woodworking projects. Fir is usually a good choice for projects you plan on painting, since it can be sometimes difficult to stain and really does not have much of a wood grain.', '52.00', 2, 88, 20),
(8, 'California Redwood', 'California redwood trees are a softwood known best for their massive size and red color. It has a very interesting wood grain pattern, and much likes its Cedar cousins, Redwood is very suitable for outdoor applications due to its ability to be weather resistant.', '22.00', 1, 22, 31),
(9, 'Cedar', 'Many people are familiar with cedar not just for its interesting wood grain and color, but also for its aromatic smell which is believed to repel pests and moths. The aromatic scent and bug repelling properties is why it is sometimes a popular choice to use in closets and storage chests.', '22.00', 1, 22, 32),
(10, 'Ebony', 'Ebony wood is easy to identify, since this is one of the few woods that are truly black in color. It is a very dense hardwood and has many characteristics that make it desirable for a number of wood carving and specialized woodworking projects.', '11.00', 1, 11, 33),
(12, 'test softwood', 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', '22.00', 1, 22, 34),
(13, 'test hardwood', 'wwwwwwwwwwwwwwwwwwww', '22.00', 1, 222, 35),
(15, 'test hardwood', 'wwwwwwwwwwwwwww', '22.00', 1, 22, 37),
(16, 'Gluam', 'Glued laminated timber, popularly known as glulam, is a manufactured timber product. It is made by bonding together individual laminates (layers) of solid timber boards with durable, moisture-resistant structural adhesives. ', '30.00', 1, 80, 39),
(17, 'Chestnut', 'Sweet Chestnut is an English hardwood which used to be a cheap alternative to Oak. Good quality Chestnut is currently scarce and should not have ‘ring-shakes’ or yellow discolouration. Chestnut may be used for interior joinery when kiln-dried and is stocked as logsawn yielding widths of 100mm – 220mm and lengths 2m – 3.5metre.', '45.00', 1, 90, 44),
(18, 'test hardwood', 'wwwwwwwwwww', '22.00', 1, 22, 45);

-- --------------------------------------------------------

--
-- Table structure for table `timber_attribute`
--

CREATE TABLE `timber_attribute` (
  `id` int(11) NOT NULL,
  `timber_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timber_attribute`
--

INSERT INTO `timber_attribute` (`id`, `timber_id`, `attribute_id`) VALUES
(1, 2, 7),
(2, 2, 9),
(3, 3, 3),
(4, 3, 10),
(5, 8, 5),
(6, 8, 1),
(7, 9, 11),
(8, 9, 8),
(9, 4, 7),
(10, 4, 10),
(11, 10, 4),
(12, 10, 5),
(13, 7, 3),
(14, 7, 1),
(17, 5, 6),
(18, 5, 7),
(21, 1, 1),
(22, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `timber_related_image`
--

CREATE TABLE `timber_related_image` (
  `id` int(11) NOT NULL,
  `related_image_id` int(11) NOT NULL,
  `timber_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timber_related_image`
--

INSERT INTO `timber_related_image` (`id`, `related_image_id`, `timber_id`) VALUES
(4, 10, 15),
(5, 11, 15),
(6, 12, 15),
(7, 40, 1),
(8, 41, 1),
(9, 42, 1),
(10, 43, 16),
(11, 44, 16),
(12, 45, 16),
(13, 46, 17),
(14, 47, 17),
(15, 48, 17),
(16, 49, 18),
(17, 50, 18),
(18, 51, 18),
(22, 56, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_id`, `status`, `date`, `total`) VALUES
('ch_1IeSX6LBrNI420twMwV4IFBS', 7, 'succeeded', '2021-04-09 23:10:30', 576),
('ch_1IeVJ4LBrNI420twTBV8pG8n', 7, 'succeeded', '2021-04-10 02:08:12', 576),
('ch_1IgBxGLBrNI420tw4f8NCOmx', 12, 'succeeded', '2021-04-14 17:52:42', 3104),
('ch_1IgZ31LBrNI420twShV5m3IX', 7, 'succeeded', '2021-04-15 18:32:12', 624),
('ch_1IgZ4ZLBrNI420twhPMnWrae', 7, 'succeeded', '2021-04-15 18:33:48', 624),
('ch_1IgZ7OLBrNI420twPmheRHN7', 7, 'succeeded', '2021-04-15 18:36:42', 624),
('ch_1IgZ9NLBrNI420twzzBSKMpq', 7, 'succeeded', '2021-04-15 18:38:45', 624),
('ch_1IgZVILBrNI420twU2CQVbqj', 7, 'succeeded', '2021-04-15 19:01:24', 576),
('ch_1IiKZ5LBrNI420twzTZMgoIO', 7, 'succeeded', '2021-04-20 15:28:35', 1440),
('ch_1IV2IdLBrNI420twqKeuoT5a', 7, 'succeeded', '2021-03-14 23:20:41', 1192),
('ch_1IVgENLBrNI420twbg5bqExF', 7, 'succeeded', '2021-03-16 17:58:55', 576),
('ch_1IVgMNLBrNI420twNOnuSsUG', 7, 'succeeded', '2021-03-16 17:07:11', 7036),
('ch_1IVjtRLBrNI420twKeK3AUX2', 7, 'succeeded', '2021-03-16 20:53:33', 5152),
('ch_1IWAgzLBrNI420tweIc2NesZ', 7, 'succeeded', '2021-03-18 01:30:29', 576),
('ch_1IWAwiLBrNI420twZbQSo5Xr', 8, 'succeeded', '2021-04-21 00:00:00', 576);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_timber`
--

CREATE TABLE `transaction_timber` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `profiling` varchar(256) NOT NULL,
  `sqfootage` int(11) NOT NULL,
  `fire_rated` tinyint(1) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `timber_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_timber`
--

INSERT INTO `transaction_timber` (`id`, `quantity`, `profiling`, `sqfootage`, `fire_rated`, `transaction_id`, `timber_id`) VALUES
(6, 24, '', 0, 0, 'ch_1IV2IdLBrNI420twqKeuoT5a', 1),
(7, 22, '', 0, 0, 'ch_1IV2IdLBrNI420twqKeuoT5a', 6),
(8, 24, '', 0, 0, 'ch_1IVgENLBrNI420twbg5bqExF', 1),
(9, 50, '', 0, 0, 'ch_1IVgMNLBrNI420twNOnuSsUG', 5),
(10, 22, '', 0, 0, 'ch_1IVgMNLBrNI420twNOnuSsUG', 4),
(11, 24, '', 0, 0, 'ch_1IVjtRLBrNI420twKeK3AUX2', 1),
(12, 88, '', 0, 0, 'ch_1IVjtRLBrNI420twKeK3AUX2', 7),
(13, 24, '', 0, 0, 'ch_1IWAgzLBrNI420tweIc2NesZ', 1),
(14, 24, '', 0, 0, 'ch_1IWAwiLBrNI420twZbQSo5Xr', 1),
(18, 24, '', 0, 0, 'ch_1IeSX6LBrNI420twMwV4IFBS', 1),
(19, 24, '', 0, 0, 'ch_1IeVJ4LBrNI420twTBV8pG8n', 1),
(20, 25, '', 0, 0, 'ch_1IgBxGLBrNI420tw4f8NCOmx', 2),
(21, 47, '', 0, 0, 'ch_1IgBxGLBrNI420tw4f8NCOmx', 3),
(22, 25, '', 0, 0, 'ch_1IgBxGLBrNI420tw4f8NCOmx', 1),
(23, 26, '', 0, 0, 'ch_1IgZ31LBrNI420twShV5m3IX', 1),
(24, 26, '', 0, 0, 'ch_1IgZ4ZLBrNI420twhPMnWrae', 1),
(25, 26, '', 0, 0, 'ch_1IgZ7OLBrNI420twPmheRHN7', 1),
(26, 26, '', 0, 0, 'ch_1IgZ9NLBrNI420twzzBSKMpq', 1),
(27, 24, '', 0, 0, 'ch_1IgZVILBrNI420twU2CQVbqj', 1),
(30, 45, 'Skirting', 80, 0, 'ch_1IiKZ5LBrNI420twzTZMgoIO', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(64) NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `role_id`) VALUES
(1, 'admin@bookworms.com', '$2y$10$9DwoD.YVzCMleCri1pRRyeRewrPbNXgG0539GiTYyQD41HwQOWYoK', 'admin', 1),
(2, 'sarah@bloggs.com', '$2y$10$5kmfqH6smlxNHUA2HSqZMuLQaz2LhAnzXdgoJzREZVBxihsHjRmly', 'Bernadette Bashirian', 4),
(13, 'admin@test.com', '$2y$10$Irxdk9vTRV5b5CGCA6Mpc.LwJHo0T.PBAWEvl8gwGpHfqCce2.B82', 'Frank', 1),
(17, 'joe@test.com', '$2y$10$8PfI5j43fZCgEd2fkUWfFu2/SdHTcO1qsmaqvZsXHWI46Gf1A9Qea', 'Joe Bloggs', 4),
(18, 'test@test.com', '$2y$10$IaCucdNvTZs0LrqbuNcE2emxUCqSoHj3Gc6lSASwRkLpVjmcSVG16', 'Test user', 4),
(19, 'testingcustomer@test.com', '$2y$10$zAvaKN2zNUknyRIiIp6gae4FUdc0vb37vBgDMCF5exogJDNxu30GK', 'testing customer', 4),
(21, 'testuser@test.com', '$2y$10$tuSFH7Mc4sImrptbFtap8.3KcvoAbEoVdEqkZOAt1cXVf81Nd1/.S', 'TEST USER ON NEW FORM', 4),
(22, 'leabyrne124@gmail.com', '$2y$10$wN1b1WxR2I4jlEeF64KYJOkZ3Ys/wkugOg6WobXIMpwXubl2kDVzy', 'Lea Byrne', 4),
(23, 'jimmy@test.com', '$2y$10$cc.WOfYEm39XJsytwx0Pw.//QBqyGvf/ow06jJbrAZ/wXMEfmctDa', 'jimmy testing', 4),
(24, 'jimmy@testing.com', '$2y$10$FskzdkbvVWwoG/oR4trJf.6we1EXOem64/w1Zds0XSKAIAA9XPLi.', 'jimmy testing', 4),
(25, 'tesa@testing.com', '$2y$10$jr1kO9t4CLMutz/V3kWkz.feIKjIFAATJQ.eSTXIBDDOd8ZYQtEXa', 'osjoegtejv teih', 4),
(27, 'michaelmouse@disney.com', '$2y$10$KYmAeILW9ckS2./DCtfCeewzqFYsstqr9fb3fqxTpF75VTG0/hBWG', 'Michael Mouse', 4),
(28, 'soggymoose@gmail.com', '$2y$10$I/r52ISRxKJp2Ie.JUOmuO96ThYLv3lPR4cgNgF6N/UxDu/fq5MQS', 'Sean monks', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `related_images`
--
ALTER TABLE `related_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_title_unique` (`title`);

--
-- Indexes for table `timbers`
--
ALTER TABLE `timbers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `image_id` (`image_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `timber_attribute`
--
ALTER TABLE `timber_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timber_id` (`timber_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `timber_related_image`
--
ALTER TABLE `timber_related_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `related_image_id` (`related_image_id`),
  ADD KEY `timber_id` (`timber_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `transaction_timber`
--
ALTER TABLE `transaction_timber`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`timber_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `related_images`
--
ALTER TABLE `related_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `timbers`
--
ALTER TABLE `timbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `timber_attribute`
--
ALTER TABLE `timber_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `timber_related_image`
--
ALTER TABLE `timber_related_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `transaction_timber`
--
ALTER TABLE `transaction_timber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_images_fk` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `customers_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `timbers`
--
ALTER TABLE `timbers`
  ADD CONSTRAINT `images_products_fk` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `images_timbers_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `timber_attribute`
--
ALTER TABLE `timber_attribute`
  ADD CONSTRAINT `fk_timberAttribute_attribute` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_timberAttribute_timber` FOREIGN KEY (`timber_id`) REFERENCES `timbers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timber_related_image`
--
ALTER TABLE `timber_related_image`
  ADD CONSTRAINT `fk_related_image_id` FOREIGN KEY (`related_image_id`) REFERENCES `related_images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_timber_id` FOREIGN KEY (`timber_id`) REFERENCES `timbers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transaction_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `transaction_timber`
--
ALTER TABLE `transaction_timber`
  ADD CONSTRAINT `fk_tt_timber` FOREIGN KEY (`timber_id`) REFERENCES `timbers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tt_transaction` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
