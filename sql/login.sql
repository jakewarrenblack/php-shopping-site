-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2021 at 09:01 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

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
(16, 'Montrath, Killbeggan, Westmeath', '087-7435635', 29, 86),
(17, '15 Boyne Cross, Dundalk, Co Louth', '066-9150847', 30, 81),
(18, 'Ballygarron, Mills View, Tralee, County Kerry', '087-7512674', 31, 82),
(19, '4 Main Street, Dunleer, County Louth', '061-418927', 32, 83),
(20, '18 Dominick Street, Ballyshannon, County Donegal', '086-8122271', 33, 84);

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
(46, 'UPLOAD_DIR/16190226826080535a507f3.jpg'),
(47, 'UPLOAD_DIR/16191976416082fec910731.jpg'),
(48, 'UPLOAD_DIR/16191979196082ffdfb6c59.jpg'),
(49, 'UPLOAD_DIR/1619216465608348519eb44.jpg'),
(50, 'UPLOAD_DIR/1619216576608348c056788.jpg'),
(51, 'UPLOAD_DIR/16192167346083495e8907a.jpg'),
(52, 'UPLOAD_DIR/161921703460834a8acb33c.jpg'),
(53, 'UPLOAD_DIR/161921735860834bce3b4ce.jpg'),
(54, 'UPLOAD_DIR/161921757960834cab530c2.jpg'),
(55, 'UPLOAD_DIR/161921826060834f541f4d5.jpg'),
(56, 'UPLOAD_DIR/161921837360834fc5e3a4a.jpg'),
(57, 'UPLOAD_DIR/161921850460835048e1107.jpg'),
(58, 'UPLOAD_DIR/1619218634608350cac5184.jpg'),
(59, 'UPLOAD_DIR/16192187336083512d2050a.jpg'),
(60, 'UPLOAD_DIR/16192189576083520dc39fd.jpg'),
(61, 'UPLOAD_DIR/1619219105608352a151611.jpg'),
(62, 'UPLOAD_DIR/16192192166083531088a7a.jpg'),
(63, 'UPLOAD_DIR/16192193116083536f5c91e.jpg'),
(64, 'UPLOAD_DIR/1619219434608353ea09ad8.jpg'),
(65, 'UPLOAD_DIR/16192195886083548419999.jpg'),
(66, 'UPLOAD_DIR/161922143660835bbcb6d98.jpg'),
(67, 'UPLOAD_DIR/161922185660835d60b5be8.jpg'),
(68, 'UPLOAD_DIR/161922219560835eb3abda5.jpg'),
(69, 'UPLOAD_DIR/161922237160835f63d1b42.jpg'),
(70, 'UPLOAD_DIR/16192225796083603386982.jpg'),
(71, 'UPLOAD_DIR/1619222756608360e4d02d5.jpg'),
(72, 'UPLOAD_DIR/16192229396083619b7b1fc.jpg'),
(73, 'UPLOAD_DIR/16192230986083623ac244c.jpg'),
(74, 'UPLOAD_DIR/161922413160836643ae14b.jpg'),
(75, 'UPLOAD_DIR/1619224262608366c6c394e.jpg'),
(76, 'UPLOAD_DIR/161922432560836705ec053.jpg'),
(77, 'UPLOAD_DIR/1619224416608367608ec10.jpg'),
(78, 'UPLOAD_DIR/1619224488608367a821a90.jpg'),
(79, 'UPLOAD_DIR/1619224563608367f35a2d0.jpg'),
(80, 'UPLOAD_DIR/16192815516084468fdf73a.jpg'),
(81, 'UPLOAD_DIR/16192817476084475342755.jpg'),
(82, 'UPLOAD_DIR/1619281936608448108d726.jpg'),
(83, 'UPLOAD_DIR/161928245560844a17262fc.jpg'),
(84, 'UPLOAD_DIR/161928259460844aa236953.jpg'),
(85, 'UPLOAD_DIR/1619286446608459aee7269.jpg'),
(86, 'UPLOAD_DIR/1619286491608459db6d519.jpg');

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
(56, 'UPLOAD_DIR/1619035090608083d2ccb5a.jpg'),
(57, 'UPLOAD_DIR/16191976416082fec914b78.jpg'),
(58, 'UPLOAD_DIR/16191976416082fec91959c.jpg'),
(59, 'UPLOAD_DIR/16191976416082fec91cec6.jpg'),
(60, 'UPLOAD_DIR/16191979196082ffdfbda71.jpg'),
(61, 'UPLOAD_DIR/16191979196082ffdfc0202.jpg'),
(62, 'UPLOAD_DIR/16191979196082ffdfc3ed4.jpg'),
(63, 'UPLOAD_DIR/1619216465608348519fe88.jpg'),
(64, 'UPLOAD_DIR/161921646560834851a116a.jpg'),
(65, 'UPLOAD_DIR/161921646560834851a1abb.jpg'),
(66, 'UPLOAD_DIR/161921646560834851a246f.jpg'),
(67, 'UPLOAD_DIR/1619216576608348c057c7f.jpg'),
(68, 'UPLOAD_DIR/1619216576608348c058a13.jpg'),
(69, 'UPLOAD_DIR/1619216576608348c0593e8.jpg'),
(70, 'UPLOAD_DIR/1619216576608348c059d7d.jpg'),
(71, 'UPLOAD_DIR/16192167346083495e8a053.jpg'),
(72, 'UPLOAD_DIR/16192167346083495e8acbc.jpg'),
(73, 'UPLOAD_DIR/16192167346083495e8b63b.jpg'),
(74, 'UPLOAD_DIR/16192167346083495e8bf33.jpg'),
(75, 'UPLOAD_DIR/161921703460834a8acc23a.jpg'),
(76, 'UPLOAD_DIR/161921703460834a8acd142.jpg'),
(77, 'UPLOAD_DIR/161921703460834a8ad06f1.jpg'),
(78, 'UPLOAD_DIR/161921703460834a8ad1185.jpg'),
(79, 'UPLOAD_DIR/161921735860834bce3c96c.jpg'),
(80, 'UPLOAD_DIR/161921735860834bce3d7e1.jpg'),
(81, 'UPLOAD_DIR/161921735860834bce3e178.jpg'),
(82, 'UPLOAD_DIR/161921735860834bce3eaf1.jpg'),
(83, 'UPLOAD_DIR/161921757960834cab54689.png'),
(84, 'UPLOAD_DIR/161921757960834cab5532b.jpg'),
(85, 'UPLOAD_DIR/161921757960834cab55cfd.jpg'),
(86, 'UPLOAD_DIR/161921757960834cab56710.jpg'),
(87, 'UPLOAD_DIR/161921826060834f54202e4.jpg'),
(88, 'UPLOAD_DIR/161921826060834f54210af.jpg'),
(89, 'UPLOAD_DIR/161921826060834f5421a3e.jpg'),
(90, 'UPLOAD_DIR/161921826060834f54224eb.jpg'),
(91, 'UPLOAD_DIR/161921837360834fc5e4740.jpg'),
(92, 'UPLOAD_DIR/161921837360834fc5e54cc.jpg'),
(93, 'UPLOAD_DIR/161921837360834fc5e5f59.jpg'),
(94, 'UPLOAD_DIR/161921837360834fc5e6b4d.jpg'),
(95, 'UPLOAD_DIR/161921850460835048e21a0.jpg'),
(96, 'UPLOAD_DIR/161921850460835048e2dfb.jpg'),
(97, 'UPLOAD_DIR/161921850460835048e3871.jpg'),
(98, 'UPLOAD_DIR/161921850460835048e44a3.jpg'),
(99, 'UPLOAD_DIR/1619218634608350cac66bb.jpg'),
(100, 'UPLOAD_DIR/1619218634608350cac75f3.jpg'),
(101, 'UPLOAD_DIR/1619218634608350cac8051.jpg'),
(102, 'UPLOAD_DIR/1619218634608350cac8a76.jpg'),
(103, 'UPLOAD_DIR/16192187336083512d21162.jpg'),
(104, 'UPLOAD_DIR/16192187336083512d21ca7.jpg'),
(105, 'UPLOAD_DIR/16192187336083512d22674.jpg'),
(106, 'UPLOAD_DIR/16192187336083512d23274.jpg'),
(107, 'UPLOAD_DIR/16192189576083520dc508f.jpg'),
(108, 'UPLOAD_DIR/16192189576083520dc5dc9.jpg'),
(109, 'UPLOAD_DIR/16192189576083520dc679f.jpg'),
(110, 'UPLOAD_DIR/16192189576083520dc7184.jpg'),
(111, 'UPLOAD_DIR/1619219105608352a15251c.jpg'),
(112, 'UPLOAD_DIR/1619219105608352a153118.jpg'),
(113, 'UPLOAD_DIR/1619219105608352a153af0.jpg'),
(114, 'UPLOAD_DIR/1619219105608352a154458.jpg'),
(115, 'UPLOAD_DIR/16192192166083531089df3.jpg'),
(116, 'UPLOAD_DIR/1619219216608353108a969.jpg'),
(117, 'UPLOAD_DIR/1619219216608353108b652.jpg'),
(118, 'UPLOAD_DIR/1619219216608353108c17a.jpg'),
(119, 'UPLOAD_DIR/16192193116083536f5de33.jpg'),
(120, 'UPLOAD_DIR/16192193116083536f5e9db.png'),
(121, 'UPLOAD_DIR/16192193116083536f5f3b7.jpg'),
(122, 'UPLOAD_DIR/16192193116083536f63101.jpg'),
(123, 'UPLOAD_DIR/1619219434608353ea0ad31.jpg'),
(124, 'UPLOAD_DIR/1619219434608353ea0b8bc.jpg'),
(125, 'UPLOAD_DIR/1619219434608353ea0c17b.jpg'),
(126, 'UPLOAD_DIR/1619219434608353ea0ca5a.jpg'),
(127, 'UPLOAD_DIR/1619219588608354841adc5.jpg'),
(128, 'UPLOAD_DIR/1619219588608354841bd20.jpg'),
(129, 'UPLOAD_DIR/1619219588608354841c758.jpg'),
(130, 'UPLOAD_DIR/1619219588608354841d1ca.jpg'),
(131, 'UPLOAD_DIR/161922143660835bbcb82f8.jpg'),
(132, 'UPLOAD_DIR/161922143660835bbcb8e99.jpg'),
(133, 'UPLOAD_DIR/161922143660835bbcb98a1.jpg'),
(134, 'UPLOAD_DIR/161922143660835bbcba3de.jpg'),
(135, 'UPLOAD_DIR/161922185660835d60b732f.jpg'),
(136, 'UPLOAD_DIR/161922185660835d60b804b.jpg'),
(137, 'UPLOAD_DIR/161922185660835d60b8e6c.jpg'),
(138, 'UPLOAD_DIR/161922185660835d60b99bb.jpg'),
(139, 'UPLOAD_DIR/161922219560835eb3b11ad.jpg'),
(140, 'UPLOAD_DIR/161922219560835eb3b2031.jpg'),
(141, 'UPLOAD_DIR/161922219560835eb3b29c2.jpg'),
(142, 'UPLOAD_DIR/161922219560835eb3b335b.jpg'),
(143, 'UPLOAD_DIR/161922237160835f63d2e92.jpg'),
(144, 'UPLOAD_DIR/161922237160835f63d3b37.jpg'),
(145, 'UPLOAD_DIR/161922237160835f63d450b.jpg'),
(146, 'UPLOAD_DIR/161922237160835f63d4e6c.jpg'),
(147, 'UPLOAD_DIR/16192225796083603387ea6.jpg'),
(148, 'UPLOAD_DIR/16192225796083603388cf7.jpg'),
(149, 'UPLOAD_DIR/161922257960836033896ea.jpg'),
(150, 'UPLOAD_DIR/1619222579608360338a1b1.jpg'),
(151, 'UPLOAD_DIR/1619222756608360e4d16eb.jpg'),
(152, 'UPLOAD_DIR/1619222756608360e4d747b.jpg'),
(153, 'UPLOAD_DIR/1619222756608360e4d7f0c.jpg'),
(154, 'UPLOAD_DIR/1619222756608360e4d88c6.jpg'),
(155, 'UPLOAD_DIR/16192229396083619b7c5dc.jpg'),
(156, 'UPLOAD_DIR/16192229396083619b7d2fe.jpg'),
(157, 'UPLOAD_DIR/16192229396083619b7dc43.jpg'),
(158, 'UPLOAD_DIR/16192229396083619b846ec.jpg'),
(159, 'UPLOAD_DIR/16192230986083623ac376c.jpg'),
(160, 'UPLOAD_DIR/16192230986083623ac965b.jpg'),
(161, 'UPLOAD_DIR/16192230986083623aca191.jpg'),
(162, 'UPLOAD_DIR/16192230986083623acadc6.png'),
(163, 'UPLOAD_DIR/1619223472608363b0d2fc0.jpg'),
(164, 'UPLOAD_DIR/1619223472608363b0d44a3.jpg'),
(165, 'UPLOAD_DIR/1619223472608363b0d4eeb.jpg'),
(166, 'UPLOAD_DIR/1619223472608363b0d58eb.jpg'),
(167, 'UPLOAD_DIR/16192235666083640ee89e7.jpg'),
(168, 'UPLOAD_DIR/16192235666083640ee9c12.jpg'),
(169, 'UPLOAD_DIR/16192235666083640eea664.jpg'),
(170, 'UPLOAD_DIR/16192235666083640eef5f3.jpg'),
(171, 'UPLOAD_DIR/1619223721608364a9c0daf.jpg'),
(172, 'UPLOAD_DIR/1619223721608364a9c1fd9.jpg'),
(173, 'UPLOAD_DIR/1619223721608364a9c607d.jpg'),
(174, 'UPLOAD_DIR/1619223721608364a9c6a78.jpg'),
(175, 'UPLOAD_DIR/161922413160836643aee2c.jpg'),
(176, 'UPLOAD_DIR/161922413160836643afe60.jpg'),
(177, 'UPLOAD_DIR/161922413160836643b0aa4.jpg'),
(178, 'UPLOAD_DIR/161922413160836643b14cd.jpg'),
(179, 'UPLOAD_DIR/161927990460844020591c0.jpg');

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
(2, 'American Alder', 'Alder is a hardwood which is slowly gaining a rising popularity due to its natural beauty, workability and versatility. It is more frequently found in the Northwest regions of California and Southwestern parts of Canada. It is in the same family as the birch tree, so it often shares similar applications.', '40.00', 1, 22, 75),
(4, 'Cherry', 'Cherry is a beautiful wood which comes from the American Black Cherry fruit tree. This wood often starts as a light pink color that darkens and changes to a reddish hue over time. Cherry wood can sometimes have black flecking, which occurs naturally from mineral deposits over time.', '88.00', 1, 22, 76),
(5, 'Red Oak', 'Perhaps one of the most loved hardwoods, oak is a very popular choice for woodworkers, especially in building furniture and high quality heirloom pieces that can last for generations.', '102.00', 1, 50, 77),
(6, 'Yellow Birch', 'Birch is a hardwood which is easy to find and often one of the more affordable hardwood species at local lumberyards and home centers.', '28.00', 1, 22, 74),
(7, 'Fir', 'Fir is another great economical and strong softwood to consider working with for beginning woodworking projects. Fir is usually a good choice for projects you plan on painting, since it can be sometimes difficult to stain and really does not have much of a wood grain.', '52.00', 1, 88, 78),
(8, 'California Redwood', 'California redwood trees are a softwood known best for their massive size and red color. It has a very interesting wood grain pattern, and much likes its Cedar cousins, Redwood is very suitable for outdoor applications due to its ability to be weather resistant.', '22.00', 1, 22, 79),
(9, 'Cedar', 'Many people are familiar with cedar not just for its interesting wood grain and color, but also for its aromatic smell which is believed to repel pests and moths. The aromatic scent and bug repelling properties is why it is sometimes a popular choice to use in closets and storage chests.', '22.00', 1, 22, 32),
(10, 'Ebony', 'Ebony wood is easy to identify, since this is one of the few woods that are truly black in color. It is a very dense hardwood and has many characteristics that make it desirable for a number of wood carving and specialized woodworking projects.', '11.00', 1, 11, 33),
(16, 'Gluam', 'Glued laminated timber, popularly known as glulam, is a manufactured timber product. It is made by bonding together individual laminates (layers) of solid timber boards with durable, moisture-resistant structural adhesives. ', '30.00', 1, 80, 39),
(17, 'Chestnut', 'Sweet Chestnut is an English hardwood which used to be a cheap alternative to Oak. Good quality Chestnut is currently scarce and should not have ‘ring-shakes’ or yellow discolouration. Chestnut may be used for interior joinery when kiln-dried and is stocked as logsawn yielding widths of 100mm – 220mm and lengths 2m – 3.5metre.', '45.00', 1, 90, 44),
(22, 'Aspen', 'Aspen is a hardwood grown in Northeast America but can sometimes be difficult to find. Due to its general limited availability, it is typically only used for very specific projects in which Aspen wood is ideal.', '40.00', 1, 12, 49),
(23, 'Bamboo', 'The Bamboo plant has a tall, hollow stem. These stems can be used as-is, or they can be cut into very thin, narrow strips to create a veneer. The veneer product from the stems is made into an engineered wood such as plywood.', '18.00', 1, 40, 50),
(24, 'Basswood', 'Basswood is a hardwood favorite for woodcarvers and woodturners. It is also a very popular choice for those who enjoy miniature woodworking and building models. Woodturners often enjoy working with basswood due to its ease of use and availability.', '50.00', 1, 35, 51),
(25, 'Beechwood', 'Beech is a hardwood that is often used for wood veneers, furniture, and woodturner objects. This cream toned wood has a consistent grain pattern which is usually straight and tight, and occasionally will have gray flecking.', '45.00', 1, 20, 52),
(26, 'Larch', 'Larch wood, also known as Tamarack wood, is of the tree species in the Larix family. Larix laricina is the variety most known as Tamarack and is commonly found in North America. In Eurasia, the species is more commonly Larix decidua and more frequently known as Larch.', '28.00', 1, 40, 53),
(27, 'Luan', 'This wood is very flexible and can bend easily. This gives it a unique property that can make it very useful in building miniatures and models. Being lightweight and relatively inexpensive with reliable availability also makes it popular to use in other craft and hobby projects.', '18.00', 1, 44, 54),
(28, 'Mahogany', 'Mahogany is a beautiful exotic hardwood and a premium wood for furniture making. The wood often starts with a pinkish tone that will deepen and darken over time.', '45.00', 1, 55, 55),
(29, 'Maple', 'Maple is a beautiful hardwood which is often used in applications where the natural wood grain is visible. Maple is grown primarily in sustainable North American forests.', '34.00', 2, 55, 56),
(30, 'MDF', 'Medium density fiberboard, more commonly known as MDF is another engineered wood product that is similar to HDF, or high density fiberboard, but with a lesser overall density.', '45.00', 2, 33, 57),
(31, 'Pine', 'Pine is a very common and versatile softwood which has many practical applications. Pine typically is considered to be economical, sustainable and durable, which makes it a popular choice for a number of different projects.', '55.00', 2, 44, 58),
(32, 'Plywood', 'Plywood is an engineered wood product, though it is made with real wood. Plywood is made by adhering multiple layers of veneer together and compressing them.', '24.00', 2, 45, 59),
(33, 'Poplar', 'Poplar is a popular and economical hardwood to use for a number of different building projects and applications. The wood is very light in color, and may even appear as white. It does not have a very distinguishable nor necessarily attractive wood grain, so poplar is often painted or used in places where it is not visible.', '34.00', 2, 60, 60),
(34, 'Rosewood', 'Rosewood is an exotic hardwood, which often contributes to the expensive price of popular musical instruments. Brazillian rosewood is common, although it can also come from Madagascar or Asia.', '80.00', 2, 45, 61),
(35, 'Spruce', 'Spruce is an evergreen softwood tree, and as mentioned previously is commonly found in lumber yards as “SPF lumber” which is frequently used for construction framing projects.', '55.00', 2, 60, 62),
(36, 'Teak', 'Teak is an exotic hardwood native to the Asian rainforests. It takes a very long growing cycle, with the average tree needing 60 years before it reaches maturity to be harvested.', '70.00', 2, 50, 63),
(37, 'Walnut', 'Walnut is a hardwood that is best known for its rich brown and dark coloring. Walnut can be expensive and often is only available through specialty lumber stores, but it is a beautiful wood to consider for special projects.', '25.00', 2, 45, 64),
(38, 'Zebrawood', 'Lastly, but certainly not least, is the exotic wood known as Zebrawood. There are several varieties of Zebrawood, most of which are native to Central America and Central Africa.', '120.00', 2, 50, 65),
(39, 'Balsa', 'Balsa is a very lightweight hardwood that is typically used in hobby and craft types of projects. Many fine woodworkers tend to have a negative viewpoint of balsa wood since it is not very strong, but it often under appreciated and has many practical uses.', '15.00', 2, 50, 66),
(40, 'Fiber Cement Board', 'Hardie board is a composite construction building material that is the brand name of fiber cement board. The reason fiber cement board is often called Hardie board is because the James Hardie Brand is one of the top companies which manufacture and produce this product.', '25.00', 2, 40, 67),
(41, 'Wenge', 'West African Wenge is very dark brown with close ‘black’ veins alternating with ‘pale’ bands and is therefore favoured by furniture makers. It is also used for turnery and joinery (for interior and exterior use) and can be used for flooring due to natural resistance to abrasion.', '15.00', 2, 22, 68),
(42, 'Meranti', 'Malaysian dark red Meranti varies in colour from pale pink / white to dark red / purple. The density can also vary substantially as there are numerous sub-species. Often used as a false ‘mahogany’ for products such as windows, conservatories and doors.', '50.00', 2, 85, 69),
(43, 'Sapele', 'General Description: Sapele predominantly from West Africa is a reddish-brown hardwood. Although some parts of the Sapele logs will produce straight-grain or ‘quartered’ effect, generally it has a more random grain appearance.', '40.00', 2, 55, 70),
(44, 'American tulipwood', 'The sapwood is creamy white and may be streaked, with the heartwood varying from pale yellowish brown to olive green. The green colour in the heartwood will tend to darken on exposure to UV light and turn brown.', '25.00', 2, 22, 71),
(45, 'Scandinavian Redwood', 'Scandinavian Pine (also referred to as ‘redwood’ to differentiate it from ‘whitewood’ such as Spruce) is imported from Sweden, Finland and Russia. The grades vary for different uses. Knots are common but their size and quality vary according to the part of the tree from which boards are converted.', '50.00', 2, 75, 72),
(46, 'Southern Yellow Pine', 'Southern Yellow Pine (not to be confused with Quebec Yellow) comes from southern states of USA. It is a relatively ‘heavy’ weight softwood, used for joinery products such as stairs.', '40.00', 2, 25, 73);

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
(5, 8, 5),
(6, 8, 1),
(7, 9, 11),
(8, 9, 8),
(11, 10, 4),
(12, 10, 5),
(27, 22, 1),
(28, 22, 2),
(29, 23, 3),
(30, 23, 4),
(31, 24, 5),
(32, 24, 6),
(33, 25, 7),
(34, 25, 8),
(35, 26, 10),
(36, 26, 11),
(37, 27, 1),
(38, 27, 2),
(39, 28, 3),
(40, 28, 4),
(41, 29, 4),
(42, 29, 5),
(43, 30, 5),
(44, 30, 6),
(45, 31, 7),
(46, 31, 8),
(47, 32, 9),
(48, 32, 10),
(49, 33, 10),
(50, 33, 11),
(51, 34, 1),
(52, 34, 2),
(53, 35, 3),
(54, 35, 4),
(55, 36, 4),
(56, 36, 5),
(57, 37, 6),
(58, 37, 7),
(59, 38, 1),
(60, 38, 10),
(61, 39, 4),
(62, 39, 9),
(63, 40, 8),
(64, 40, 11),
(65, 41, 1),
(66, 41, 2),
(67, 42, 3),
(68, 42, 4),
(69, 43, 5),
(70, 43, 6),
(71, 44, 5),
(72, 44, 6),
(73, 45, 7),
(74, 45, 8),
(75, 46, 10),
(76, 46, 11),
(90, 2, 1),
(91, 2, 2),
(92, 4, 3),
(93, 4, 4),
(94, 5, 5),
(95, 5, 6),
(96, 6, 7),
(97, 6, 8),
(98, 7, 8),
(99, 7, 9);

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
(10, 43, 16),
(11, 44, 16),
(12, 45, 16),
(13, 46, 17),
(14, 47, 17),
(15, 48, 17),
(29, 63, 22),
(30, 64, 22),
(31, 65, 22),
(32, 66, 22),
(33, 67, 23),
(34, 68, 23),
(35, 69, 23),
(36, 70, 23),
(37, 71, 24),
(38, 72, 24),
(39, 73, 24),
(40, 74, 24),
(41, 75, 25),
(42, 76, 25),
(43, 77, 25),
(44, 78, 25),
(45, 79, 26),
(46, 80, 26),
(47, 81, 26),
(48, 82, 26),
(49, 83, 27),
(50, 84, 27),
(51, 85, 27),
(52, 86, 27),
(53, 87, 28),
(54, 88, 28),
(55, 89, 28),
(56, 90, 28),
(57, 91, 29),
(58, 92, 29),
(59, 93, 29),
(60, 94, 29),
(61, 95, 30),
(62, 96, 30),
(63, 97, 30),
(64, 98, 30),
(65, 99, 31),
(66, 100, 31),
(67, 101, 31),
(68, 102, 31),
(69, 103, 32),
(70, 104, 32),
(71, 105, 32),
(72, 106, 32),
(73, 107, 33),
(74, 108, 33),
(75, 109, 33),
(76, 110, 33),
(77, 111, 34),
(78, 112, 34),
(79, 113, 34),
(80, 114, 34),
(81, 115, 35),
(82, 116, 35),
(83, 117, 35),
(84, 118, 35),
(85, 119, 36),
(86, 120, 36),
(87, 121, 36),
(88, 122, 36),
(89, 123, 37),
(90, 124, 37),
(91, 125, 37),
(92, 126, 37),
(93, 127, 38),
(94, 128, 38),
(95, 129, 38),
(96, 130, 38),
(97, 131, 39),
(98, 132, 39),
(99, 133, 39),
(100, 134, 39),
(101, 135, 40),
(102, 136, 40),
(103, 137, 40),
(104, 138, 40),
(105, 139, 41),
(106, 140, 41),
(107, 141, 41),
(108, 142, 41),
(109, 143, 42),
(110, 144, 42),
(111, 145, 42),
(112, 146, 42),
(113, 147, 43),
(114, 148, 43),
(115, 149, 43),
(116, 150, 43),
(117, 151, 44),
(118, 152, 44),
(119, 153, 44),
(120, 154, 44),
(121, 155, 45),
(122, 156, 45),
(123, 157, 45),
(124, 158, 45),
(125, 159, 46),
(126, 160, 46),
(127, 161, 46),
(128, 162, 46),
(129, 163, 2),
(130, 164, 2),
(131, 165, 2),
(132, 166, 2),
(133, 167, 4),
(134, 168, 4),
(135, 169, 4),
(136, 170, 4),
(137, 171, 5),
(138, 172, 5),
(139, 173, 5),
(140, 174, 5),
(141, 175, 6),
(142, 176, 6),
(143, 177, 6),
(144, 178, 6),
(145, 179, 4);

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
('ch_1IjoKKLBrNI420twKiTFuAMF', 16, 'succeeded', '2021-04-24 17:27:28', 1210),
('ch_1IjoN2LBrNI420twmPXDhMgs', 17, 'succeeded', '2021-04-24 17:30:16', 6700),
('ch_1IjoQhLBrNI420twBuP15K0c', 18, 'succeeded', '2021-04-24 17:34:03', 3820),
('ch_1IjoYALBrNI420twTTlLeb9Q', 19, 'succeeded', '2021-04-24 17:41:46', 1575),
('ch_1Ijp2DLBrNI420twLFh9vYDN', 20, 'succeeded', '2021-04-24 18:12:49', 714);

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
(34, 55, 'Straight cut', 50, 0, 'ch_1IjoKKLBrNI420twKiTFuAMF', 8),
(35, 60, 'Architrave', 25, 1, 'ch_1IjoN2LBrNI420twmPXDhMgs', 28),
(36, 80, 'Skirting', 50, 0, 'ch_1IjoN2LBrNI420twmPXDhMgs', 45),
(37, 60, 'Skirting', 45, 1, 'ch_1IjoQhLBrNI420twBuP15K0c', 32),
(38, 70, 'Architrave', 55, 1, 'ch_1IjoQhLBrNI420twBuP15K0c', 33),
(39, 35, 'Architrave', 60, 0, 'ch_1IjoYALBrNI420twTTlLeb9Q', 30),
(40, 14, 'Straight cut', 55, 1, 'ch_1Ijp2DLBrNI420twLFh9vYDN', 10),
(41, 14, 'Architrave', 60, 1, 'ch_1Ijp2DLBrNI420twLFh9vYDN', 22);

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
(29, 'jdoherty@gmail.com', '$2y$10$FKf60EaTnxMa2JBMNjnFTeRczv/CsAbux3h3LUkbjMu5i1jyXG/jS', 'John Doherty', 4),
(30, 'eric@email.com', '$2y$10$Gc9xKKc3w.BqvMVUgFivw.SufL69ZOEw/lLgyDetGBu7oynBpVoSm', 'Eric Reilly', 4),
(31, 'mary@email.com', '$2y$10$VfLAg15J7nvASgnj/2MYKefUG3hdSZaDLiFyh5A9W98h0qhRR8aCK', 'Mary Connors', 4),
(32, 'edna@email.com', '$2y$10$mia1gs21rQxSrICrJYHauuRg3ah.F8eXC6YRkjbbOvAWF1fep6WAS', 'Edna Lynch', 4),
(33, 'rory@email.com', '$2y$10$yz5mQ6aHdr/PHjyIby4q7eGD7DZq9vUPXdmPn2UqxYrF8fBuwz.Jm', 'Rory Murray', 4);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `related_images`
--
ALTER TABLE `related_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `timbers`
--
ALTER TABLE `timbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `timber_attribute`
--
ALTER TABLE `timber_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `timber_related_image`
--
ALTER TABLE `timber_related_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `transaction_timber`
--
ALTER TABLE `transaction_timber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
