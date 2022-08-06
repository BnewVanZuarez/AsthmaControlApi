-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.17 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for asthma_control
CREATE DATABASE IF NOT EXISTS `asthma_control` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `asthma_control`;

-- Dumping structure for table asthma_control.daftar_obat
CREATE TABLE IF NOT EXISTS `daftar_obat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) unsigned DEFAULT NULL,
  `nama_obat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dosis` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table asthma_control.daftar_obat: ~4 rows (approximately)
INSERT INTO `daftar_obat` (`id`, `users_id`, `nama_obat`, `dosis`, `tanggal_input`) VALUES
	(1, 6, 'Obat C', '3x1 Setelah Makan', '2022-07-13 06:07:48'),
	(2, 6, 'Obat A', '3x1 Setelah Makan', '2022-07-13 06:08:20'),
	(3, 6, 'Obat B 1 Mg', '3x1 Setelah Makan', '0000-00-00 00:00:00'),
	(4, 3, 'Paracetamol 1Mg', '3 x 1 Setelah Makan', '2022-07-18 17:08:31'),
	(5, 6, 'Obat D', '2x1 Sebelum Makan', '2022-07-18 17:11:57');

-- Dumping structure for table asthma_control.daily_jurnal
CREATE TABLE IF NOT EXISTS `daily_jurnal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) unsigned DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `rate_today` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rate_pain` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mood_today` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gejala` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gejala_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `paparan` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `paparan_alergen` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nafsu_makan` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kelelahan` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `aktivitas` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `aktivitas_durasi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `aktivitas_intensitas` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table asthma_control.daily_jurnal: ~0 rows (approximately)
INSERT INTO `daily_jurnal` (`id`, `users_id`, `tanggal`, `rate_today`, `rate_pain`, `mood_today`, `gejala`, `gejala_value`, `paparan`, `paparan_alergen`, `nafsu_makan`, `kelelahan`, `aktivitas`, `aktivitas_durasi`, `aktivitas_intensitas`, `notes`, `tanggal_input`) VALUES
	(1, 6, '2022-07-26', '8', '3', '2', 'Ya', 'Dada Sesak, Batuk, ', 'Ya', 'Debu', '7', '2', 'Ngoding', '180', 'Sedang', 'Ok', '2022-07-26 15:42:56'),
	(2, 6, '2022-07-29', '10', '2', '1', 'Ya', 'Batuk, ', 'Tidak', '', '10', '3', 'Bersepeda', '180', 'Sedang', 'Sehat', '2022-07-29 15:55:56');

-- Dumping structure for table asthma_control.edukasi
CREATE TABLE IF NOT EXISTS `edukasi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `writer` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `detail` longtext COLLATE utf8mb4_general_ci,
  `tanggal_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table asthma_control.edukasi: ~6 rows (approximately)
