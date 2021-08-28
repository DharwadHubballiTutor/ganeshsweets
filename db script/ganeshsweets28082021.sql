-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 28, 2021 at 01:19 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ganeshsweets`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(200) NOT NULL,
  `brand_description` varchar(500) DEFAULT NULL,
  `brand_createdby` varchar(200) NOT NULL,
  `brand_modifiedby` varchar(200) NOT NULL,
  `brand_createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `brand_modifiedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

DROP TABLE IF EXISTS `company_details`;
CREATE TABLE IF NOT EXISTS `company_details` (
  `companyid` int(12) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(250) NOT NULL,
  `company_address` varchar(250) NOT NULL,
  `company_contact` varchar(15) NOT NULL,
  `company_tag` varchar(500) NOT NULL,
  `company_branches` varchar(250) NOT NULL,
  `company_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ModifiedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `company_GSTIN` varchar(15) DEFAULT NULL,
  `company_BankName` varchar(100) DEFAULT NULL,
  `company_BankAccountNumber` varchar(100) DEFAULT NULL,
  `company_BankIFSC` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`companyid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customerId` int(11) NOT NULL AUTO_INCREMENT,
  `customerCode` varchar(100) NOT NULL,
  `customerName` varchar(200) NOT NULL,
  `customerContactNumber` varchar(15) NOT NULL,
  `customerEmail` varchar(200) NOT NULL,
  `customerAddress` varchar(500) NOT NULL,
  `customerState` varchar(200) NOT NULL,
  `customerCity` varchar(200) NOT NULL,
  `isQuoteGenerated` tinyint(1) NOT NULL DEFAULT '0',
  `createdby` varchar(200) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedby` varchar(200) NOT NULL,
  `modifiedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `customerDOV` datetime NOT NULL,
  PRIMARY KEY (`customerId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `customerCode`, `customerName`, `customerContactNumber`, `customerEmail`, `customerAddress`, `customerState`, `customerCity`, `isQuoteGenerated`, `createdby`, `createdon`, `modifiedby`, `modifiedon`, `customerDOV`) VALUES
(1, 'AD-199601-s1', 'swathi', '3465676', 'swathi@gmail.com', '1st cross new badami nagar', 'KARNATAKA', 'hubballi', 0, 'ganeshsweets', '2021-08-07 13:16:39', 'ganeshsweets', '2021-08-07 13:16:39', '1996-01-29 00:00:00'),
(5, 'GS-202108-A5-CU', 'Adarsh12', '8865767745', 'adarshkotagi1998@gmail.com', '1234mqin street', 'KARNATAKA', 'Ron', 0, 'ganeshsweets', '2021-08-24 12:48:22', 'ganeshsweets', '2021-08-24 12:48:36', '2021-08-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `designimages`
--

DROP TABLE IF EXISTS `designimages`;
CREATE TABLE IF NOT EXISTS `designimages` (
  `designImgId` int(11) NOT NULL AUTO_INCREMENT,
  `customerId` int(11) NOT NULL,
  `designFilePath` varchar(200) NOT NULL,
  `designDescription` varchar(500) NOT NULL,
  `createdby` varchar(200) NOT NULL,
  `modifiedby` varchar(200) NOT NULL,
  `modifiedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`designImgId`),
  KEY `customerId` (`customerId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dimensions`
--

DROP TABLE IF EXISTS `dimensions`;
CREATE TABLE IF NOT EXISTS `dimensions` (
  `dimensionsId` int(11) NOT NULL AUTO_INCREMENT,
  `dimensionsName` varchar(200) NOT NULL,
  `dimensionsDescription` varchar(500) NOT NULL,
  `length` int(11) DEFAULT NULL,
  `breadth` int(11) DEFAULT NULL,
  `thickness` int(11) DEFAULT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` varchar(200) NOT NULL,
  `modifiedOn` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` varchar(200) NOT NULL,
  PRIMARY KEY (`dimensionsId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dimensions`
--

INSERT INTO `dimensions` (`dimensionsId`, `dimensionsName`, `dimensionsDescription`, `length`, `breadth`, `thickness`, `createdOn`, `createdBy`, `modifiedOn`, `modifiedBy`) VALUES
(2, '720x560x18', '720x560x18', 720, 560, 18, '2021-06-04 06:46:18', 'info@acedecors.in', '2021-06-04 06:46:18', 'info@acedecors.in'),
(3, 'Top/Bottom', '900mm Carcase', 864, 560, 18, '2021-06-12 12:18:08', 'info@acedecors.in', '2021-06-12 12:18:08', 'info@acedecors.in'),
(4, 'Top/Bottom', '800mm Carcase', 764, 560, 18, '2021-06-12 12:18:39', 'info@acedecors.in', '2021-06-12 12:18:39', 'info@acedecors.in');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_category`
--

DROP TABLE IF EXISTS `enquiry_category`;
CREATE TABLE IF NOT EXISTS `enquiry_category` (
  `enq_catid` int(11) NOT NULL AUTO_INCREMENT,
  `enq_cat_name` varchar(200) NOT NULL,
  `enq_cat_createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enq_cat_createdby` varchar(200) NOT NULL,
  `enq_cat_modifiedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enq_cat_modifiedby` varchar(200) NOT NULL,
  PRIMARY KEY (`enq_catid`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry_category`
--

INSERT INTO `enquiry_category` (`enq_catid`, `enq_cat_name`, `enq_cat_createdon`, `enq_cat_createdby`, `enq_cat_modifiedon`, `enq_cat_modifiedby`) VALUES
(82, 'Modular Wardrobes', '2021-06-10 04:06:08', '', '2021-06-10 04:06:08', ''),
(83, 'Modular Kitchen', '2021-06-10 12:27:13', '', '2021-06-10 12:27:58', '');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_details`
--

DROP TABLE IF EXISTS `enquiry_details`;
CREATE TABLE IF NOT EXISTS `enquiry_details` (
  `enqid` int(11) NOT NULL AUTO_INCREMENT,
  `enq_name` varchar(200) NOT NULL,
  `enq_email` varchar(200) NOT NULL,
  `enq_address` varchar(500) NOT NULL,
  `enq_phone` varchar(10) NOT NULL,
  `enqStatus` enum('Attened','Unattened') NOT NULL DEFAULT 'Unattened',
  `isCustomerCreated` tinyint(1) NOT NULL DEFAULT '0',
  `enq_createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enq_modifiedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enq_modifiedBy` varchar(200) NOT NULL,
  `enq_preffered_contact_mode` varchar(20) NOT NULL,
  PRIMARY KEY (`enqid`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_followups`
--

DROP TABLE IF EXISTS `enquiry_followups`;
CREATE TABLE IF NOT EXISTS `enquiry_followups` (
  `followupid` int(11) NOT NULL AUTO_INCREMENT,
  `followup_enq_id` int(11) NOT NULL,
  `followup_comments` varchar(500) NOT NULL,
  `followup_createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `followup_by` varchar(200) NOT NULL,
  PRIMARY KEY (`followupid`),
  KEY `followup_enq_id` (`followup_enq_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry_followups`
--

INSERT INTO `enquiry_followups` (`followupid`, `followup_enq_id`, `followup_comments`, `followup_createdon`, `followup_by`) VALUES
(19, 11, 'test comments', '2021-06-04 09:27:41', '/'),
(20, 11, 'test comments 1', '2021-06-04 09:28:10', '/'),
(21, 11, '', '2021-06-05 10:24:33', 'info@acedecors.in'),
(22, 11, 'test 2', '2021-06-10 04:07:34', '/'),
(23, 12, 'test', '2021-06-10 04:08:21', '/'),
(24, 50, 'Shashi Kumar', '2021-06-10 04:15:18', '/'),
(25, 50, 'shashi kumar 2', '2021-06-10 04:15:52', '/'),
(26, 50, 'test', '2021-06-10 07:02:31', '/'),
(27, 51, 'Hello there its testing', '2021-06-10 07:53:57', 'info@acedecors.in'),
(28, 52, 'testing1', '2021-06-10 08:03:19', 'info@acedecors.in'),
(29, 51, '', '2021-06-10 08:29:27', 'info@acedecors.in'),
(30, 0, '', '2021-06-10 08:46:12', 'info@acedecors.in'),
(31, 0, '', '2021-06-10 08:49:40', '/'),
(32, 0, '', '2021-06-10 08:49:46', '/'),
(33, 54, '123 test', '2021-06-10 09:16:49', '/'),
(34, 0, '', '2021-06-24 07:35:27', 'info@acedecors.in'),
(35, 0, '', '2021-06-24 07:35:34', 'info@acedecors.in'),
(36, 0, '', '2021-06-24 07:35:38', 'info@acedecors.in'),
(37, 54, '', '2021-06-24 07:35:59', 'info@acedecors.in'),
(38, 0, '', '2021-06-24 07:36:03', 'info@acedecors.in'),
(39, 0, '', '2021-06-24 07:36:07', 'info@acedecors.in'),
(40, 0, '', '2021-06-24 07:39:07', 'info@acedecors.in'),
(41, 56, 'Construction Work in Progress', '2021-06-24 23:41:32', 'info@acedecors.in'),
(42, 12, 'test2', '2021-06-25 00:58:50', 'info@acedecors.in'),
(43, 50, 'test2', '2021-06-25 00:59:17', 'info@acedecors.in'),
(44, 50, '', '2021-06-25 01:00:29', 'info@acedecors.in'),
(45, 57, 'INITIAL CONTACT PENDING', '2021-07-07 06:04:54', 'info@acedecors.in'),
(46, 57, '', '2021-07-07 06:05:36', 'info@acedecors.in');

-- --------------------------------------------------------

--
-- Table structure for table `enq_cat_mapping`
--

DROP TABLE IF EXISTS `enq_cat_mapping`;
CREATE TABLE IF NOT EXISTS `enq_cat_mapping` (
  `enq_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

DROP TABLE IF EXISTS `item_category`;
CREATE TABLE IF NOT EXISTS `item_category` (
  `item_catid` int(11) NOT NULL AUTO_INCREMENT,
  `item_catName` varchar(200) NOT NULL,
  `item_catDescription` varchar(500) NOT NULL,
  `item_catCreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_catCreatedBy` varchar(200) NOT NULL,
  `item_catModifiedOn` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `item_catModifiedBy` varchar(200) NOT NULL,
  PRIMARY KEY (`item_catid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`item_catid`, `item_catName`, `item_catDescription`, `item_catCreatedOn`, `item_catCreatedBy`, `item_catModifiedOn`, `item_catModifiedBy`) VALUES
(1, 'Sweets', 'Sweet is having the taste or flavor characteristic of sugar, honey, etc.', '2021-08-04 12:11:58', 'ganeshsweets', '2021-08-27 20:23:33', 'ganeshsweets'),
(2, 'Namkeen', 'Namkeen or Namkin are Hindi words for savory or salty foods. The word is probably derived from the Hindi word for salt, which is Namak. Khaara, Farsan, Chevda, Sev, Chips, Bhajiya, Mixture are some other names of Namkeen, used in different parts of India.', '2021-08-04 12:14:41', 'ganeshsweets', '2021-08-11 17:27:21', 'ganeshsweets');

-- --------------------------------------------------------

--
-- Table structure for table `item_companydetails`
--

DROP TABLE IF EXISTS `item_companydetails`;
CREATE TABLE IF NOT EXISTS `item_companydetails` (
  `item_compid` int(11) NOT NULL AUTO_INCREMENT,
  `item_compName` varchar(200) NOT NULL,
  `item_compContactName` varchar(200) DEFAULT NULL,
  `item_compContactNumber` varchar(20) DEFAULT NULL,
  `item_compDescription` varchar(500) NOT NULL,
  `item_compGSTIN` varchar(20) NOT NULL,
  `item_compAccountno` varchar(100) NOT NULL,
  `item_compAccountname` varchar(100) NOT NULL,
  `item_compaccIFSCcode` varchar(100) NOT NULL,
  `item_compaccMICRcode` varchar(100) NOT NULL,
  `item_compAddress` varchar(1000) NOT NULL,
  `item_compCreatedBy` varchar(200) NOT NULL,
  `item_compCreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_compModifiedBy` varchar(200) NOT NULL,
  `item_compModifedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `item_complogo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`item_compid`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_companydetails`
--

INSERT INTO `item_companydetails` (`item_compid`, `item_compName`, `item_compContactName`, `item_compContactNumber`, `item_compDescription`, `item_compGSTIN`, `item_compAccountno`, `item_compAccountname`, `item_compaccIFSCcode`, `item_compaccMICRcode`, `item_compAddress`, `item_compCreatedBy`, `item_compCreatedOn`, `item_compModifiedBy`, `item_compModifedOn`, `item_complogo`) VALUES
(21, 'Hettich india Pvt Ltd', 'Abhishek', '+91 9999999999', 'Company Description', '29AAACH8849M1ZT', '00012334555', '00012334555', 'ICIC001234', '223344', 'Mumbai', 'info@acedecors.in', '2021-06-05 02:13:49', 'info@acedecors.in', '2021-06-05 02:15:18', 'hettich logo.gif'),
(22, 'South India Ply Distributors', 'Abhishek', '+91 9999999999', 'Company Description', '29AAACH8849M1ZT', '00012334555', '00012334555', 'ICIC001234', '223344', 'Bangalore', 'info@acedecors.in', '2021-06-05 02:17:29', 'info@acedecors.in', '2021-06-05 03:05:36', 'download.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `item_details`
--

DROP TABLE IF EXISTS `item_details`;
CREATE TABLE IF NOT EXISTS `item_details` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(200) NOT NULL,
  `item_catid` int(11) NOT NULL,
  `item_subcatid` int(11) NOT NULL,
  `item_image` varchar(200) NOT NULL,
  `item_description` varchar(1000) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_details`
--

INSERT INTO `item_details` (`item_id`, `item_name`, `item_catid`, `item_subcatid`, `item_image`, `item_description`) VALUES
(1, 'Motichoor Ladoo', 1, 1, 'motichoor-ladoo.png', 'Motichoor Ladoo has tiny boondi made from besan (gram flour) that are fried in ghee and then mixed with a sugar syrup. This  is popular Indian sweet.'),
(2, 'Mysore Pak', 1, 1, 'mysore-pak.jpg', 'Mysore Pak is a popular south Indian sweet made with gram flour, sugar and ghee.'),
(3, 'Balushahi', 1, 1, 'Balu_shahi.jpg', 'Balushahi is a traditional dessert originating from the Indian subcontinent. It is similar to a glazed doughnut in terms of ingredients, but differs in texture and taste.'),
(4, 'Halva', 1, 1, 'halwa-recipe-1a.jpg', 'Most types of halva are relatively dense confections sweetened with sugar or honey. Their textures, however, vary.'),
(5, 'Jahangir', 1, 1, 'jahangir-normal.jpg', 'Jangiri or Jahangir  is a sugar coated funnel-like sweet. Jangiri is also known as Imarti in Hindi. It has alternative names including Amriti, Omriti, Jahangir and Emarti. This differenc'),
(6, 'Jalebi', 1, 1, 'Kesar-Jalebi-Recipe-in-English-and-Hindi.png', 'Jalebi also known as jilapi, jilebi, jilipi, zulbia, jerry, mushabak, or zalabia, is a popular sweet snack.It is made by deep-frying maida flour (plain flour or all-purpose flour) batter in pretzel or circular shapes, which are then soaked in sugar syrup.'),
(7, 'Motipak', 1, 1, 'Motipak.jpg', 'Small spherical sweet boondi modules, infused with saffron , cashew and almond and shaped into fine tall cubes. The is a new avatar of the classic Laddu.'),
(8, 'Dry Fruit Halva', 1, 1, 'Dry Fruit Halwa Sri Nandini Sweets_medium206811.jpeg', 'The Dry Fruit Halva is a delicious quick sweet made from figs, dates, pistachios, almonds, cashew nuts and walnuts. There is no added sugar in this recipe and hence makes it more healthy.'),
(9, 'Chocolate Roll', 1, 2, 'chocolate-roll.jpg', 'Chocolate Roll is a delicious mithai or indian dessert recipe with grated khoya cooked with sugar. The Chocolate rolls are sliced and served as mithai after meals'),
(10, 'Pista Roll', 1, 2, 'pista-roll-1.jpg', 'Pista Roll an indian dessert recipe prepared from powdered cashew powder and pistachios powder. it is indian sweet delicacy prepared especially during festival seasons especially diwali and navaratri.'),
(11, 'Kesar Roll', 1, 2, 'Kesar Roll.jpg', 'Kesar Roll is resembles mawa kesar roll and is attractive to serve for any festive occasion like Diwali and Dassera.'),
(12, 'Kesar Peda', 1, 2, 'kesar_pedha.jpg', 'Kesar Peda is traditional North Indian sweet made from khoya, sugar, saffron and cardamom. This dessert recipe will be loved by kids and can also be served as a sweet dish after dinners or buffets.'),
(13, 'Chocolate Barfi', 1, 2, 'chacklet burfi.jpg', 'Chocolate Barfi or Chocolate mawa burfi recipe an easy and simple khoya based classical dessert recipe made with mawa and cocoa powder.'),
(14, 'White Barfi', 1, 2, 'white-burfi.JPG', 'White Barfi is made up of Milk, Sugar, Cardamom and Pistachio.'),
(15, 'Amrit peda', 1, 2, 'amurth pedha.jpg', 'Amrit pedas are small semi soft balls made up of khova, milk and sugar giving it a rich and delicious flavour. These mouth watering pedas are usually used to gift their loved ones.'),
(16, 'Mango Barfi', 1, 2, 'mango-burfi3.jpg', 'Mango Barfi is made from fruity mango , milk powder and flavored with kesar , they are so addictive and super easy to make .It is a Quick and Easy dessert for your parties ,get-togethers. , festivals or any occasion.'),
(17, 'Coconut Barfi', 1, 2, 'cocount buri2.png', 'Coconut Barfi is a delicious south Indian Sweet recipe made with coconut, sugar, milk and cardamom powder.'),
(18, 'Mawa Sandwich', 1, 2, 'mawa sandwich.jpg', 'Mawa Sandwich is special type of sandwich which is different from normal sandwich.'),
(19, 'Doodh peda', 1, 2, 'doodh pedha.jpg', 'Doodh peda recipe made with khoya or mawa is one of the popular Indian sweet.These milk pedas taste super and delicious too.'),
(20, 'VIP Barfi', 1, 2, 'vip-burfi.jpg', 'VIP Barfi is a popular Indian sweet made with gram flour, ghee and flavored with cardamom.'),
(21, 'Kunda', 1, 2, 'kunda.jpg', 'Kunda is prepared using sugar, milk and curd.'),
(22, 'Badam Cherry', 1, 2, 'badami cherry.jpg', 'Badam Cherry is one type of sweet recipe which is made up of badam and cherry.'),
(23, 'Orange Barfi', 1, 2, 'orange-barfi-500x500.jpg', 'Orange Barfi is cooked with orange segments which is cooked with khoya, sugar and cardamom.'),
(24, 'Rose Barfi', 1, 2, 'rose-barfi.jpg', 'Rose Barfi is made up of coconut , milk powder , sugar , milk ,rose syrup, green cardamon and dry fruits.'),
(25, 'Venilla Barfi', 1, 2, 'vanilla-barfi.jpg', 'The main ingredients used in this recipe are condensed milk and sugar. This is the most consumed Indian sweet in Mithai shops and confectioneries in India.'),
(26, 'Pista Chap', 1, 2, 'pista chap.png', 'It is one type of sweet recipe.'),
(27, 'Elaichi Barfi', 1, 2, 'elachi burfi2.jpg', 'Roasted Elaichi Barfi is a special kind of barfi which is made by pure khoya/mawa, nuts and with the excellent fragrance of cardamom. It is very soft in texture engrossed with nuts and roasted cardamom.'),
(28, 'Kalakand Barfi', 1, 3, 'Kalakand burfi.jpg', 'Kalakand Barfi is  a delicious milk based sweet with hints of cardamon, is yet another way of enjoying the goodness of milk. It is similar to Barfi.'),
(29, 'MilkCake', 1, 3, 'milk-cake-500x500.jpg', 'MilkCake is originally made by adding alum powder to the evaporated milk. Then this curdled milk is cooked with sugar and ghee (clarified butter) .'),
(30, 'Malai Peda', 1, 3, 'malai-peda1.jpg', 'Malai Peda is a North Indian sweet delight, prepared with full cream milk, sugar, saffron and cardamon.'),
(31, 'Ghee Mysore Pak', 1, 4, 'ghee mysore pak.jpg', 'Ghee Mysore Pak is a delectable Indian sweet made from roasted gram flour and pure homemade ghee.'),
(32, 'Kardant', 1, 4, 'khardant.jpg', 'Kardant is made of edible gum mixed with dry fruits and has a chewy texture. The other ingredients used in its preparation are fried bengal gram flour, jaggery and seeds of marking-nut (Semecarpus anacardium) tree.'),
(33, 'Dink Ladoo', 1, 4, 'dink ladu.jpg', 'Dink Ladoo is a traditional winter sweet. It is healthy, nutritious and a great source for instant energy.'),
(34, 'Soan papdi', 1, 4, 'sweet-soan-papdi-500x500.jpg', 'Soan papdi (also known as patisa, san papri, sohan papdi or shonpapdi) is a popular Indian dessert. It is usually cube-shaped or served as flakes, and has a crisp and flaky texture'),
(35, 'Dry Jamun', 1, 4, 'dry joomn1.jpg', 'Dry Jamun or Sukha gulab jamun recipe. These delicious dry jamun are made with khoya (evaporated milk solids) and paneer (cottage cheese)Dry is the english word for â€˜sukhaâ€™ in hindi.As the name suggests these jamuns do not have sugar syrup served with them. Hence they are known as sukha jamuns.'),
(36, 'Soan Cake', 1, 4, 'sonacake-500x500.jpg', 'Flaky sweet made with gram flour, almonds and pistachios.'),
(37, 'Besan Ladoo', 1, 4, 'besan-laddu.jpg', 'Besan Ladoo are round sweet balls made by roasting gram flour and ghee together, and then adding sugar to make a thick pasty dough that is then formed into delicious.'),
(38, 'Kaju Pista Roll', 1, 5, 'kaju pista1.png', 'Kaju Pista Roll is very popular during Diwali, it is Covered with cashew layer and stuffed with pistachios filling these kaju pista rolls makes everyone drools.'),
(39, 'Kaju Barfi', 1, 5, 'Kaju-Barfi.png', 'Kaju katli, also known as kaju barfi, is a traditional Indian dessert characterized by its diamond shape, made with cashew nuts, sugar, cardamom powder, and ghee butter.'),
(40, 'Kaju Paan', 1, 5, 'kaju-pan-500x500.jpg', 'Kaju Paan is very delicious refreshing mouth watering sweet made with cashew nut powder and gulukand. It is filled with gulukand and dry fruit stuffing and decorated with silver leaf (optional). You can make this sweet special occasion  and festivals.\r\n and festivals.'),
(41, 'Kaju Khajur', 1, 5, 'kaju-kajur.jpg', 'Kaju Khajur is one type of sweet made up of Kaju .'),
(42, 'Kaju Strawberry', 1, 5, 'kaju-strabery1-640x640.jpg', 'Kaju Strawberry is similar to regular kaju katli, but is given an exotic twist with the inclusion of a strawberry filling. Strawberries are rich in vitamins, and help prevent cancer. The buttery cashew nuts are given a tangy boost from these fruits, thereby increasing its appeal.'),
(43, 'Champakali', 1, 6, 'champakali-sweets-500x500.jpg', 'Champakali -A crispy savory beautiful shaped snack made with refined flour and few spices.It is rolled and then shaped in a form of a flower bud which opens while frying.It is many interesting names in different Indian States.'),
(44, 'Cham Cham', 1, 6, 'cham-cham-500x500.jpg', 'Cham Cham is a Bengali sweet made by curdling milk and then shaping the coagulated solids to cylindrical shape pieces.'),
(45, 'Angoor Dana', 1, 6, 'angoor dana.jpg', 'Angoor Dana is a sweet boondi made from urad dal which is made on the occasion of Eid.'),
(46, 'Malai Sandwich', 1, 6, 'malai-sandwich-malai-bengalisweet-rasmalai-cake-crust.png', 'Malai Sandwich is a famous Bengali sweet-dish recipe made from milk, paneer and khoya. This easy dessert recipe is popular during festivals like Durga Puja and Rakshabandhan.'),
(47, 'Rasmalai', 1, 6, 'rusmalie.jpg', 'Rasmalai is basically a creamy and milky syrup that consist of Chenna (cottage cheese) balls. The syrup is purely made from milk, sugar, cream and saffron mixture.'),
(79, 'Dry Fruit Barfi', 1, 2, 'dry-fruit-barfi-namkeen.jpg', 'The Dry Fruit Barfi is a delicious quick sweet made from figs, dates, pistachios, almonds, cashew nuts and walnuts. The recipe to make the dry fruit barfi is quick and easy and makes it a perfect sweet for Diwali or even as a healthy snack for kids.'),
(49, 'Badam Milk', 1, 6, 'Badam milk.jpg', 'Badam Milk is an Indian milk beverage flavored with almonds, cardamom &amp; saffron. Traditionally it was made by soaking, blending and then adding it to boiled cow milk.'),
(50, 'Mota Sev', 2, 7, 'mota-seve-namkeen.jpg', 'This Mota Sev is Vegetarian Product and Jain Food.'),
(51, 'Barik Sev', 2, 7, 'baarik-sev-namkeen.jpg', 'Barik Sev is a tasty snack, made out of besan flour crispy and crunchy texture. It has zero cholesterol value.'),
(52, 'Bombay Mix', 2, 7, 'Bombay mix.jpg', 'Bombay Mix or chivda is an Indian snack mix (namkeen) which consists of a variable mixture of spicy dried ingredients, such as fried lentils, peanuts, chickpea flour ghatia (sev), corn, vegetable oil, chickpeas, flaked rice, fried onion and curry leaves.'),
(53, 'Agra Mix', 2, 7, 'Agra mix.jpg', 'It is agra based famous mixture namkeen named as agra mix, it contains makhana, aloo kalaccha and peanut with different sev and mathri. It can be a part of your tea/hard drink/soft drink.'),
(54, 'Navratna Mix', 2, 7, 'navratna-mix-namkeen.jpg', 'Navratna is a delicious, hot and spicy blend of savoury noodles, lentils, peanuts, puffed rice and sun dried potato chips. With zero cholesterol, this mix of ingredients make for a hearty and healthy treat to binge on!.'),
(55, 'Special Agra', 2, 7, 'spl-agra-namkeen.jpg', 'Special Agra Mix is a flavourful mixture of different items that contain all the flavours that will please your palate. It has a huge list of ingredients like gram flour, flattened rice, groundnut, roasted Bengal gram, cashew nuts, groundnut oil, vegetable oil, hydrogenated vegetable oil, spices, salt, chili powder, asafoetida, curry leaves, and turmeric powder.'),
(56, 'Spl Chivda', 2, 9, 'special-chuda-namkeen.jpg', 'Spl Chivda is a Indian snack mix made with flattened rice also known as poha,spices,curry leaves and nuts.It can be made with cornflakes,cereals,rolled oats or even with makhana.'),
(57, 'Sabudana Chivda', 2, 9, 'sabudana-chiwda-recipe-1-1.jpg', 'Sabudana Chivda is a crispy and tasty snack recipe of sabudana or tapioca pearls for the Navratri fasting season.'),
(58, 'Aloo Chivda', 2, 9, 'aloo chivada.jpg', 'Aloo Chivda is prepared as a sweet, sour and spicy snack with the help of potatoes and nuts which makes it a perfect phalhari snackâ€¦ it can also be served as a teatime snack.'),
(59, 'Masala Shenga', 2, 8, 'masala-shenga-namkken.jpg', 'Masala peanuts are prepared using peanuts, gram flour, red chili powder, salt, turmeric powder and asafoetida. These deep fried masala or spicy peanuts are familiar by name kara kalde or masale kadlekai in Kannada. Masala peanuts are very popular tea time snacks from Indian state of Karnataka.'),
(60, 'Atta Shenga', 2, 8, 'atta shenga -300x300.png', 'Peanut, (Arachis hypogaea), also called groundnut, earthnut, or goober, legume of the pea family (Fabaceae), grown for its edible seeds.'),
(61, 'Gathiya', 2, 10, 'ghati-namkeen.jpg', 'Ganthiya, gathiya or gathia are deep fried Indian snacks made from chickpea flour. Along with Khakra, Fafda, Dhokla, and Khandvi (among others), they are among the most popular snacks originating from the Indian State of Gujarat. They are a popular teatime snack not only in Gujarat but across India.'),
(62, 'Palak Gathiya', 2, 10, 'paalak-ghati-namkeen-500x500.jpg', 'Palak Gathiya is made from palak puree to make it healthy and gave a little twist it can be have with tea or coffee.'),
(63, 'Masala Gathiya', 2, 10, 'masala-namkee-gatiya.jpg', 'It is one type of gathiya which is crispy and spicy in taste.'),
(81, 'Dal', 2, 7, 'dal1-namkeen--260nw-1719974086.jpg', 'Dal is one type of sev.'),
(65, 'Bhavnagari Gathiya', 2, 10, 'bhavnagri-namkeen-500x500.jpg', 'Bhavnagari Gathiya is the tasty and nutritious snack that is prepared in extremely hygienic conditions using the handpicked ingredients. This gathiya is a savoury and it is taken along with tea, coffee, and drinks.'),
(66, 'Papdi', 2, 10, 'Salted-Papdi-Gujarati-Papdi.jg_.jpg', 'Papri chaat (or papdi chaat) is crispy fried-dough wafers served with typical chaat ingredients such as chickpeas, boiled potatoes, yogurt sauce, and tamarind and coriander chutneys; it may also contain pomegranate seeds and sev (noodles made from fried gram flour).'),
(67, 'Dry Samosa', 2, 11, 'dry-Samosa.jpg', 'Dry Samosa is a spicy and crispy triangles stuffed with dry mixture of crushed gathiya, spices and dry fruits. It is perfect light and tasty snack.This recipe uses coarse gathiya powder as base ingredient for flavorful stuffing.'),
(68, 'Masala Chips', 2, 11, 'masala-chips-500x500.jpg', 'Masala Chips are made from the perfect mix of spices along with premium potatoes . These are Non-greasy , Crispy and Perfect salt balance.'),
(69, 'Shankarpali', 2, 11, 'shakkarpara-shakkarpare-shakarpali-1957813-hero-01-c8fd3739c9ab4556880486c6f515e197.jpg', 'Shankarpali also known as Shakkar Para is a traditional Diwali Snack usually made during festivities like Diwali. This crunchy, flaky deep-fried snack is also a great tea time snack.'),
(70, 'Chakli', 2, 11, 'chakkali 1.jpg', 'It is a spiral shaped snack with a spiked surface. Chakli is typically made from flours of rice, bengal gram (brown chickpea) and black gram (urad daal). ... Murukku, a similar snack typically made without the Bengal gram flour, is also sometimes called &quot;chakli&quot;.'),
(71, 'Methi Vada', 2, 11, 'methi-wada-namkeen.jpg', 'Methi Vada or patties made from pearl millet flour, spices and herbs.'),
(72, 'Bhakarwadi', 2, 11, 'bhakarwadi.jpg', 'Bhakarwadi is made from gram flour dough made into spirals stuffed with a mixture of coconut, poppy seeds and sesame seeds. It is then fried until it gets crispy.'),
(73, 'Hachid Avalakki', 2, 11, 'hachhida awalakki.jpg', 'Hachid Avalakki is a super tasty breakfast/snack made from thin poha that can be had when we have unexpected guests. Bajil Avalakki coupled with upma is one of the most common dishes in marriage &amp; other functions.'),
(74, 'Kabuli Chana', 2, 11, 'kabul chana.jpg', 'Kabuli Chana is a staple combination meal in every Indian house. It is consumed with either rice or a chapati.'),
(75, 'Kara Boondi', 2, 11, 'Khara-Boondi.jpg', 'Kara Boondi is a crispy, crunchy and easy snack.Crunchy and munch snack perfect for evening along with a cup of hot Coffee / tea.'),
(76, 'Badam peda', 1, 2, 'badam pedha.jpg', 'Badam peda is a rich and milk fudge , a popular indian mithai. This recipe is a simple one that uses almonds and milk powder.'),
(78, 'Pista Barfi', 1, 2, 'pista burfi.jpg', 'Pista Barfi is a classic indian dessert recipe prepared with the combination of almonds and pistachio dry fruit powders. The recipe is very much inspired by the other popular barfi recipes like kaju katli or badam barfi recipe.'),
(80, 'Chivda', 2, 9, 'chivda-namkeen-500x500.jpg', 'Chivda is an excellent healthy treat as most of the ingredients are either dried or baked, and contain little to no oil or fat.'),
(82, 'Dal moth', 2, 7, 'dalmoth3-namkeen-500x500.jpg', 'Dal moth namkeen is a popular snack in north India. It is made with whole masoor dal that is fried and mixed with some electrifying spices, healthy nuts and crunchy sev.');

-- --------------------------------------------------------

--
-- Table structure for table `item_stock`
--

DROP TABLE IF EXISTS `item_stock`;
CREATE TABLE IF NOT EXISTS `item_stock` (
  `item_stockid` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_stockbatchno` varchar(200) NOT NULL,
  `item_stockquantity` int(11) NOT NULL,
  `item_stockinwarddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_stockcomments` varchar(500) NOT NULL,
  `item_stockdescription` varchar(500) NOT NULL,
  `item_stockcreatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_stockcreatedby` varchar(200) NOT NULL,
  `item_stockmodifiedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `item_stockmodifiedby` varchar(200) NOT NULL,
  PRIMARY KEY (`item_stockid`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_stock`
--

INSERT INTO `item_stock` (`item_stockid`, `item_id`, `item_stockbatchno`, `item_stockquantity`, `item_stockinwarddate`, `item_stockcomments`, `item_stockdescription`, `item_stockcreatedon`, `item_stockcreatedby`, `item_stockmodifiedon`, `item_stockmodifiedby`) VALUES
(28, 7, '5-6-2021-SAH130SOMBER ACACIA', 5, '2021-06-05 11:15:29', 'AAA', 'BBBB', '2021-06-05 11:15:29', 'info@acedecors.in', '2021-06-05 11:15:29', 'info@acedecors.in'),
(29, 9, '5-6-2021-SAH130SOMBER ACACIA', 3, '2021-06-05 11:17:48', '11', '111', '2021-06-05 11:17:48', 'info@acedecors.in', '2021-06-05 11:17:48', 'info@acedecors.in');

-- --------------------------------------------------------

--
-- Table structure for table `item_subcategory`
--

DROP TABLE IF EXISTS `item_subcategory`;
CREATE TABLE IF NOT EXISTS `item_subcategory` (
  `item_subcatid` int(11) NOT NULL AUTO_INCREMENT,
  `item_catid` int(11) NOT NULL,
  `item_subcatName` varchar(200) NOT NULL,
  `item_subcatDescription` varchar(100) NOT NULL,
  `item_subcatCreatedBy` varchar(200) NOT NULL,
  `item_subcatCreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_subcatModifiedBy` varchar(200) NOT NULL,
  `item_subcatModifiedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_subcatid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_subcategory`
--

INSERT INTO `item_subcategory` (`item_subcatid`, `item_catid`, `item_subcatName`, `item_subcatDescription`, `item_subcatCreatedBy`, `item_subcatCreatedOn`, `item_subcatModifiedBy`, `item_subcatModifiedon`) VALUES
(1, 1, 'Normal Sweets', 'It is one type of sweet Category.', 'ganeshsweets', '2021-08-27 16:11:36', 'ganeshsweets', '2021-08-27 16:11:36'),
(2, 1, 'Khawa Sweets', 'It is one type of sweet Category.', 'ganeshsweets', '2021-08-27 16:12:24', 'ganeshsweets', '2021-08-27 16:12:24'),
(3, 1, 'Milk Sweets', 'It is one type of sweet Category.', 'ganeshsweets', '2021-08-27 16:12:57', 'ganeshsweets', '2021-08-27 16:12:57'),
(4, 1, 'Ghee and Dry Fruits', 'It is one type of sweet Category.', 'ganeshsweets', '2021-08-27 16:13:54', 'ganeshsweets', '2021-08-27 16:13:54'),
(5, 1, 'Kaju Sweets', 'It is one type of sweet Category.', 'ganeshsweets', '2021-08-27 16:14:27', 'ganeshsweets', '2021-08-27 16:14:27'),
(6, 1, 'Bengali Sweets', 'It is one type of sweet Category.', 'ganeshsweets', '2021-08-27 16:14:49', 'ganeshsweets', '2021-08-27 16:14:49'),
(7, 2, 'Sev', 'It is one type of namkeen Category.', 'ganeshsweets', '2021-08-27 16:15:24', 'ganeshsweets', '2021-08-27 16:15:24'),
(8, 2, 'Shenga', 'It is one type of namkeen category.', 'ganeshsweets', '2021-08-27 16:15:55', 'ganeshsweets', '2021-08-27 16:15:55'),
(9, 2, 'Chivda', 'It is one type of namkeen Category.', 'ganeshsweets', '2021-08-27 16:17:16', 'ganeshsweets', '2021-08-27 16:17:16'),
(10, 2, 'Gathiya', 'It is one type of namkeen Category.', 'ganeshsweets', '2021-08-27 16:17:35', 'ganeshsweets', '2021-08-27 16:17:35'),
(11, 2, 'Snacks', 'It is one type of namkeen Category.', 'ganeshsweets', '2021-08-27 16:17:53', 'ganeshsweets', '2021-08-27 16:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `item_subcategorynum`
--

DROP TABLE IF EXISTS `item_subcategorynum`;
CREATE TABLE IF NOT EXISTS `item_subcategorynum` (
  `item_subcatid` int(200) NOT NULL AUTO_INCREMENT,
  `item_catid` int(200) NOT NULL,
  `item_subcatName` varchar(200) NOT NULL,
  `item_subcatDescription` varchar(200) NOT NULL,
  `item_subcatCreateBy` varchar(200) NOT NULL,
  `item_subcatCreatedOn` varchar(200) NOT NULL,
  `item_subcatModiedBy` varchar(200) NOT NULL,
  `item_subcatModifiedOn` varchar(200) NOT NULL,
  PRIMARY KEY (`item_subcatid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paymentinfo`
--

DROP TABLE IF EXISTS `paymentinfo`;
CREATE TABLE IF NOT EXISTS `paymentinfo` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `SOID` int(11) NOT NULL,
  `total_amount` int(100) NOT NULL,
  `paid_amount` int(100) NOT NULL,
  `received_amount` int(11) NOT NULL,
  `pending_amount` int(100) NOT NULL,
  `payment_plan` varchar(100) NOT NULL,
  `payment_mode` varchar(100) NOT NULL,
  `due_date` date DEFAULT NULL,
  `payment_description` varchar(100) NOT NULL,
  `pdfName` varchar(200) DEFAULT NULL,
  `modifieddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(100) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `customer_id` (`customer_id`),
  KEY `SOID` (`SOID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paymentinfo`
--

INSERT INTO `paymentinfo` (`payment_id`, `customer_id`, `SOID`, `total_amount`, `paid_amount`, `received_amount`, `pending_amount`, `payment_plan`, `payment_mode`, `due_date`, `payment_description`, `pdfName`, `modifieddate`, `modified_by`) VALUES
(9, 4, 16, 400000, 0, 0, 400000, '0', '0', NULL, '0', NULL, '2021-08-23 19:18:25', 'ganeshsweets');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) NOT NULL,
  `product_description` varchar(200) NOT NULL,
  `product_dimensions` varchar(100) NOT NULL,
  `product_dimensionsid` int(11) NOT NULL,
  `product_item` varchar(200) NOT NULL,
  `product_itemid` int(11) NOT NULL,
  `item_category` varchar(100) NOT NULL,
  `item_catid` int(11) NOT NULL,
  `item_subcategory` varchar(100) NOT NULL,
  `item_subcatid` int(11) NOT NULL,
  `product_brand` varchar(100) NOT NULL,
  `product_brandid` int(11) NOT NULL,
  `product_itemcode` int(20) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_categoryid` int(11) NOT NULL,
  `product_subcategory` varchar(100) NOT NULL,
  `product_subcategoryid` int(11) NOT NULL,
  `product_quantity` int(10) NOT NULL,
  `product_store` varchar(50) NOT NULL,
  `product_unit` varchar(100) NOT NULL,
  `product_unitid` int(11) NOT NULL,
  `product_barcode` varchar(100) NOT NULL,
  `productID` varchar(100) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `product_catid` int(11) NOT NULL AUTO_INCREMENT,
  `product_catName` varchar(200) NOT NULL,
  `product_catDescription` varchar(200) NOT NULL,
  `product_catCreatedby` varchar(200) NOT NULL,
  `product_catModifiedby` varchar(200) NOT NULL,
  `product_catCreatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_catmodifiedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_catid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_catid`, `product_catName`, `product_catDescription`, `product_catCreatedby`, `product_catModifiedby`, `product_catCreatedon`, `product_catmodifiedon`) VALUES
(1, 'Modular Kitchen', 'Cabinets For Kitchen', '', '', '2021-06-04 10:54:22', '2021-06-04 10:54:22'),
(2, 'Wardrobe', 'Cabinets For Bedroom', '', '', '2021-06-06 21:16:42', '2021-06-06 21:16:42'),
(3, '123', '345', '', '', '2021-06-07 06:46:16', '2021-06-07 06:46:16');

-- --------------------------------------------------------

--
-- Table structure for table `product_subcategory`
--

DROP TABLE IF EXISTS `product_subcategory`;
CREATE TABLE IF NOT EXISTS `product_subcategory` (
  `product_subcatid` int(11) NOT NULL AUTO_INCREMENT,
  `product_catid` int(11) DEFAULT NULL,
  `product_subcatName` varchar(200) NOT NULL,
  `product_subcatDescription` varchar(200) NOT NULL,
  `product_subcatCreatedby` varchar(100) NOT NULL,
  `product_subcatModifiedby` varchar(100) NOT NULL,
  `product_subcatCreatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_subcatModifiedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_subcatid`),
  KEY `product_catid` (`product_catid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_subcategory`
--

INSERT INTO `product_subcategory` (`product_subcatid`, `product_catid`, `product_subcatName`, `product_subcatDescription`, `product_subcatCreatedby`, `product_subcatModifiedby`, `product_subcatCreatedon`, `product_subcatModifiedon`) VALUES
(1, 1, 'Carcase', 'Cabinets', '', '', '2021-06-04 10:55:15', '2021-06-04 10:55:15');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_details`
--

DROP TABLE IF EXISTS `quotation_details`;
CREATE TABLE IF NOT EXISTS `quotation_details` (
  `quoid` int(11) NOT NULL AUTO_INCREMENT,
  `quo_enq_id` int(11) NOT NULL,
  `enqCatId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `quoteCode` varchar(100) NOT NULL,
  `quoteValue` decimal(10,2) DEFAULT NULL,
  `unitId` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `quoteDescription` varchar(500) DEFAULT NULL,
  `itemListName` varchar(200) DEFAULT NULL,
  `orderListName` varchar(200) DEFAULT NULL,
  `quo_type` enum('General','Bank') NOT NULL,
  `quo_pdf_name` varchar(100) DEFAULT NULL,
  `quo_createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quo_createdby` varchar(100) NOT NULL,
  `modifiedby` varchar(200) NOT NULL,
  `modifiedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `quo_status` enum('pending','rejected','Approved') NOT NULL DEFAULT 'pending',
  `quo_comments` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`quoid`),
  KEY `quo_enq_id` (`quo_enq_id`),
  KEY `customerId` (`customerId`),
  KEY `enqCatId` (`enqCatId`),
  KEY `unitId` (`unitId`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_details`
--

INSERT INTO `quotation_details` (`quoid`, `quo_enq_id`, `enqCatId`, `customerId`, `quoteCode`, `quoteValue`, `unitId`, `quantity`, `quoteDescription`, `itemListName`, `orderListName`, `quo_type`, `quo_pdf_name`, `quo_createdon`, `quo_createdby`, `modifiedby`, `modifiedon`, `quo_status`, `quo_comments`) VALUES
(5, 11, 0, 4, '', NULL, NULL, NULL, 'Modular Kitchen', '', '', 'General', '', '2021-06-05 02:23:29', 'info@acedecors.in', '', '2021-06-10 10:47:45', 'pending', ''),
(6, 11, 0, 4, '', NULL, NULL, NULL, '', '', '', 'Bank', '', '2021-06-07 06:59:34', '', '', '2021-06-10 10:30:01', 'pending', ''),
(10, 12, 0, 5, '', NULL, NULL, NULL, '', '', '', 'General', '', '2021-06-10 05:25:50', '', '', '2021-06-10 05:27:35', 'Approved', ''),
(11, 13, 0, 6, '', NULL, NULL, NULL, '', '', '', 'General', '', '2021-06-10 05:30:10', '', '', '2021-06-10 10:42:01', 'rejected', 'Did not like the design.'),
(12, 11, 0, 4, '', NULL, NULL, NULL, '', '', '', 'General', '', '2021-06-10 10:19:41', '', '', '2021-06-10 10:19:41', 'pending', ''),
(19, 56, 82, 14, 'AS14-MW-01', '20000000.00', 55, 100, 'Some description about the project', 'AD-202106-AS14AS14-MW-01.pdf', '', 'General', 'AD-202106-AS14_PROFORMA_Invoice.pdf', '2021-06-24 07:40:53', 'info@acedecors.in', 'info@acedecors.in', '2021-06-25 00:20:08', 'pending', ''),
(20, 57, 82, 16, 'MZS16-MW-01', '12345.00', NULL, NULL, '', '', '', 'General', 'AD--MZS16_PROFORMA_Invoice.pdf', '2021-07-07 06:08:00', 'info@acedecors.in', 'info@acedecors.in', '2021-07-07 06:09:46', 'pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `quotelineitem`
--

DROP TABLE IF EXISTS `quotelineitem`;
CREATE TABLE IF NOT EXISTS `quotelineitem` (
  `lineItemId` int(11) NOT NULL AUTO_INCREMENT,
  `quoteId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `item_catid` int(20) NOT NULL,
  `item_subcatid` int(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `totalAmount` decimal(10,2) NOT NULL,
  `discount1` decimal(10,2) DEFAULT NULL,
  `discount1Amt` decimal(10,2) DEFAULT NULL,
  `discount2` decimal(10,2) DEFAULT NULL,
  `discount2Amt` decimal(10,2) DEFAULT NULL,
  `GSTAmount` decimal(10,2) NOT NULL,
  `GST` decimal(10,2) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `billedAmount` decimal(10,2) DEFAULT NULL,
  `createdby` varchar(200) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedby` varchar(200) NOT NULL,
  `modifiedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`lineItemId`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotelineitem`
--

INSERT INTO `quotelineitem` (`lineItemId`, `quoteId`, `itemId`, `item_catid`, `item_subcatid`, `quantity`, `amount`, `totalAmount`, `discount1`, `discount1Amt`, `discount2`, `discount2Amt`, `GSTAmount`, `GST`, `totalPrice`, `billedAmount`, `createdby`, `createdon`, `modifiedby`, `modifiedon`) VALUES
(43, 12, 10, 0, 0, 2, '172.00', '172.00', '0.00', '0.00', '0.00', '0.00', '30.96', '18.00', '202.96', NULL, '', '2021-06-10 10:19:41', '', '2021-06-10 10:19:41'),
(7, 5, 7, 0, 0, 15, '62.55', '62.55', '10.00', '37.53', '1.00', '37.15', '11.26', '18.00', '73.81', NULL, 'info@acedecors.in', '2021-06-05 02:23:29', 'info@acedecors.in', '2021-06-05 02:23:29'),
(8, 5, 7, 0, 0, 15, '62.55', '62.55', '10.00', '37.53', '1.00', '37.15', '11.26', '18.00', '73.81', NULL, 'info@acedecors.in', '2021-06-05 02:23:29', 'info@acedecors.in', '2021-06-05 02:23:29'),
(9, 6, 9, 0, 0, 15, '4608.00', '4608.00', '10.00', '0.00', '0.00', '0.00', '829.44', '18.00', '5437.44', NULL, '', '2021-06-07 06:59:34', '', '2021-06-07 06:59:34'),
(10, 6, 9, 0, 0, 15, '4608.00', '4608.00', '10.00', '0.00', '0.00', '0.00', '829.44', '18.00', '5437.44', NULL, '', '2021-06-07 06:59:34', '', '2021-06-07 06:59:34'),
(11, 6, 9, 0, 0, 15, '4608.00', '4608.00', '10.00', '4147.20', '1.00', '4105.73', '739.03', '18.00', '4844.76', NULL, '', '2021-06-07 06:59:34', '', '2021-06-07 06:59:34'),
(42, 12, 7, 0, 0, 10, '60.00', '60.00', '10.00', '54.00', '10.00', '48.60', '8.75', '18.00', '57.35', NULL, '', '2021-06-10 10:19:41', '', '2021-06-10 10:19:41'),
(39, 10, 11, 0, 0, 15, '5625.00', '5625.00', '0.00', '0.00', '0.00', '0.00', '1012.50', '18.00', '6637.50', NULL, '', '2021-06-10 05:25:50', '', '2021-06-10 05:25:50'),
(40, 10, 10, 0, 0, 64, '5504.00', '5504.00', '0.00', '0.00', '0.00', '0.00', '990.72', '18.00', '6494.72', NULL, '', '2021-06-10 05:25:50', '', '2021-06-10 05:25:50'),
(41, 11, 7, 0, 0, 15, '90.00', '90.00', '0.00', '0.00', '0.00', '0.00', '16.20', '18.00', '106.20', NULL, '', '2021-06-10 05:30:10', '', '2021-06-10 05:30:10'),
(80, 19, 11, 0, 0, 1500, '562500.00', '562500.00', '10.00', '506250.00', '10.00', '455625.00', '82012.50', '18.00', '537637.50', NULL, 'info@acedecors.in', '2021-06-24 07:40:53', 'info@acedecors.in', '2021-06-24 07:40:53'),
(81, 19, 11, 0, 0, 1500, '562500.00', '562500.00', '10.00', '506250.00', '10.00', '455625.00', '82012.50', '18.00', '537637.50', NULL, 'info@acedecors.in', '2021-06-24 07:40:53', 'info@acedecors.in', '2021-06-24 07:40:53'),
(82, 19, 11, 0, 0, 1500, '562500.00', '562500.00', '10.00', '506250.00', '10.00', '455625.00', '82012.50', '18.00', '537637.50', NULL, 'info@acedecors.in', '2021-06-24 07:40:53', 'info@acedecors.in', '2021-06-24 07:40:53'),
(83, 19, 11, 0, 0, 1500, '562500.00', '562500.00', '10.00', '506250.00', '10.00', '455625.00', '82012.50', '18.00', '537637.50', NULL, 'info@acedecors.in', '2021-06-24 07:40:53', 'info@acedecors.in', '2021-06-24 07:40:53'),
(84, 19, 11, 0, 0, 1500, '562500.00', '562500.00', '10.00', '506250.00', '10.00', '455625.00', '82012.50', '18.00', '537637.50', NULL, 'info@acedecors.in', '2021-06-24 07:40:53', 'info@acedecors.in', '2021-06-24 07:40:53'),
(85, 19, 7, 0, 0, 15, '90.00', '90.00', '10.00', '81.00', '10.00', '72.90', '13.12', '18.00', '86.02', NULL, 'info@acedecors.in', '2021-06-24 07:40:53', 'info@acedecors.in', '2021-06-24 07:40:53'),
(86, 19, 7, 0, 0, 15, '90.00', '90.00', '10.00', '81.00', '10.00', '72.90', '13.12', '18.00', '86.02', NULL, 'info@acedecors.in', '2021-06-24 07:40:53', 'info@acedecors.in', '2021-06-24 07:40:53'),
(87, 20, 10, 0, 0, 100, '275200.00', '275200.00', '0.00', '0.00', '0.00', '0.00', '49536.00', '18.00', '324736.00', NULL, 'info@acedecors.in', '2021-07-07 06:08:00', 'info@acedecors.in', '2021-07-07 06:08:00'),
(88, 20, 10, 0, 0, 100, '275200.00', '275200.00', '0.00', '0.00', '0.00', '0.00', '49536.00', '18.00', '324736.00', NULL, 'info@acedecors.in', '2021-07-07 06:08:00', 'info@acedecors.in', '2021-07-07 06:08:00'),
(89, 20, 10, 0, 0, 100, '275200.00', '275200.00', '0.00', '0.00', '0.00', '0.00', '49536.00', '18.00', '324736.00', NULL, 'info@acedecors.in', '2021-07-07 06:08:00', 'info@acedecors.in', '2021-07-07 06:08:00'),
(90, 20, 10, 0, 0, 100, '275200.00', '275200.00', '0.00', '0.00', '0.00', '0.00', '49536.00', '18.00', '324736.00', NULL, 'info@acedecors.in', '2021-07-07 06:08:00', 'info@acedecors.in', '2021-07-07 06:08:00'),
(91, 5, 11, 52, 38, 10, '7500.00', '7500.00', '10.00', '6750.00', '2.00', '6615.00', '1190.70', '18.00', '7805.70', NULL, 'info@acedecors.in', '2021-07-24 16:25:27', 'info@acedecors.in', '2021-07-24 16:25:27'),
(92, 5, 10, 51, 39, 10, '27520.00', '27520.00', '10.00', '24768.00', '4.00', '23777.28', '4279.91', '18.00', '28057.19', NULL, 'info@acedecors.in', '2021-07-24 16:42:36', 'info@acedecors.in', '2021-07-24 16:42:36');

-- --------------------------------------------------------

--
-- Table structure for table `salesorder_lineitem`
--

DROP TABLE IF EXISTS `salesorder_lineitem`;
CREATE TABLE IF NOT EXISTS `salesorder_lineitem` (
  `SOlineitemId` int(11) NOT NULL AUTO_INCREMENT,
  `SOID` int(11) DEFAULT NULL,
  `Item_id` int(11) DEFAULT NULL,
  `Quantity` int(20) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `Price` int(20) NOT NULL,
  `TotalAmt` int(20) NOT NULL,
  `GST` varchar(50) NOT NULL,
  `Modified_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`SOlineitemId`),
  KEY `Item_id` (`Item_id`),
  KEY `POID` (`SOID`),
  KEY `unit_id` (`unit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesorder_lineitem`
--

INSERT INTO `salesorder_lineitem` (`SOlineitemId`, `SOID`, `Item_id`, `Quantity`, `unit_id`, `Price`, `TotalAmt`, `GST`, `Modified_Date`) VALUES
(21, 13, 9, 20, 1, 400, 8000, '', '2021-08-21 11:17:26'),
(20, 13, 53, 20, 1, 1234, 8000, '', '2021-08-21 11:17:26'),
(19, 12, 58, 20, 1, 400, 0, '', '2021-08-19 18:55:47'),
(18, 11, 54, 50, 1, 1234, 61700, '', '2021-08-19 18:45:14'),
(17, 11, 53, 10, 1, 400, 61700, '', '2021-08-19 18:45:14'),
(22, 13, 11, 20, 1, 400, 8000, '', '2021-08-21 11:17:26'),
(23, 14, 57, 20, 1, 400, 8000, '', '2021-08-21 11:35:36'),
(24, 14, 57, 20, 1, 400, 8000, '', '2021-08-21 11:35:36'),
(25, 14, 57, 20, 1, 400, 8000, '', '2021-08-21 11:35:36'),
(26, 14, 57, 20, 1, 400, 8000, '', '2021-08-21 11:35:36'),
(27, 14, 57, 20, 1, 400, 8000, '', '2021-08-21 11:35:36'),
(28, 14, 57, 20, 1, 400, 8000, '', '2021-08-21 11:35:36'),
(29, 14, 57, 20, 1, 400, 8000, '', '2021-08-21 11:35:36'),
(30, 14, 57, 20, 1, 400, 8000, '', '2021-08-21 11:35:36'),
(31, 14, 57, 20, 1, 400, 8000, '', '2021-08-21 11:35:36'),
(32, 14, 57, 20, 1, 400, 8000, '', '2021-08-21 11:35:36'),
(33, 14, 57, 20, 1, 400, 8000, '', '2021-08-21 11:35:36'),
(34, 14, 57, 20, 1, 400, 8000, '', '2021-08-21 11:35:36'),
(35, 15, 32, 200, 1, 2000, 400000, '', '2021-08-23 11:47:57'),
(36, 16, 52, 200, 1, 2000, 400000, '', '2021-08-23 19:18:25'),
(37, 16, 53, 200, 1, 2000, 400000, '', '2021-08-23 19:18:25'),
(38, 16, 62, 200, 1, 2000, 400000, '', '2021-08-23 19:18:25'),
(39, 17, 2, 7, 1, 1000, 7000, '', '2021-08-28 18:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

DROP TABLE IF EXISTS `sales_order`;
CREATE TABLE IF NOT EXISTS `sales_order` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `SOcode` varchar(20) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `Item_id` int(11) NOT NULL,
  `SalesDate` datetime NOT NULL,
  `TotalAmt` int(100) NOT NULL,
  `PendingAmt` int(100) NOT NULL,
  `salesPDFName` varchar(100) DEFAULT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `SupplierId` (`CustomerId`),
  KEY `Item_id` (`Item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`Id`, `SOcode`, `CustomerId`, `Item_id`, `SalesDate`, `TotalAmt`, `PendingAmt`, `salesPDFName`, `createdon`, `Modified_date`) VALUES
(12, 'GS-202108-AS12', 4, 58, '2021-08-19 00:00:00', 0, 0, NULL, '2021-08-19 18:55:47', '2021-08-19 18:55:47'),
(11, 'GS-202108-AS11', 4, 53, '2021-08-19 00:00:00', 61700, 61700, NULL, '2021-08-19 18:45:14', '2021-08-19 18:45:14'),
(13, 'GS-202108-AS13', 4, 53, '2021-08-21 00:00:00', 8000, 8000, ' GS-202108-AS13_SO.pdf', '2021-08-21 11:17:26', '2021-08-21 11:22:31'),
(14, 'GS-202108-AS14', 4, 57, '2021-08-21 00:00:00', 8000, 8000, ' GS-202108-AS14_SO.pdf', '2021-08-21 11:35:36', '2021-08-21 11:36:14'),
(16, 'GS-202108-AS-SO16', 4, 52, '2021-08-23 00:00:00', 400000, 400000, 'GS-202108-AS-SO16_SO.pdf', '2021-08-23 19:18:24', '2021-08-23 19:21:51'),
(17, 'GS-202108-A-SO17', 5, 2, '2021-08-28 00:00:00', 7000, 7000, 'GS-202108-A-SO17.pdf', '2021-08-28 18:25:51', '2021-08-28 18:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `suppliercontactdetails`
--

DROP TABLE IF EXISTS `suppliercontactdetails`;
CREATE TABLE IF NOT EXISTS `suppliercontactdetails` (
  `contactId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `supplierId` int(11) NOT NULL,
  `emailId` varchar(200) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `createdby` varchar(200) NOT NULL,
  `modifiedby` varchar(200) NOT NULL,
  `modifiedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`contactId`),
  KEY `supplierId` (`supplierId`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliercontactdetails`
--

INSERT INTO `suppliercontactdetails` (`contactId`, `name`, `supplierId`, `emailId`, `designation`, `phone`, `createdby`, `modifiedby`, `modifiedon`, `createdon`) VALUES
(9, 'Shashi', 21, 'shashi@gmail.com', 'Sales', '9999999999', 'info@acedecors.in', 'info@acedecors.in', '2021-06-11 22:53:33', '2021-06-11 22:53:33'),
(6, 'Athar Shaikh', 22, 'atharshaikh1@gmail.com', 'Manager', '8007961759', 'ACE DECORS', 'ACE DECORS', '2021-06-11 02:20:26', '2021-06-11 02:20:26'),
(8, 'Reyaz', 21, 'ajayh@gmail.com', 'ASM', '9888888888', 'info@acedecors.in', 'info@acedecors.in', '2021-06-11 22:52:48', '2021-06-11 22:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_brand_mapping`
--

DROP TABLE IF EXISTS `supplier_brand_mapping`;
CREATE TABLE IF NOT EXISTS `supplier_brand_mapping` (
  `supplierId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `createdby` varchar(200) NOT NULL,
  `modifiedby` varchar(200) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_brand_mapping`
--

INSERT INTO `supplier_brand_mapping` (`supplierId`, `brandId`, `createdby`, `modifiedby`, `createdon`, `modifiedon`) VALUES
(20, 9, '', '', '2021-06-05 00:16:06', '2021-06-05 00:16:06'),
(22, 11, '', '', '2021-06-05 03:05:36', '2021-06-05 03:05:36'),
(21, 8, '', '', '2021-06-05 02:15:39', '2021-06-05 02:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `tax_table`
--

DROP TABLE IF EXISTS `tax_table`;
CREATE TABLE IF NOT EXISTS `tax_table` (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `GST` decimal(4,2) NOT NULL,
  `SGST` decimal(4,2) DEFAULT NULL,
  `CGST` decimal(4,2) DEFAULT NULL,
  `IGST` decimal(4,2) DEFAULT NULL,
  `Modified_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Created_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Created_By` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Modified_By` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`tax_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `unitId` int(11) NOT NULL AUTO_INCREMENT,
  `unitName` varchar(200) NOT NULL,
  `unitDescription` varchar(500) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` varchar(200) NOT NULL,
  `modifiedOn` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` varchar(200) NOT NULL,
  PRIMARY KEY (`unitId`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unitId`, `unitName`, `unitDescription`, `createdOn`, `createdBy`, `modifiedOn`, `modifiedBy`) VALUES
(1, 'KG', 'kilogram', '2021-08-05 14:15:21', 'ganeshsweets', '2021-08-05 14:15:21', 'ganeshsweets'),
(2, 'GRAM', 'Grams', '2021-08-05 14:15:41', 'ganeshsweets', '2021-08-05 14:15:41', 'ganeshsweets'),
(11, 'KG2', 'hfjdgf', '2021-08-27 11:54:48', 'ganeshsweets', '2021-08-27 11:55:02', 'ganeshsweets');

-- --------------------------------------------------------

--
-- Table structure for table `unitsfactor`
--

DROP TABLE IF EXISTS `unitsfactor`;
CREATE TABLE IF NOT EXISTS `unitsfactor` (
  `unitFactorId` int(11) NOT NULL AUTO_INCREMENT,
  `unitId` int(11) NOT NULL,
  `unitFactor` decimal(11,0) NOT NULL,
  `unitFactorDescription` varchar(500) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` varchar(200) NOT NULL,
  `modifiedOn` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` varchar(200) NOT NULL,
  PRIMARY KEY (`unitFactorId`),
  KEY `unitId` (`unitId`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unitsfactor`
--

INSERT INTO `unitsfactor` (`unitFactorId`, `unitId`, `unitFactor`, `unitFactorDescription`, `createdOn`, `createdBy`, `modifiedOn`, `modifiedBy`) VALUES
(1, 1, '1', '1 kg=1 unit factor', '2021-08-05 14:16:58', 'ganeshsweets', '2021-08-05 14:16:58', 'ganeshsweets'),
(3, 6, '2', '1 kg = 3 unit', '2021-08-25 12:01:03', 'ganeshsweets', '2021-08-25 12:01:24', 'ganeshsweets'),
(4, 6, '1', '1 kg = 1 unit', '2021-08-25 12:30:00', 'ganeshsweets', '2021-08-25 12:30:00', 'ganeshsweets'),
(8, 7, '1', '1 kg = 1 unit factor', '2021-08-25 16:51:48', 'ganeshsweets', '2021-08-25 16:52:17', 'ganeshsweets');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(12) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(250) NOT NULL,
  `user_contact` varchar(15) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_type` enum('Admin','Manager') NOT NULL,
  `user_status` enum('Enable','Disable') NOT NULL,
  `user_created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_contact`, `user_email`, `user_password`, `user_type`, `user_status`, `user_created_on`, `ModifiedDate`) VALUES
(2, 'ganeshsweets', '9742367112', 'ganeshsweets@gmail.com', '12345678', 'Admin', 'Enable', '2021-05-01 18:47:39', '2021-08-14 11:21:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