INSERT INTO `edukasi` (`id`, `slug`, `writer`, `judul`, `gambar`, `video`, `detail`, `tanggal_input`) VALUES
	(1, 'duis-quis-dolor-sem-vestibulum-nisi-ligula', 'Super Admin', 'Duis quis dolor sem. Vestibulum nisi ligula', 'duis-quis-dolor-sem-vestibulum-nisi-ligula-2022-06-30-15-05-26-1869707388.jpg', 'YE7VzlLtp-4', '&lt;p&gt;Duis quis dolor sem. Vestibulum nisi ligula, venenatis vel eros eget, rhoncus consectetur eros. In ultrices dolor sit amet risus feugiat, at sodales erat congue. Proin non sapien sed sem elementum placerat in ut risus. Maecenas viverra, mauris in vestibulum aliquet, tortor magna viverra tortor, sollicitudin tristique urna ex et dolor. Praesent a est volutpat, pharetra augue nec, elementum erat. Morbi pulvinar molestie iaculis. Nulla quam odio, congue in ultrices vel, sodales id ante. Sed vulputate commodo rutrum. Suspendisse potenti. Etiam id dui imperdiet, convallis magna eu, pretium lacus. Vivamus congue, lacus sed tempus efficitur, felis nisi sagittis eros, at fermentum justo sapien eu justo. Proin ac risus nisi.&lt;br&gt;&lt;br&gt;Sed gravida mauris nulla. Vivamus hendrerit condimentum nisl non ullamcorper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus fringilla quam ut neque bibendum luctus. In tincidunt vehicula elementum. Proin ornare fringilla ipsum, vitae gravida ante maximus vel. Nullam in convallis lorem. Nulla egestas justo ut eros egestas viverra.&lt;br&gt;&lt;br&gt;Etiam tincidunt tellus ac malesuada faucibus. Suspendisse potenti. Ut scelerisque pellentesque augue, et mollis mauris auctor non. Phasellus fermentum tellus quis lacinia dignissim. Phasellus blandit ante eget tincidunt ornare. Aenean aliquam magna in tellus tristique porttitor. Curabitur turpis odio, dignissim in vehicula interdum, pellentesque vel lacus. Suspendisse dui mauris, suscipit a elit sed, imperdiet sollicitudin odio. Suspendisse potenti. In hac habitasse platea dictumst. Morbi mattis at lectus sed tincidunt. Aenean imperdiet sit amet sapien sit amet cursus. Aenean posuere vel nunc at eleifend. Aliquam sed ultricies sapien, a pharetra erat.&lt;br&gt;&lt;br&gt;Vivamus metus leo, porttitor ut viverra non, aliquam ut eros. Proin eu euismod tortor, porta hendrerit eros. Nullam ullamcorper nibh rutrum, sollicitudin nunc ac, mollis dui. Vestibulum ullamcorper et ante sed accumsan. Aenean fringilla, quam sed semper pretium, lectus lorem dapibus nulla, quis condimentum nisl lectus eu nibh. Aenean blandit tempus tempus. Etiam efficitur ante orci. Curabitur egestas lectus sagittis nibh tincidunt rutrum. Nam semper suscipit imperdiet. Proin nunc elit, cursus vitae justo ut, accumsan ultrices sem. Etiam sapien massa, egestas in lectus ut, interdum ornare nunc. Duis ipsum risus, semper ac porttitor quis, hendrerit nec eros.&lt;br&gt;&lt;br&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tempus finibus turpis eget aliquet. Pellentesque varius lectus nulla, eu pellentesque massa commodo ac. Aliquam tristique purus at libero commodo viverra. Nulla vitae sagittis neque. Fusce maximus justo orci, ac mollis orci sodales at. In hac habitasse platea dictumst. Nunc fringilla metus sem, a placerat odio vestibulum eu. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur placerat facilisis tincidunt. &lt;br&gt;&lt;/p&gt;', '2022-06-30 12:59:01'),
	(2, 'sed-gravida-mauris-nulla', 'Super Admin', 'Sed gravida mauris nulla', 'sed-gravida-mauris-nulla-2022-06-30-15-10-49-1332844371.jpg', 'YE7VzlLtp-4', '&lt;p&gt;Duis quis dolor sem. Vestibulum nisi ligula, venenatis vel eros eget, rhoncus consectetur eros. In ultrices dolor sit amet risus feugiat, at sodales erat congue. Proin non sapien sed sem elementum placerat in ut risus. Maecenas viverra, mauris in vestibulum aliquet, tortor magna viverra tortor, sollicitudin tristique urna ex et dolor. Praesent a est volutpat, pharetra augue nec, elementum erat. Morbi pulvinar molestie iaculis. Nulla quam odio, congue in ultrices vel, sodales id ante. Sed vulputate commodo rutrum. Suspendisse potenti. Etiam id dui imperdiet, convallis magna eu, pretium lacus. Vivamus congue, lacus sed tempus efficitur, felis nisi sagittis eros, at fermentum justo sapien eu justo. Proin ac risus nisi.&lt;br&gt;&lt;br&gt;Sed gravida mauris nulla. Vivamus hendrerit condimentum nisl non ullamcorper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus fringilla quam ut neque bibendum luctus. In tincidunt vehicula elementum. Proin ornare fringilla ipsum, vitae gravida ante maximus vel. Nullam in convallis lorem. Nulla egestas justo ut eros egestas viverra.&lt;br&gt;&lt;br&gt;Etiam tincidunt tellus ac malesuada faucibus. Suspendisse potenti. Ut scelerisque pellentesque augue, et mollis mauris auctor non. Phasellus fermentum tellus quis lacinia dignissim. Phasellus blandit ante eget tincidunt ornare. Aenean aliquam magna in tellus tristique porttitor. Curabitur turpis odio, dignissim in vehicula interdum, pellentesque vel lacus. Suspendisse dui mauris, suscipit a elit sed, imperdiet sollicitudin odio. Suspendisse potenti. In hac habitasse platea dictumst. Morbi mattis at lectus sed tincidunt. Aenean imperdiet sit amet sapien sit amet cursus. Aenean posuere vel nunc at eleifend. Aliquam sed ultricies sapien, a pharetra erat.&lt;br&gt;&lt;br&gt;Vivamus metus leo, porttitor ut viverra non, aliquam ut eros. Proin eu euismod tortor, porta hendrerit eros. Nullam ullamcorper nibh rutrum, sollicitudin nunc ac, mollis dui. Vestibulum ullamcorper et ante sed accumsan. Aenean fringilla, quam sed semper pretium, lectus lorem dapibus nulla, quis condimentum nisl lectus eu nibh. Aenean blandit tempus tempus. Etiam efficitur ante orci. Curabitur egestas lectus sagittis nibh tincidunt rutrum. Nam semper suscipit imperdiet. Proin nunc elit, cursus vitae justo ut, accumsan ultrices sem. Etiam sapien massa, egestas in lectus ut, interdum ornare nunc. Duis ipsum risus, semper ac porttitor quis, hendrerit nec eros.&lt;br&gt;&lt;br&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tempus finibus turpis eget aliquet. Pellentesque varius lectus nulla, eu pellentesque massa commodo ac. Aliquam tristique purus at libero commodo viverra. Nulla vitae sagittis neque. Fusce maximus justo orci, ac mollis orci sodales at. In hac habitasse platea dictumst. Nunc fringilla metus sem, a placerat odio vestibulum eu. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur placerat facilisis tincidunt. &lt;br&gt;&lt;/p&gt;', '2022-06-30 15:10:49'),
	(3, 'nunc-bibendum-fermentum-mauris-at-posuere-odio-faucibus-a', 'Super Admin', 'Nunc bibendum fermentum mauris, at posuere odio faucibus a', 'nunc-bibendum-fermentum-mauris-at-posuere-odio-faucibus-a-2022-07-10-22-39-05-1040929426.jpg', 'YE7VzlLtp-4', '&lt;div id=&quot;lipsum&quot; align=&quot;justify&quot;&gt;\r\n&lt;p&gt;\r\nCurabitur vel elementum lorem. Nulla convallis fermentum est, vitae \r\nsodales mauris scelerisque nec. Morbi nec erat id diam accumsan \r\nmalesuada. Aliquam pellentesque nibh sit amet faucibus suscipit. \r\nPellentesque et suscipit nulla. Nunc in odio vel lorem bibendum \r\nimperdiet. Maecenas non porta nibh.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nNunc bibendum fermentum mauris, at posuere odio faucibus a. Morbi \r\naliquet leo ac urna consequat, placerat commodo orci faucibus. Mauris \r\nvehicula eu ligula tempor tristique. Maecenas et libero ullamcorper, \r\ncursus ex ac, gravida nisl. Duis quis mauris ac est euismod porta \r\nlaoreet sed nibh. Nullam eget accumsan turpis. Vestibulum egestas \r\ncommodo lacus, vitae scelerisque erat tristique fermentum. Quisque \r\nfringilla massa sapien, vel tincidunt purus semper sed.\r\n&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\nPhasellus in elementum nulla, vel mattis metus. Suspendisse mattis \r\ncursus odio efficitur accumsan. Donec ut dui euismod, hendrerit nunc \r\nnec, tempor ex. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n Integer egestas metus ac imperdiet dictum. Proin sodales varius sapien \r\nac gravida. Aliquam vel congue eros. Suspendisse eget quam tortor. \r\nAliquam convallis finibus elementum.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nNulla at auctor nibh. Sed eu viverra lectus. Sed tincidunt neque nisi, \r\nquis blandit nisl feugiat eget. Nullam maximus ullamcorper purus non \r\npharetra. Fusce auctor id orci non hendrerit. Mauris gravida porta \r\nmetus, non volutpat ligula pellentesque ac. Aliquam pharetra enim at \r\nlacus hendrerit suscipit. Nunc id arcu nec libero aliquam tempus. \r\nVestibulum lacus sapien, interdum eget fermentum sed, venenatis maximus \r\nsem. Ut a tempus tellus. Vestibulum ullamcorper sapien nec tortor \r\npretium imperdiet. Donec euismod lectus vitae mauris finibus consequat.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nCras tincidunt nisl vitae eros pharetra semper. Proin mollis libero sit \r\namet dui finibus, porttitor cursus dui pulvinar. Aenean rhoncus viverra \r\nipsum sit amet imperdiet. Donec nibh nulla, sodales ut feugiat non, \r\ntempor scelerisque eros. Vestibulum ante ipsum primis in faucibus orci \r\nluctus et ultrices posuere cubilia curae; Praesent aliquet faucibus \r\nimperdiet. Vivamus massa nulla, euismod in bibendum id, pharetra egestas\r\n purus.\r\n&lt;/p&gt;&lt;/div&gt;&lt;p align=&quot;justify&quot;&gt;&lt;/p&gt;', '2022-07-10 22:39:05'),
	(4, 'phasellus-in-elementum-nulla-vel-mattis-metus', 'Super Admin', 'Phasellus in elementum nulla, vel mattis metus', 'phasellus-in-elementum-nulla-vel-mattis-metus-2022-07-10-22-45-51-2010958997.jpg', 'YE7VzlLtp-4', '&lt;div id=&quot;lipsum&quot; align=&quot;justify&quot;&gt;\r\n&lt;p&gt;\r\nCurabitur vel elementum lorem. Nulla convallis fermentum est, vitae \r\nsodales mauris scelerisque nec. Morbi nec erat id diam accumsan \r\nmalesuada. Aliquam pellentesque nibh sit amet faucibus suscipit. \r\nPellentesque et suscipit nulla. Nunc in odio vel lorem bibendum \r\nimperdiet. Maecenas non porta nibh.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nNunc bibendum fermentum mauris, at posuere odio faucibus a. Morbi \r\naliquet leo ac urna consequat, placerat commodo orci faucibus. Mauris \r\nvehicula eu ligula tempor tristique. Maecenas et libero ullamcorper, \r\ncursus ex ac, gravida nisl. Duis quis mauris ac est euismod porta \r\nlaoreet sed nibh. Nullam eget accumsan turpis. Vestibulum egestas \r\ncommodo lacus, vitae scelerisque erat tristique fermentum. Quisque \r\nfringilla massa sapien, vel tincidunt purus semper sed.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nPhasellus in elementum nulla, vel mattis metus. Suspendisse mattis \r\ncursus odio efficitur accumsan. Donec ut dui euismod, hendrerit nunc \r\nnec, tempor ex. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n Integer egestas metus ac imperdiet dictum. Proin sodales varius sapien \r\nac gravida. Aliquam vel congue eros. Suspendisse eget quam tortor. \r\nAliquam convallis finibus elementum.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nNulla at auctor nibh. Sed eu viverra lectus. Sed tincidunt neque nisi, \r\nquis blandit nisl feugiat eget. Nullam maximus ullamcorper purus non \r\npharetra. Fusce auctor id orci non hendrerit. Mauris gravida porta \r\nmetus, non volutpat ligula pellentesque ac. Aliquam pharetra enim at \r\nlacus hendrerit suscipit. Nunc id arcu nec libero aliquam tempus. \r\nVestibulum lacus sapien, interdum eget fermentum sed, venenatis maximus \r\nsem. Ut a tempus tellus. Vestibulum ullamcorper sapien nec tortor \r\npretium imperdiet. Donec euismod lectus vitae mauris finibus consequat.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nCras tincidunt nisl vitae eros pharetra semper. Proin mollis libero sit \r\namet dui finibus, porttitor cursus dui pulvinar. Aenean rhoncus viverra \r\nipsum sit amet imperdiet. Donec nibh nulla, sodales ut feugiat non, \r\ntempor scelerisque eros. Vestibulum ante ipsum primis in faucibus orci \r\nluctus et ultrices posuere cubilia curae; Praesent aliquet faucibus \r\nimperdiet. Vivamus massa nulla, euismod in bibendum id, pharetra egestas\r\n purus.\r\n&lt;/p&gt;&lt;/div&gt;&lt;p align=&quot;justify&quot;&gt;&lt;/p&gt;', '2022-07-10 22:45:51'),
	(5, 'cras-tincidunt-nisl-vitae-eros-pharetra-semper', 'Super Admin', 'Cras tincidunt nisl vitae eros pharetra semper', 'cras-tincidunt-nisl-vitae-eros-pharetra-semper-2022-07-10-22-48-30-341579188.jpg', 'YE7VzlLtp-4', '&lt;div id=&quot;lipsum&quot; align=&quot;justify&quot;&gt;\r\n&lt;p&gt;\r\nCurabitur vel elementum lorem. Nulla convallis fermentum est, vitae \r\nsodales mauris scelerisque nec. Morbi nec erat id diam accumsan \r\nmalesuada. Aliquam pellentesque nibh sit amet faucibus suscipit. \r\nPellentesque et suscipit nulla. Nunc in odio vel lorem bibendum \r\nimperdiet. Maecenas non porta nibh.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nNunc bibendum fermentum mauris, at posuere odio faucibus a. Morbi \r\naliquet leo ac urna consequat, placerat commodo orci faucibus. Mauris \r\nvehicula eu ligula tempor tristique. Maecenas et libero ullamcorper, \r\ncursus ex ac, gravida nisl. Duis quis mauris ac est euismod porta \r\nlaoreet sed nibh. Nullam eget accumsan turpis. Vestibulum egestas \r\ncommodo lacus, vitae scelerisque erat tristique fermentum. Quisque \r\nfringilla massa sapien, vel tincidunt purus semper sed.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nPhasellus in elementum nulla, vel mattis metus. Suspendisse mattis \r\ncursus odio efficitur accumsan. Donec ut dui euismod, hendrerit nunc \r\nnec, tempor ex. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n Integer egestas metus ac imperdiet dictum. Proin sodales varius sapien \r\nac gravida. Aliquam vel congue eros. Suspendisse eget quam tortor. \r\nAliquam convallis finibus elementum.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nNulla at auctor nibh. Sed eu viverra lectus. Sed tincidunt neque nisi, \r\nquis blandit nisl feugiat eget. Nullam maximus ullamcorper purus non \r\npharetra. Fusce auctor id orci non hendrerit. Mauris gravida porta \r\nmetus, non volutpat ligula pellentesque ac. Aliquam pharetra enim at \r\nlacus hendrerit suscipit. Nunc id arcu nec libero aliquam tempus. \r\nVestibulum lacus sapien, interdum eget fermentum sed, venenatis maximus \r\nsem. Ut a tempus tellus. Vestibulum ullamcorper sapien nec tortor \r\npretium imperdiet. Donec euismod lectus vitae mauris finibus consequat.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nCras tincidunt nisl vitae eros pharetra semper. Proin mollis libero sit \r\namet dui finibus, porttitor cursus dui pulvinar. Aenean rhoncus viverra \r\nipsum sit amet imperdiet. Donec nibh nulla, sodales ut feugiat non, \r\ntempor scelerisque eros. Vestibulum ante ipsum primis in faucibus orci \r\nluctus et ultrices posuere cubilia curae; Praesent aliquet faucibus \r\nimperdiet. Vivamus massa nulla, euismod in bibendum id, pharetra egestas\r\n purus.\r\n&lt;/p&gt;&lt;/div&gt;&lt;p align=&quot;justify&quot;&gt;&lt;/p&gt;', '2022-07-10 22:48:30'),
	(6, 'proin-mollis-libero-sit-amet-dui-finibus', 'Super Admin', 'Proin mollis libero sit amet dui finibus', 'proin-mollis-libero-sit-amet-dui-finibus-2022-07-10-22-48-52-1473946177.jpg', 'YE7VzlLtp-4', '&lt;div id=&quot;lipsum&quot; align=&quot;justify&quot;&gt;\r\n&lt;p&gt;\r\nCurabitur vel elementum lorem. Nulla convallis fermentum est, vitae \r\nsodales mauris scelerisque nec. Morbi nec erat id diam accumsan \r\nmalesuada. Aliquam pellentesque nibh sit amet faucibus suscipit. \r\nPellentesque et suscipit nulla. Nunc in odio vel lorem bibendum \r\nimperdiet. Maecenas non porta nibh.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nNunc bibendum fermentum mauris, at posuere odio faucibus a. Morbi \r\naliquet leo ac urna consequat, placerat commodo orci faucibus. Mauris \r\nvehicula eu ligula tempor tristique. Maecenas et libero ullamcorper, \r\ncursus ex ac, gravida nisl. Duis quis mauris ac est euismod porta \r\nlaoreet sed nibh. Nullam eget accumsan turpis. Vestibulum egestas \r\ncommodo lacus, vitae scelerisque erat tristique fermentum. Quisque \r\nfringilla massa sapien, vel tincidunt purus semper sed.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nPhasellus in elementum nulla, vel mattis metus. Suspendisse mattis \r\ncursus odio efficitur accumsan. Donec ut dui euismod, hendrerit nunc \r\nnec, tempor ex. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n Integer egestas metus ac imperdiet dictum. Proin sodales varius sapien \r\nac gravida. Aliquam vel congue eros. Suspendisse eget quam tortor. \r\nAliquam convallis finibus elementum.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nNulla at auctor nibh. Sed eu viverra lectus. Sed tincidunt neque nisi, \r\nquis blandit nisl feugiat eget. Nullam maximus ullamcorper purus non \r\npharetra. Fusce auctor id orci non hendrerit. Mauris gravida porta \r\nmetus, non volutpat ligula pellentesque ac. Aliquam pharetra enim at \r\nlacus hendrerit suscipit. Nunc id arcu nec libero aliquam tempus. \r\nVestibulum lacus sapien, interdum eget fermentum sed, venenatis maximus \r\nsem. Ut a tempus tellus. Vestibulum ullamcorper sapien nec tortor \r\npretium imperdiet. Donec euismod lectus vitae mauris finibus consequat.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nCras tincidunt nisl vitae eros pharetra semper. Proin mollis libero sit \r\namet dui finibus, porttitor cursus dui pulvinar. Aenean rhoncus viverra \r\nipsum sit amet imperdiet. Donec nibh nulla, sodales ut feugiat non, \r\ntempor scelerisque eros. Vestibulum ante ipsum primis in faucibus orci \r\nluctus et ultrices posuere cubilia curae; Praesent aliquet faucibus \r\nimperdiet. Vivamus massa nulla, euismod in bibendum id, pharetra egestas\r\n purus.\r\n&lt;/p&gt;&lt;/div&gt;&lt;p align=&quot;justify&quot;&gt;&lt;/p&gt;', '2022-07-10 22:48:52');

-- Dumping structure for table asthma_control.peak_flow
CREATE TABLE IF NOT EXISTS `peak_flow` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) unsigned DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nilai` int(11) unsigned DEFAULT NULL,
  `warna` tinyint(1) DEFAULT NULL COMMENT '1.Merah, 2.Kuning, 3.Hijau',
  `tanggal_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table asthma_control.peak_flow: ~2 rows (approximately)
INSERT INTO `peak_flow` (`id`, `users_id`, `tanggal`, `nilai`, `warna`, `tanggal_input`) VALUES
	(1, 6, '2022-07-01', 80, 1, '2022-07-29 15:02:57'),
	(2, 6, '2022-07-02', 100, 2, '2022-07-29 15:24:43'),
	(3, 6, '2022-07-03', 800, 3, '2022-07-29 15:37:01');

-- Dumping structure for table asthma_control.rencana_aksi_asma
CREATE TABLE IF NOT EXISTS `rencana_aksi_asma` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) unsigned DEFAULT NULL,
  `nama_dokter` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telp_dokter` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kontak_darurat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telp_darurat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_obat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dosis_obat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `digunakan_saat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instruksi_tambahan` text COLLATE utf8mb4_general_ci,
  `pemicu` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hijau_peakflow_dari` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hijau_peakflow_ke` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kuning_peakflow_dari` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kuning_peakflow_ke` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `merah_peakflow_dari` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `merah_peakflow_ke` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `FK_rencana_aksi_asma_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table asthma_control.rencana_aksi_asma: ~0 rows (approximately)

-- Dumping structure for table asthma_control.rencana_aksi_asma_obat
CREATE TABLE IF NOT EXISTS `rencana_aksi_asma_obat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rencana_id` int(11) unsigned DEFAULT NULL,
  `zona` tinyint(1) unsigned DEFAULT NULL COMMENT '1.Merah, 2.Kuning, 3.Hijau',
  `jenis_obat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dosis` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `waktu_konsumsi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rencana_id` (`rencana_id`),
  CONSTRAINT `FK_rencana_aksi_asma_obat_rencana_aksi_asma` FOREIGN KEY (`rencana_id`) REFERENCES `rencana_aksi_asma` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table asthma_control.rencana_aksi_asma_obat: ~0 rows (approximately)

-- Dumping structure for table asthma_control.rumah_sakit
CREATE TABLE IF NOT EXISTS `rumah_sakit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table asthma_control.rumah_sakit: ~2 rows (approximately)
INSERT INTO `rumah_sakit` (`id`, `nama`, `alamat`, `longitude`, `latitude`) VALUES
	(1, 'RS AMC Muhammadiyah ', 'Jl. HOS Cokroaminoto No.17B, Pakuncen, Wirobrajan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55253', '110.3517186', '-7.7996487'),
	(2, 'RS PKU Muhammadiyah Yogyakarta ', 'Jl. KH. Ahmad Dahlan No.20, Ngupasan, Kec. Gondomanan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55122', '110.3623108', '-7.8007405');

-- Dumping structure for table asthma_control.tanya_jawab
CREATE TABLE IF NOT EXISTS `tanya_jawab` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pasien_id` int(11) unsigned DEFAULT NULL,
  `admin_id` int(11) unsigned DEFAULT NULL,
  `no_tiket` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `perihal` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1.aktif, 2.Selesai',
  `tanggal_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pasien_id` (`pasien_id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `FK_tanya_jawab_users` FOREIGN KEY (`pasien_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `FK_tanya_jawab_users_2` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table asthma_control.tanya_jawab: ~2 rows (approximately)
INSERT INTO `tanya_jawab` (`id`, `pasien_id`, `admin_id`, `no_tiket`, `perihal`, `status`, `tanggal_input`) VALUES
	(1, 6, 4, '266002312', 'Tanya', 1, '2022-07-18 23:12:20'),
	(2, 6, 4, '266002224', 'Halo', 1, '2022-08-04 22:24:32');

-- Dumping structure for table asthma_control.tanya_jawab_chat
CREATE TABLE IF NOT EXISTS `tanya_jawab_chat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tj_id` int(11) unsigned DEFAULT NULL,
  `pesan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipe` tinyint(4) DEFAULT NULL COMMENT '1.Pasien, 2.Admin',
  `read` tinyint(4) DEFAULT '1' COMMENT '1.Unread, 2.Read',
  `tanggal_input` datetime DEFAULT NULL,
  KEY `id` (`id`),
  KEY `tj_id` (`tj_id`),
  CONSTRAINT `FK_tanya_jawab_chat_tanya_jawab` FOREIGN KEY (`tj_id`) REFERENCES `tanya_jawab` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table asthma_control.tanya_jawab_chat: ~16 rows (approximately)
INSERT INTO `tanya_jawab_chat` (`id`, `tj_id`, `pesan`, `tipe`, `read`, `tanggal_input`) VALUES
	(1, 2, 'Halo', 1, 1, '2022-08-05 10:18:19'),
	(2, 2, 'OK', 2, 1, '2022-08-05 10:19:06'),
	(3, 1, 'Halo, selamat siang', 1, 1, '2022-08-05 10:44:31'),
	(4, 1, 'Selamat siang, ada yang bisa kami bantu', 2, 1, '2022-08-05 10:45:35'),
	(5, 1, 'oqsiisbdjw dhsusuwgjs sadye dhwue dkdbdie dhwvdud wufudve ueuwbd sjwhe djwvfus eiwbfie doe o', 1, 1, '2022-08-05 10:46:39'),
	(6, 1, '\n', 1, 1, '2022-08-05 10:46:49'),
	(7, 1, '...', 1, 1, '2022-08-05 10:47:09'),
	(8, 1, 'heue susjsvs. jwisgdjd.\n', 1, 1, '2022-08-05 10:47:21'),
	(9, 1, 'hdhdhd', 1, 1, '2022-08-05 10:49:02'),
	(10, 1, 'jdjdjd', 1, 1, '2022-08-05 10:49:07'),
	(11, 1, 'bdbhe cisj', 1, 1, '2022-08-05 10:49:09'),
	(12, 1, 'hfiebx', 1, 1, '2022-08-05 10:49:10'),
	(13, 1, 'w xbs', 1, 1, '2022-08-05 10:49:11'),
	(14, 1, 'fbd', 1, 1, '2022-08-05 10:49:12'),
	(15, 1, 'Ok', 2, 1, '2022-08-05 10:50:00'),
	(16, 1, 'hdhd', 1, 1, '2022-08-05 10:52:56');

-- Dumping structure for table asthma_control.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1.Super Admin, 2.Admin, 3.Pasien',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1.Aktif, 2.Non-Aktif',
  `tanggal_input` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table asthma_control.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `email`, `password`, `hash`, `reset`, `nama_lengkap`, `no_telp`, `level`, `status`, `tanggal_input`) VALUES
	(1, 'super@email.com', '$2y$10$jLe0bfU/nI.BmHc7yjN9Ou1ydlRdtTpwh7nrMhBJzbRO12MT75qOC', '6cc1631de6dcd2e52913fcaef7412704', NULL, 'Super Admin', '081111111111', 1, 1, '2022-06-26 23:09:48'),
	(2, 'admin@email.com', '$2y$10$jLe0bfU/nI.BmHc7yjN9Ou1ydlRdtTpwh7nrMhBJzbRO12MT75qOC', NULL, NULL, 'Admin', '082222222222', 2, 1, '2022-06-26 23:10:28'),
	(3, 'pasien@email.com', '$2y$10$jLe0bfU/nI.BmHc7yjN9Ou1ydlRdtTpwh7nrMhBJzbRO12MT75qOC', '050373be452a1d6398427a1edd45a187', NULL, 'Pasien', '083333333333', 3, 1, '2022-06-26 23:10:59'),
	(4, 'ibnu.raffy@gmail.com', '$2y$10$AdimLntDBicWfi5KIrCfNu7fuSbyKQk0Q.heiKj4vAistCf0aaH0u', NULL, NULL, 'Ibnu Raffi', '08112951726', 2, 1, '2022-06-26 23:54:37'),
	(6, 'ibnuraffy@gmail.com', '$2y$10$slDOqTOOkGFAJo.yGF.S7.TqIxFisyLUt93i.muaaMA3w8uJAhH9m', '93f0dfc8843ab60c7248115e1c146d92', NULL, 'Ibnu Raffi', '08112951726', 3, 1, '2022-07-04 22:55:23');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
