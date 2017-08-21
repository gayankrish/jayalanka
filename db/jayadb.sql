-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2017 at 01:41 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jayadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address1` varchar(150) NOT NULL,
  `address2` varchar(150) NOT NULL,
  `city` varchar(20) NOT NULL,
  `country_id` int(3) NOT NULL,
  `contact_nos` varchar(100) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `tax_rate` decimal(4,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`id`, `name`, `email`, `address1`, `address2`, `city`, `country_id`, `contact_nos`, `fax`, `tax_rate`) VALUES
(1, 'BusinessName', 'business@email.com', 'Address line 1', 'Address line 2', 'City', 209, '+94112345678|+94112987654', '+94112123123', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `calculation_method`
--

CREATE TABLE `calculation_method` (
  `id` int(11) NOT NULL,
  `description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chain_type`
--

CREATE TABLE `chain_type` (
  `id` int(11) NOT NULL,
  `chain_type` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chain_type`
--

INSERT INTO `chain_type` (`id`, `chain_type`, `description`) VALUES
(1, 'hotel', 'Chain Type A'),
(2, 'hotel', 'Chain Type B'),
(3, 'hotel', 'Chain Type C');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `color` varchar(20) NOT NULL,
  `rgb_value` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `country_name` varchar(50) NOT NULL,
  `iso2_code` varchar(2) NOT NULL,
  `iso3_code` varchar(3) NOT NULL,
  `iso_numeric_code` varchar(3) NOT NULL,
  `calling_code` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `iso2_code`, `iso3_code`, `iso_numeric_code`, `calling_code`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', '004', '0093'),
(2, 'Aland Islands', 'AX', 'ALA', '248', '0358'),
(3, 'Albania', 'AL', 'ALB', '008', '0355'),
(4, 'Algeria', 'DZ', 'DZA', '012', '0213'),
(5, 'American Samoa', 'AS', 'ASM', '016', '1684'),
(6, 'Andorra', 'AD', 'AND', '020', '0376'),
(7, 'Angola', 'AO', 'AGO', '024', '0244'),
(8, 'Anguilla', 'AI', 'AIA', '660', '1264'),
(9, 'Antarctica', 'AQ', 'ATA', '010', '000'),
(10, 'Antigua and Barbuda', 'AG', 'ATG', '028', '1268'),
(11, 'Argentina', 'AR', 'ARG', '032', '0054'),
(12, 'Armenia', 'AM', 'ARM', '051', '0374'),
(13, 'Aruba', 'AW', 'ABW', '533', '0297'),
(14, 'Australia', 'AU', 'AUS', '036', '0061'),
(15, 'Austria', 'AT', 'AUT', '040', '0043'),
(16, 'Azerbaijan', 'AZ', 'AZE', '031', '0994'),
(17, 'Bahamas', 'BS', 'BHS', '044', '1242'),
(18, 'Bahrain', 'BH', 'BHR', '048', '0973'),
(19, 'Bangladesh', 'BD', 'BGD', '050', '0880'),
(20, 'Barbados', 'BB', 'BRB', '052', '1246'),
(21, 'Belarus', 'BY', 'BLR', '112', '0375'),
(22, 'Belgium', 'BE', 'BEL', '056', '0032'),
(23, 'Belize', 'BZ', 'BLZ', '084', '0501'),
(24, 'Benin', 'BJ', 'BEN', '204', '0229'),
(25, 'Bermuda', 'BM', 'BMU', '060', '1441'),
(26, 'Bhutan', 'BT', 'BTN', '064', '0975'),
(27, 'Bolivia', 'BO', 'BOL', '068', '0591'),
(28, 'Bosnia and Herzegovina', 'BA', 'BIH', '070', '0387'),
(29, 'Botswana', 'BW', 'BWA', '072', '0267'),
(30, 'Bouvet Island', 'BV', 'BVT', '074', '000'),
(31, 'Brazil', 'BR', 'BRA', '076', '0055'),
(32, 'British Virgin Islands', 'VG', 'VGB', '092', '0246'),
(33, 'British Indian Ocean Territory', 'IO', 'IOT', '086', '0673'),
(34, 'Brunei Darussalam', 'BN', 'BRN', '096', '0359'),
(35, 'Bulgaria', 'BG', 'BGR', '100', '0226'),
(36, 'Burkina Faso', 'BF', 'BFA', '854', '0257'),
(37, 'Burundi', 'BI', 'BDI', '108', '0855'),
(38, 'Cambodia', 'KH', 'KHM', '116', '0237'),
(39, 'Cameroon', 'CM', 'CMR', '120', '0001'),
(40, 'Canada', 'CA', 'CAN', '124', '0238'),
(41, 'Cape Verde', 'CV', 'CPV', '132', '1345'),
(42, 'Cayman Islands ', 'KY', 'CYM', '136', '0236'),
(43, 'Central African Republic', 'CF', 'CAF', '140', '0235'),
(44, 'Chad', 'TD', 'TCD', '148', '0056'),
(45, 'Chile', 'CL', 'CHL', '152', '0086'),
(46, 'China', 'CN', 'CHN', '156', '0061'),
(47, 'Hong Kong, SAR China', 'HK', 'HKG', '344', '0672'),
(48, 'Macao, SAR China', 'MO', 'MAC', '446', '0057'),
(49, 'Christmas Island', 'CX', 'CXR', '162', '0269'),
(50, 'Cocos (Keeling) Islands', 'CC', 'CCK', '166', '0242'),
(51, 'Colombia', 'CO', 'COL', '170', '0242'),
(52, 'Comoros', 'KM', 'COM', '174', '0682'),
(53, 'Congo (Brazzaville)', 'CG', 'COG', '178', '0506'),
(54, 'Congo, (Kinshasa)', 'CD', 'COD', '180', '0225'),
(55, 'Cook Islands ', 'CK', 'COK', '184', '0385'),
(56, 'Costa Rica', 'CR', 'CRI', '188', '0053'),
(57, 'Côte d\'Ivoire', 'CI', 'CIV', '384', '0357'),
(58, 'Croatia', 'HR', 'HRV', '191', '0420'),
(59, 'Cuba', 'CU', 'CUB', '192', '0045'),
(60, 'Cyprus', 'CY', 'CYP', '196', '0253'),
(61, 'Czech Republic', 'CZ', 'CZE', '203', '1767'),
(62, 'Denmark', 'DK', 'DNK', '208', '1809'),
(63, 'Djibouti', 'DJ', 'DJI', '262', '0670'),
(64, 'Dominica', 'DM', 'DMA', '212', '0593'),
(65, 'Dominican Republic', 'DO', 'DOM', '214', '0020'),
(66, 'Ecuador', 'EC', 'ECU', '218', '0503'),
(67, 'Egypt', 'EG', 'EGY', '818', '0240'),
(68, 'El Salvador', 'SV', 'SLV', '222', '0291'),
(69, 'Equatorial Guinea', 'GQ', 'GNQ', '226', '0372'),
(70, 'Eritrea', 'ER', 'ERI', '232', '0251'),
(71, 'Estonia', 'EE', 'EST', '233', '0061'),
(72, 'Ethiopia', 'ET', 'ETH', '231', '0500'),
(73, 'Falkland Islands (Malvinas) ', 'FK', 'FLK', '238', '0298'),
(74, 'Faroe Islands', 'FO', 'FRO', '234', '0679'),
(75, 'Fiji', 'FJ', 'FJI', '242', '0358'),
(76, 'Finland', 'FI', 'FIN', '246', '0033'),
(77, 'France', 'FR', 'FRA', '250', '0594'),
(78, 'French Guiana', 'GF', 'GUF', '254', '0689'),
(79, 'French Polynesia', 'PF', 'PYF', '258', '000'),
(80, 'French Southern Territories', 'TF', 'ATF', '260', '0241'),
(81, 'Gabon', 'GA', 'GAB', '266', '0220'),
(82, 'Gambia', 'GM', 'GMB', '270', '0995'),
(83, 'Georgia', 'GE', 'GEO', '268', '0049'),
(84, 'Germany', 'DE', 'DEU', '276', '0233'),
(85, 'Ghana', 'GH', 'GHA', '288', '0350'),
(86, 'Gibraltar ', 'GI', 'GIB', '292', '0030'),
(87, 'Greece', 'GR', 'GRC', '300', '0299'),
(88, 'Greenland', 'GL', 'GRL', '304', '1473'),
(89, 'Grenada', 'GD', 'GRD', '308', '0590'),
(90, 'Guadeloupe', 'GP', 'GLP', '312', '1671'),
(91, 'Guam', 'GU', 'GUM', '316', '0502'),
(92, 'Guatemala', 'GT', 'GTM', '320', '0044'),
(93, 'Guernsey', 'GG', 'GGY', '831', '0224'),
(94, 'Guinea', 'GN', 'GIN', '324', '0245'),
(95, 'Guinea-Bissau', 'GW', 'GNB', '624', '0592'),
(96, 'Guyana', 'GY', 'GUY', '328', '0509'),
(97, 'Haiti', 'HT', 'HTI', '332', '000'),
(98, 'Heard and Mcdonald Islands', 'HM', 'HMD', '334', '0504'),
(99, 'Holy See (Vatican City State)', 'VA', 'VAT', '336', '0852'),
(100, 'Honduras', 'HN', 'HND', '340', '0036'),
(101, 'Hungary', 'HU', 'HUN', '348', '0354'),
(102, 'Iceland', 'IS', 'ISL', '352', '0091'),
(103, 'India', 'IN', 'IND', '356', '0062'),
(104, 'Indonesia', 'ID', 'IDN', '360', '0098'),
(105, 'Iran, Islamic Republic of', 'IR', 'IRN', '364', '0964'),
(106, 'Iraq', 'IQ', 'IRQ', '368', '0353'),
(107, 'Ireland', 'IE', 'IRL', '372', '0972'),
(108, 'Isle of Man ', 'IM', 'IMN', '833', '0039'),
(109, 'Israel', 'IL', 'ISR', '376', '1876'),
(110, 'Italy', 'IT', 'ITA', '380', '0081'),
(111, 'Jamaica', 'JM', 'JAM', '388', '0044'),
(112, 'Japan', 'JP', 'JPN', '392', '0962'),
(113, 'Jersey', 'JE', 'JEY', '832', '0007'),
(114, 'Jordan', 'JO', 'JOR', '400', '0254'),
(115, 'Kazakhstan', 'KZ', 'KAZ', '398', '0686'),
(116, 'Kenya', 'KE', 'KEN', '404', '0850'),
(117, 'Kiribati', 'KI', 'KIR', '296', '0082'),
(118, 'Korea (North)', 'KP', 'PRK', '408', '0965'),
(119, 'Korea (South)', 'KR', 'KOR', '410', '0996'),
(120, 'Kuwait', 'KW', 'KWT', '414', '0856'),
(121, 'Kyrgyzstan', 'KG', 'KGZ', '417', '0371'),
(122, 'Lao PDR', 'LA', 'LAO', '418', '0961'),
(123, 'Latvia', 'LV', 'LVA', '428', '0266'),
(124, 'Lebanon', 'LB', 'LBN', '422', '0231'),
(125, 'Lesotho', 'LS', 'LSO', '426', '0218'),
(126, 'Liberia', 'LR', 'LBR', '430', '0423'),
(127, 'Libya', 'LY', 'LBY', '434', '0370'),
(128, 'Liechtenstein', 'LI', 'LIE', '438', '0352'),
(129, 'Lithuania', 'LT', 'LTU', '440', '0853'),
(130, 'Luxembourg', 'LU', 'LUX', '442', '0389'),
(131, 'Macedonia, Republic of', 'MK', 'MKD', '807', '0261'),
(132, 'Madagascar', 'MG', 'MDG', '450', '0265'),
(133, 'Malawi', 'MW', 'MWI', '454', '0060'),
(134, 'Malaysia', 'MY', 'MYS', '458', '0960'),
(135, 'Maldives', 'MV', 'MDV', '462', '0223'),
(136, 'Mali', 'ML', 'MLI', '466', '0356'),
(137, 'Malta', 'MT', 'MLT', '470', '0044'),
(138, 'Marshall Islands', 'MH', 'MHL', '584', '0692'),
(139, 'Martinique', 'MQ', 'MTQ', '474', '0596'),
(140, 'Mauritania', 'MR', 'MRT', '478', '0222'),
(141, 'Mauritius', 'MU', 'MUS', '480', '0230'),
(142, 'Mayotte', 'YT', 'MYT', '175', '0269'),
(143, 'Mexico', 'MX', 'MEX', '484', '0052'),
(144, 'Micronesia, Federated States of', 'FM', 'FSM', '583', '0691'),
(145, 'Moldova', 'MD', 'MDA', '498', '0373'),
(146, 'Monaco', 'MC', 'MCO', '492', '0377'),
(147, 'Mongolia', 'MN', 'MNG', '496', '0976'),
(148, 'Montenegro', 'ME', 'MNE', '499', '1664'),
(149, 'Montserrat', 'MS', 'MSR', '500', '0212'),
(150, 'Morocco', 'MA', 'MAR', '504', '0258'),
(151, 'Mozambique', 'MZ', 'MOZ', '508', '0095'),
(152, 'Myanmar', 'MM', 'MMR', '104', '0264'),
(153, 'Namibia', 'NA', 'NAM', '516', '0674'),
(154, 'Nauru', 'NR', 'NRU', '520', '0977'),
(155, 'Nepal', 'NP', 'NPL', '524', '0599'),
(156, 'Netherlands', 'NL', 'NLD', '528', '0031'),
(157, 'Netherlands Antilles', 'AN', 'ANT', '530', '0687'),
(158, 'New Caledonia', 'NC', 'NCL', '540', '0064'),
(159, 'New Zealand', 'NZ', 'NZL', '554', '0505'),
(160, 'Nicaragua', 'NI', 'NIC', '558', '0227'),
(161, 'Niger', 'NE', 'NER', '562', '0234'),
(162, 'Nigeria', 'NG', 'NGA', '566', '0683'),
(163, 'Niue ', 'NU', 'NIU', '570', '0672'),
(164, 'Norfolk Island', 'NF', 'NFK', '574', '1670'),
(165, 'Northern Mariana Islands', 'MP', 'MNP', '580', '0047'),
(166, 'Norway', 'NO', 'NOR', '578', '0968'),
(167, 'Oman', 'OM', 'OMN', '512', '0092'),
(168, 'Pakistan', 'PK', 'PAK', '586', '0680'),
(169, 'Palau', 'PW', 'PLW', '585', '0970'),
(170, 'Palestinian Territory', 'PS', 'PSE', '275', '0507'),
(171, 'Panama', 'PA', 'PAN', '591', '0675'),
(172, 'Papua New Guinea', 'PG', 'PNG', '598', '0595'),
(173, 'Paraguay', 'PY', 'PRY', '600', '0051'),
(174, 'Peru', 'PE', 'PER', '604', '0063'),
(175, 'Philippines', 'PH', 'PHL', '608', '000'),
(176, 'Pitcairn', 'PN', 'PCN', '612', '0048'),
(177, 'Poland', 'PL', 'POL', '616', '0351'),
(178, 'Portugal', 'PT', 'PRT', '620', '1787'),
(179, 'Puerto Rico', 'PR', 'PRI', '630', '0974'),
(180, 'Qatar', 'QA', 'QAT', '634', '0262'),
(181, 'RÃ©union', 'RE', 'REU', '638', '0040'),
(182, 'Romania', 'RO', 'ROU', '642', '0070'),
(183, 'Russian Federation', 'RU', 'RUS', '643', '0250'),
(184, 'Rwanda', 'RW', 'RWA', '646', '0290'),
(185, 'Saint-BarthÃ©lemy', 'BL', 'BLM', '652', '1869'),
(186, 'Saint Helena', 'SH', 'SHN', '654', '1758'),
(187, 'Saint Kitts and Nevis', 'KN', 'KNA', '659', '0508'),
(188, 'Saint Lucia', 'LC', 'LCA', '662', '1784'),
(189, 'Saint-Martin (French part)', 'MF', 'MAF', '663', '0684'),
(190, 'Saint Pierre and Miquelon ', 'PM', 'SPM', '666', '0378'),
(191, 'Saint Vincent and Grenadines', 'VC', 'VCT', '670', '0239'),
(192, 'Samoa', 'WS', 'WSM', '882', '0966'),
(193, 'San Marino', 'SM', 'SMR', '674', '0221'),
(194, 'Sao Tome and Principe', 'ST', 'STP', '678', '0381'),
(195, 'Saudi Arabia', 'SA', 'SAU', '682', '0248'),
(196, 'Senegal', 'SN', 'SEN', '686', '0232'),
(197, 'Serbia', 'RS', 'SRB', '688', '0065'),
(198, 'Seychelles', 'SC', 'SYC', '690', '0421'),
(199, 'Sierra Leone', 'SL', 'SLE', '694', '0386'),
(200, 'Singapore', 'SG', 'SGP', '702', '0044'),
(201, 'Slovakia', 'SK', 'SVK', '703', '0677'),
(202, 'Slovenia', 'SI', 'SVN', '705', '0252'),
(203, 'Solomon Islands', 'SB', 'SLB', '090', '0027'),
(204, 'Somalia', 'SO', 'SOM', '706', '000'),
(205, 'South Africa', 'ZA', 'ZAF', '710', '0211'),
(206, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', '239', '0034'),
(207, 'South Sudan', 'SS', 'SSD', '728', '0094'),
(208, 'Spain', 'ES', 'ESP', '724', '0249'),
(209, 'Sri Lanka', 'LK', 'LKA', '144', '0597'),
(210, 'Sudan', 'SD', 'SDN', '736', '0047'),
(211, 'Suriname', 'SR', 'SUR', '740', '0268'),
(212, 'Svalbard and Jan Mayen Islands ', 'SJ', 'SJM', '744', '0046'),
(213, 'Swaziland', 'SZ', 'SWZ', '748', '0041'),
(214, 'Sweden', 'SE', 'SWE', '752', '0963'),
(215, 'Switzerland', 'CH', 'CHE', '756', '0886'),
(216, 'Syrian Arab Republic (Syria)', 'SY', 'SYR', '760', '0992'),
(217, 'Taiwan, Republic of China', 'TW', 'TWN', '158', '0255'),
(218, 'Tajikistan', 'TJ', 'TJK', '762', '0066'),
(219, 'Tanzania, United Republic of', 'TZ', 'TZA', '834', '0228'),
(220, 'Thailand', 'TH', 'THA', '764', '0690'),
(221, 'Timor-Leste', 'TL', 'TLS', '626', '0676'),
(222, 'Togo', 'TG', 'TGO', '768', '1868'),
(223, 'Tokelau ', 'TK', 'TKL', '772', '0216'),
(224, 'Tonga', 'TO', 'TON', '776', '0090'),
(225, 'Trinidad and Tobago', 'TT', 'TTO', '780', '7370'),
(226, 'Tunisia', 'TN', 'TUN', '788', '1649'),
(227, 'Turkey', 'TR', 'TUR', '792', '0688'),
(228, 'Turkmenistan', 'TM', 'TKM', '795', '0256'),
(229, 'Turks and Caicos Islands ', 'TC', 'TCA', '796', '0380'),
(230, 'Tuvalu', 'TV', 'TUV', '798', '0971'),
(231, 'Uganda', 'UG', 'UGA', '800', '0044'),
(232, 'Ukraine', 'UA', 'UKR', '804', '0001'),
(233, 'United Arab Emirates', 'AE', 'ARE', '784', '0001'),
(234, 'United Kingdom', 'GB', 'GBR', '826', '0598'),
(235, 'United States of America', 'US', 'USA', '840', '0998'),
(236, 'US Minor Outlying Islands', 'UM', 'UMI', '581', '0678'),
(237, 'Uruguay', 'UY', 'URY', '858', '0039'),
(238, 'Uzbekistan', 'UZ', 'UZB', '860', '0058'),
(239, 'Vanuatu', 'VU', 'VUT', '548', '0084'),
(240, 'Venezuela (Bolivarian Republic)', 'VE', 'VEN', '862', '1284'),
(241, 'Viet Nam', 'VN', 'VNM', '704', '1340'),
(242, 'Virgin Islands, US', 'VI', 'VIR', '850', '0681'),
(243, 'Wallis and Futuna Islands ', 'WF', 'WLF', '876', '0212'),
(244, 'Western Sahara', 'EH', 'ESH', '732', '0967'),
(245, 'Yemen', 'YE', 'YEM', '887', '0038'),
(246, 'Zambia', 'ZM', 'ZMB', '894', '0260'),
(247, 'Zimbabwe', 'ZW', 'ZWE', '716', '0263');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_type` varchar(2) NOT NULL,
  `title_id` int(2) NOT NULL,
  `custname` varchar(30) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country_id` int(3) NOT NULL,
  `contact_nos` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer_type`
--

CREATE TABLE `customer_type` (
  `id` int(11) NOT NULL,
  `customer_type` varchar(2) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `description` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `description`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `group_privilege`
--

CREATE TABLE `group_privilege` (
  `id` int(11) NOT NULL,
  `privilege` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `group_privilege`
--

INSERT INTO `group_privilege` (`id`, `privilege`, `description`, `status`) VALUES
(1, 'add_user', 'Add new user', 1),
(2, 'update_user', 'Change user', 1),
(3, 'delete_user', 'Delete user', 1),
(4, 'add_user_group', 'Add new user group', 1),
(5, 'update_user_group', 'Change user group', 1),
(6, 'delete_user_group', 'Delete user group', 1),
(7, 'add_privilege', 'Add new privilege', 1),
(8, 'update_privilege', 'Change privilege', 1),
(9, 'delete_privilege', 'Delete privilege', 1),
(10, 'add_parameters', 'Add parameters', 1),
(11, 'update_parameters', 'Change parameters', 1),
(12, 'delete_parameters', 'Delete parameters', 1),
(13, 'add_supplier', 'Add new supplier', 1),
(14, 'update_supplier', 'Change supplier', 1),
(15, 'delete_supplier', 'Delete supplier', 1),
(16, 'add_quotation', 'Add new quotation', 1),
(17, 'update_quotation', 'Change quotation', 1),
(18, 'delete_quotation', 'Delete quotation', 1),
(19, 'add_settlement', 'Add settlement', 1),
(20, 'update_settlement', 'Change settlement', 1),
(21, 'delete_settlement', 'Delete settlement', 1),
(22, 'add_customer', 'Add new customer', 1),
(23, 'update_customer', 'Change customer', 1),
(24, 'delete_customer', 'Delete customer', 1),
(25, 'approve_rate', 'Approve supplier rates', 1),
(26, 'approve_changes', 'Approve changes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `guide`
--

CREATE TABLE `guide` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `title_id` int(2) NOT NULL,
  `gender_id` int(1) NOT NULL DEFAULT '1',
  `type_id` int(3) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_nos` varchar(100) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `date_of_birth` date NOT NULL,
  `career_started` date NOT NULL,
  `languages` varchar(100) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `passport` varchar(15) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `guide_rate`
--

CREATE TABLE `guide_rate` (
  `id` int(11) NOT NULL,
  `guide_id` int(4) NOT NULL,
  `rate_type` int(3) NOT NULL,
  `ccy` int(2) NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `calculation_method_id` int(2) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_from` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_to` datetime NOT NULL,
  `approved_by` int(3) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `guide_type`
--

CREATE TABLE `guide_type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `long_name` varchar(150) NOT NULL,
  `general_email` varchar(100) NOT NULL,
  `reservation_email` varchar(100) DEFAULT NULL,
  `sales_email` varchar(100) DEFAULT NULL,
  `address1` varchar(20) NOT NULL,
  `address2` varchar(20) DEFAULT NULL,
  `city` varchar(20) NOT NULL,
  `country_id` int(3) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `hotel_type_id` int(3) DEFAULT NULL,
  `hotel_chain_id` int(3) DEFAULT NULL,
  `gps_location` varchar(200) DEFAULT NULL,
  `contact_nos` varchar(100) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `frontdesk_contact_nos` varchar(100) DEFAULT NULL,
  `reservation_contact_nos` varchar(100) DEFAULT NULL,
  `sales_contact_nos` varchar(100) DEFAULT NULL,
  `sales_contact_name` varchar(100) DEFAULT NULL,
  `mgr_gm_name` varchar(100) DEFAULT NULL,
  `primary_contact_person` varchar(100) NOT NULL,
  `available_facilities` varchar(100) DEFAULT NULL,
  `room_details` varchar(100) NOT NULL DEFAULT '0' COMMENT 'room_type:qty',
  `no_of_allocated_rooms` varchar(100) NOT NULL DEFAULT '0',
  `rank` decimal(5,1) NOT NULL DEFAULT '0.0',
  `priority_index` int(1) NOT NULL DEFAULT '9',
  `bank_details` varchar(200) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `display_name`, `long_name`, `general_email`, `reservation_email`, `sales_email`, `address1`, `address2`, `city`, `country_id`, `location`, `hotel_type_id`, `hotel_chain_id`, `gps_location`, `contact_nos`, `fax`, `frontdesk_contact_nos`, `reservation_contact_nos`, `sales_contact_nos`, `sales_contact_name`, `mgr_gm_name`, `primary_contact_person`, `available_facilities`, `room_details`, `no_of_allocated_rooms`, `rank`, `priority_index`, `bank_details`, `status`) VALUES
(1, 'Hotel One', 'Hotel One (Pvt) Ltd', 'info@hotelone.com', 'reservation@hotelone.com', 'sales@hotelone.com', 'Address Line 1', 'Address Line 2', 'city two', 209, 'city two,Sri Lanka', 1, 2, '79.333444,6.223344', '+94112123456|+94112456789', '+94112988988', NULL, '+94112990990', '+94112777888', 'SC Name', 'MGR Name', 'PC Person', '1,2,3,10,11,12,13,14', '{\"1\":100,\"2\":200,\"8\":30}', '0', '4.5', 9, '00112234495\r\nNew Branch\r\nNew Bank', 1),
(2, 'Hotel Two', 'Hotel Two (Pvt) Ltd', 'info@hoteltwo.com', 'reservation@hoteltwo.com', 'sales@hoteltwo.com', 'Address Line 1', 'Address Line 2', 'Old city', 209, 'Old city,Sri Lanka', 2, 1, '79.112233,6.006762', '+94112123456|+94112456789', '+94112988988', NULL, '+94112990990', '+94112777888', 'SC Name', 'MGR Name', 'PC Person', '1,2,3,8,9,10,11,12,13,14', '{\"1\":150,\"2\":100,\"7\":40}', '0', '4.0', 9, '00112234495\\r\\nNew Branch\\r\\nNew Bank', 1),
(3, 'Hotel Three', 'Hotel Three (Pvt) Ltd', 'info@hotelthree.com', 'reservation@hotelthree.com', 'sales@hotelthree.com', 'Address Line 1', 'Address Line 2', 'Just city', 209, 'Just city,Sri Lanka', 3, 3, '79.332211,6.440099', '+94112123456|+94112456789', '+94112988988', NULL, '+94112990990', '+94112777888', 'SC Name', 'MGR Name', 'PC Person', '1,2,3,12,13,14', '{\"1\":150,\"2\":100,\"3\":50,\"7\":40}', '0', '3.5', 9, '00112234495\\r\\nNew Branch\\r\\nNew Bank', 1),
(4, 'Hotel Four', 'Hotel Four International', 'info@hotelfour.com', 'reservation@hotelfour.com', 'sales@hotelfour.com', 'Address Line 1', 'Address Line 2', 'Colombo', 209, 'Colombo,Sri Lanka', 2, 1, '79.884466,6.666773', '+94112776488|+94112777555', '+94112444555', NULL, '+94112333444', '+94112888999', 'SC Name', 'GMMGR Name', 'PC Contact', '1,2,3,4,5,13,14,15', '{\"1\":50,\"2\":50,\"9\":10}', '0', '4.0', 9, '9836355477\r\nCity Branch\r\nNew Bank', 1),
(5, 'Hotel Five', 'Hotel Five Int', 'info@hotelfive.com', 'reservation@hotelfive.com', 'sales@hotelfive.com', 'Address Line 1', 'Address Line 2', 'Kandy', 209, 'Kandy,Sri Lanka', 1, 3, '79.998877,6.334455', '+94112333444', '+94112556677', NULL, '+94112000999', '+94112338877', 'SC Name', 'MGR Name', 'PC Contact', '1,2,3,6,8,14', '{\"1\":150,\"2\":100,\"11\":10}', '0', '4.0', 8, '2342534634543\r\nold branch\r\nold bank', 1),
(6, 'Hotel Six', 'Hotel Six (Pvt) Ltd', 'info@hotelsix.com', 'reversation@hotelsix.com', 'sales@hotelsix.com', 'Address Line 1', 'Address Line 2', 'Kandy', 209, 'Kandy,Sri Lanka', 2, 2, '79.887766,6.008877', '+94112756578|+94112884466', '+94112332233', NULL, '+94112118866', '+94112665544', 'SC Name', 'MGRGM Name', 'PC Contact', '1,2,3,6,7,8', '{\"1\":50,\"2\":30}', '0', '3.5', 0, '', 1),
(7, 'Hotel Seven', 'Hotel Seven Int', 'info@hotelseven.com', 'reservation@hotelseven.com', 'sales@hotelseven.com', 'Address Line 1', 'Address Line 2', 'Galle', 209, 'Galle,Sri Lanka', 1, 2, '79.009988,6.444555', '+94112556699', '+94112339988', NULL, '+94112337744', '+94112776655', 'SC Name', 'MGR Name', 'PC Contact', '1,2,3,9,10,13', '{\"1\":200}', '0', '4.0', 0, '23235235', 1),
(8, 'Display Name', 'Long Name', 'email@hotel.com', '', '', 'Address Line 1', 'Address Line 2', 'City', 209, 'City,Sri Lanka', 2, 3, '', '+94112333222', '+94112777333', NULL, '', '', '', '', 'PC Contact', '1,4,5,11,13', '{\"1\":50}', '0', '4.0', 0, '', 1),
(9, 'Display Name', 'Long Name', 'email@hotel.com', '', '', 'Address Line 1', 'Address Line 2', 'City', 209, 'City,Sri Lanka', 2, 3, '', '+94112333222', '+94112777333', NULL, '', '', '', '', 'PC Contact', '1,4,5,11,13', '{\"1\":50}', '0', '4.0', 0, '', 1),
(10, 'Display Name', 'Long Name', 'email@hotel.com', '', '', 'Address Line 1', 'Address Line 2', 'City', 209, 'City,Sri Lanka', 2, 2, '', '+94112333444', '+94112449988', NULL, '', '', '', '', 'PC Contact', '2,4,7,9', '{\"1\":100,\"7\":12}', '0', '4.0', 0, '', 1),
(11, 'Display Name', 'Long Name', 'email@hotel.com', '', '', 'Address Line 1', 'Address Line 2', 'City', 209, 'City,Sri Lanka', 2, 3, '', '+94112777666', '+94112786567', NULL, '', '', '', '', 'PC Person', '2,3,5,7', '{\"1\":100}', '0', '3.5', 0, '', 1),
(12, 'Display Name', 'Long Name', 'email@hotel.com', '', '', 'Address Line 1', 'Address Line 2', 'City', 209, 'City,Sri Lanka', 2, 3, '', '+94112777666', '+94112786567', NULL, '', '', '', '', 'PC Person', '2,3,5,7', '{\"1\":100}', '0', '3.5', 0, '', 1),
(13, 'Display Name', 'Long Name', 'email@hotel.com', '', '', 'Address Line 1', 'Address Line 2', 'City', 209, 'City,Sri Lanka', 2, 3, '', '+94112334455', '+94112887766', NULL, '', '', '', '', 'PC Person', '2,4,8,12', '{\"4\":50}', '0', '2.5', 0, '', 1),
(14, 'Display Name', 'Long Name', 'email@hotel.com', '', '', 'Address Line 1', 'Address Line 2', 'City', 209, 'City,Sri Lanka', 1, 2, '', '+94112334449', '+94112339944', NULL, '', '', '', '', 'PC Person', '2,3,4,8,9', '{\"7\":30}', '0', '4.0', 0, '', 1),
(15, 'Display Name', 'Long Name', 'email@hotel.com', '', '', 'Address Line 1', 'Address Line 2', 'City', 209, 'City,Sri Lanka', 1, 2, '', '+94112665544', '+94112778866', NULL, '', '', '', '', 'PC Person', '2,4,6,9', '{\"8\":10,\"1\":100}', '0', '4.0', 0, '', 1),
(16, 'Hotel', 'Hotel Long', 'email@hotel.com', '', '', 'Address Line 1', 'Address Line 2', 'City', 209, 'City,Sri Lanka', 2, 3, '', '+94112887766', '+94112887744', NULL, '', '', '', '', 'PC Person', '2,3,4,6,7', '{\"5\":10}', '0', '3.5', 0, '', 1),
(17, 'Hotel', 'Hotel Long', 'email@hotel.com', '', '', 'Address Line 1', 'Address Line 2', 'City', 209, 'City,Sri Lanka', 2, 3, '', '+94112887766', '+94112887744', NULL, '', '', '', '', 'PC Person', '2,3,4,6,7', '{\"5\":10}', '0', '3.5', 0, '', 1),
(18, 'Hotel', 'Hotel Long', 'email@hotel.com', '', '', 'Address Line 1', 'Address Line 2', 'City', 209, 'City,Sri Lanka', 2, 3, '', '+94112887766', '+94112887744', NULL, '', '', '', '', 'PC Person', '2,3,4,6,7', '{\"5\":10}', '0', '3.5', 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_facility`
--

CREATE TABLE `hotel_facility` (
  `id` int(11) NOT NULL,
  `facility` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel_facility`
--

INSERT INTO `hotel_facility` (`id`, `facility`) VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(3, 'Dinner'),
(4, 'Morning Tea with Snacks'),
(5, 'Evening Tea with Snacks'),
(6, 'Desserts'),
(7, 'Pub'),
(8, 'Local Liquor'),
(9, 'Foreign Liqour'),
(10, 'Breakfast Buffet'),
(11, 'Lunch Buffet'),
(12, 'Dinner Buffet'),
(13, 'Swimming Pool'),
(14, 'Gym'),
(15, 'Indoor Sports'),
(16, 'Outdoor Sports'),
(17, 'Taxi Service');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_rate`
--

CREATE TABLE `hotel_rate` (
  `id` int(11) NOT NULL,
  `hotel_id` int(4) NOT NULL,
  `rate_type` int(3) NOT NULL,
  `ccy` int(2) NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `calculation_method_id` int(2) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_from` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_to` datetime NOT NULL,
  `approved_by` int(3) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_rooms`
--

CREATE TABLE `hotel_rooms` (
  `id` int(11) NOT NULL,
  `hotel_id` int(3) NOT NULL,
  `room_type_id` int(3) NOT NULL,
  `qty` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_type`
--

CREATE TABLE `hotel_type` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel_type`
--

INSERT INTO `hotel_type` (`id`, `description`) VALUES
(1, 'Type A'),
(2, 'Type B'),
(3, 'Type C');

-- --------------------------------------------------------

--
-- Table structure for table `internal_formbuilder`
--

CREATE TABLE `internal_formbuilder` (
  `id` int(11) NOT NULL,
  `table_name` varchar(20) NOT NULL,
  `info_type` int(1) NOT NULL DEFAULT '1' COMMENT 'Information type: 1 - Basic, 2 - Additional',
  `sort_order` int(2) NOT NULL,
  `column_properties` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `internal_formbuilder`
--

INSERT INTO `internal_formbuilder` (`id`, `table_name`, `info_type`, `sort_order`, `column_properties`) VALUES
(1, 'hotel', 1, 2, '{\"control1\":{\"col_name\":\"display_name\",\"placeholder\":\"Display Name\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"w-250\",\"required\":\"1\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Display Name\"},\"control2\":{\"col_name\":\"long_name\",\"placeholder\":\"Long Name\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"w-300\",\"required\":\"0\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Long Name\"}}'),
(2, 'hotel', 1, 3, '{\"control1\":{\"col_name\":\"address1\",\"placeholder\":\"Address Line 1\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"w-250\",\"required\":\"1\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Address Line 1\"},\"control2\":{\"col_name\":\"address2\",\"placeholder\":\"Address Line 2\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"w-250\",\"required\":\"0\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Address Line 2\"}}'),
(3, 'hotel', 1, 5, '{\"control1\":{\"col_name\":\"general_email\",\"placeholder\":\"Email\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"w-200\",\"required\":\"1\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Email\"},\"control2\":{\"col_name\":\"contact_nos\",\"placeholder\":\"Contact Numbers\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"0\",\"required\":\"1\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Contact Numbers\"}}'),
(4, 'hotel', 1, 1, '{\"control1\":{\"col_name\":\"hotel_type_id\",\"placeholder\":\"Hotel Type\",\"data_type\":\"txt\",\"form_control\":\"select-sp\",\"width_class\":\"w-200\",\"required\":\"1\",\"reference_table\":\"hotel_type\",\"reference_col\":\"description\",\"label\":\"Hotel Type\"},\"control2\":{\"col_name\":\"hotel_chain_id\",\"placeholder\":\"Hotel Chain\",\"data_type\":\"txt\",\"form_control\":\"select-sp\",\"width_class\":\"w-200\",\"required\":\"1\",\"reference_table\":\"hotel_chain\",\"reference_col\":\"description\",\"label\":\"Hotel Chain\"}}'),
(5, 'hotel', 1, 6, '{\"control1\":{\"col_name\":\"fax\",\"placeholder\":\"Fax\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"w-150\",\"required\":\"1\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Fax\"},\"control2\":{\"col_name\":\"primary_contact_person\",\"placeholder\":\"Primary Contact Person\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"w-200\",\"required\":\"1\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Primary Contact Person\"}}'),
(6, 'hotel', 1, 4, '{\"control1\":{\"col_name\":\"city\",\"placeholder\":\"City\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"w-100\",\"required\":\"1\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"City\"},\"control2\":{\"col_name\":\"country_id\",\"placeholder\":\"Country\",\"data_type\":\"txt\",\"form_control\":\"select-sp\",\"width_class\":\"w-200\",\"required\":\"1\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Country\"}}\r\n'),
(7, 'hotel', 2, 1, '{\"control1\":{\"col_name\":\"reservation_email\",\"placeholder\":\"Reservation Email\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"0\",\"required\":\"0\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Reservation Email\"},\"control2\":{\"col_name\":\"reservation_contact_nos\",\"placeholder\":\"Reservation Contact Nos\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"0\",\"required\":\"0\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Reservation Contact Nos\"}}'),
(8, 'hotel', 2, 2, '{\"control1\":{\"col_name\":\"sales_email\",\"placeholder\":\"Sales Email\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"0\",\"required\":\"0\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Sales Email\"},\"control2\":{\"col_name\":\"sales_contact_nos\",\"placeholder\":\"Sales Contact Nos\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"0\",\"required\":\"0\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Sales Contact Nos\"}}'),
(9, 'hotel', 2, 3, '{\"control1\":{\"col_name\":\"sales_contact_name\",\"placeholder\":\"Sales Contact Name\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"0\",\"required\":\"0\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Sales Contact Name\"},\"control2\":{\"col_name\":\"mgr_gm_name\",\"placeholder\":\"Manager/GM Name\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"0\",\"required\":\"0\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Manager/GM Name\"}}'),
(10, 'hotel', 2, 4, '{\"control1\":{\"col_name\":\"gps_location\",\"placeholder\":\"GPS Location\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"0\",\"required\":\"0\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"GPS Location\"},\"control2\":{\"col_name\":\"available_facilities\",\"placeholder\":\"Available Facilities\",\"data_type\":\"txt\",\"form_control\":\"select-sp\",\"width_class\":\"0\",\"required\":\"0\",\"reference_table\":\"hotel_facility\",\"reference_col\":\"facility\",\"label\":\"Available Facilities\"}}'),
(11, 'hotel', 2, 5, '{\"control2\":{\"col_name\":\"priority_index\",\"placeholder\":\"Priority Index\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"0\",\"required\":\"0\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Priority Index\"},\"control1\":{\"col_name\":\"rank\",\"placeholder\":\"Hotel Rank\",\"data_type\":\"txt\",\"form_control\":\"input\",\"width_class\":\"0\",\"required\":\"0\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Hotel Rank\"}}'),
(12, 'hotel', 3, 1, '{\"control1\":{\"col_name\":\"room_details\",\"placeholder\":\"Room Details\",\"data_type\":\"number\",\"form_control\":\"room_details\",\"width_class\":\"0\",\"required\":\"0\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Room Details\"}}'),
(13, 'hotel', 2, 6, '{\"control1\":{\"col_name\":\"bank_details\",\"placeholder\":\"Bank Details\",\"data_type\":\"txt\",\"form_control\":\"text\",\"width_class\":\"0\",\"required\":\"0\",\"reference_table\":\"0\",\"reference_col\":\"0\",\"label\":\"Bank Details\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `internal_menu`
--

CREATE TABLE `internal_menu` (
  `id` int(11) NOT NULL,
  `parent` int(5) NOT NULL DEFAULT '0',
  `short_name` varchar(30) NOT NULL,
  `description` varchar(30) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '999',
  `haschildren` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `internal_menu`
--

INSERT INTO `internal_menu` (`id`, `parent`, `short_name`, `description`, `sort_order`, `haschildren`, `status`) VALUES
(1, 0, 'hotel', 'Hotel', 2, 0, 1),
(2, 0, 'guide', 'Guide', 4, 0, 1),
(3, 0, 'vehicle', 'Vehicle', 5, 0, 1),
(4, 0, 'quotation', 'Quotation', 1, 0, 1),
(5, 0, 'restaurant', 'Restaurant', 3, 0, 1),
(6, 0, 'settlement', 'Settlements', 6, 0, 1),
(7, 0, 'report', 'Reports', 7, 0, 1),
(8, 0, 'admin', 'Administrator', 8, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `internal_menu1`
--

CREATE TABLE `internal_menu1` (
  `id` int(11) NOT NULL,
  `parent` int(5) NOT NULL DEFAULT '0',
  `short_name` varchar(30) NOT NULL,
  `description` varchar(30) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '999',
  `haschildren` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `internal_menu1`
--

INSERT INTO `internal_menu1` (`id`, `parent`, `short_name`, `description`, `sort_order`, `haschildren`, `status`) VALUES
(1, 0, 'supplier', 'Supplier', 999, 1, 1),
(2, 1, 'hotel', 'Hotels', 999, 0, 1),
(3, 1, 'vehicle', 'Vehicles', 999, 0, 1),
(4, 1, 'guide', 'Guides', 999, 0, 1),
(5, 1, 'restaurant', 'Restaurants', 999, 0, 1),
(6, 1, 'activity_providers', 'Activity Providers', 999, 0, 1),
(7, 1, 'shop', 'Shops', 999, 0, 1),
(8, 0, 'rate', 'Rates', 999, 1, 1),
(9, 8, 'hotel_rates', 'Hotel Rates', 999, 0, 1),
(10, 8, 'vehicle_rate', 'Vehicle Rate', 999, 0, 1),
(11, 8, 'guide_rate', 'Guide Rates', 999, 0, 1),
(12, 8, 'entrance_activity_rate', 'Entrance & Activity Rates', 999, 0, 1),
(13, 0, 'quotations', 'Quotations', 999, 0, 1),
(14, 0, 'order', 'Orders', 999, 0, 1),
(15, 0, 'operations', 'Operations', 999, 1, 1),
(16, 15, 'passenger', 'Passengers', 999, 0, 1),
(17, 15, 'rooming_list', 'Rooming List', 999, 0, 1),
(18, 15, 'departure_notice', 'Departure Notice', 999, 0, 1),
(19, 15, 'itinerary_list', 'Itinerary List', 999, 0, 1),
(20, 0, 'commissions', 'Commissions', 999, 1, 1),
(21, 20, 'commission_income', 'Commission Income', 999, 0, 1),
(22, 20, 'comm_sharing_policy', 'Commission Sharing Policy', 999, 0, 1),
(23, 0, 'accounting', 'Accounting', 999, 1, 1),
(24, 23, 'receivable_accounts', 'Receivable Accounts', 999, 0, 1),
(25, 23, 'payable_accounts', 'Payable  Accounts', 999, 0, 1),
(26, 23, 'invoice', 'Invoice', 999, 0, 1),
(27, 0, 'agents', 'Agents', 999, 0, 1),
(28, 0, 'reports', 'Reports', 999, 1, 1),
(29, 28, 'profit_loss_reports', 'Profit & Loss Reports', 999, 0, 1),
(30, 28, 'agent_performance_reports', 'Agents Performance Reports', 999, 0, 1),
(31, 28, 'operator_performance_reports', 'Operator Performance Reports', 999, 0, 1),
(32, 28, 'hotel_reservation_reports', 'Hotel Reservation Reports', 999, 0, 1),
(33, 28, 'shopping_yield_reports', 'Shopping Yield Reports', 999, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `internal_resource_locations`
--

CREATE TABLE `internal_resource_locations` (
  `id` int(11) NOT NULL,
  `res_name` varchar(20) NOT NULL,
  `res_type` varchar(10) NOT NULL,
  `location` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `lang_code` varchar(10) NOT NULL,
  `lang_description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `lang_code`, `lang_description`) VALUES
(1, 'ab', 'Abkhazian'),
(2, 'aa', 'Afar'),
(3, 'af', 'Afrikaans'),
(4, 'ak', 'Akan'),
(5, 'sq', 'Albanian'),
(6, 'am', 'Amharic'),
(7, 'ar', 'Arabic'),
(8, 'an', 'Aragonese'),
(9, 'hy', 'Armenian'),
(10, 'as', 'Assamese'),
(11, 'av', 'Avaric'),
(12, 'ae', 'Avestan'),
(13, 'ay', 'Aymara'),
(14, 'az', 'Azerbaijani'),
(15, 'bm', 'Bambara'),
(16, 'ba', 'Bashkir'),
(17, 'eu', 'Basque'),
(18, 'be', 'Belarusian'),
(19, 'bn', 'Bengali (Bangla)'),
(20, 'bh', 'Bihari'),
(21, 'bi', 'Bislama'),
(22, 'bs', 'Bosnian'),
(23, 'br', 'Breton'),
(24, 'bg', 'Bulgarian'),
(25, 'my', 'Burmese'),
(26, 'ca', 'Catalan'),
(27, 'ch', 'Chamorro'),
(28, 'ce', 'Chechen'),
(29, 'ny', 'Chichewa, Chewa, Nyanja'),
(30, 'zh', 'Chinese'),
(31, 'zh-Hans', 'Chinese (Simplified)'),
(32, 'zh-Hant', 'Chinese (Traditional)'),
(33, 'cv', 'Chuvash'),
(34, 'kw', 'Cornish'),
(35, 'co', 'Corsican'),
(36, 'cr', 'Cree'),
(37, 'hr', 'Croatian'),
(38, 'cs', 'Czech'),
(39, 'da', 'Danish'),
(40, 'dv', 'Divehi, Dhivehi, Maldivian'),
(41, 'nl', 'Dutch'),
(42, 'dz', 'Dzongkha'),
(43, 'en', 'English'),
(44, 'eo', 'Esperanto'),
(45, 'et', 'Estonian'),
(46, 'ee', 'Ewe'),
(47, 'fo', 'Faroese'),
(48, 'fj', 'Fijian'),
(49, 'fi', 'Finnish'),
(50, 'fr', 'French'),
(51, 'ff', 'Fula, Fulah, Pulaar, Pular'),
(52, 'gl', 'Galician'),
(53, 'gd', 'Gaelic (Scottish)'),
(54, 'gv', 'Gaelic (Manx)'),
(55, 'ka', 'Georgian'),
(56, 'de', 'German'),
(57, 'el', 'Greek'),
(58, 'kl', 'Greenlandic'),
(59, 'gn', 'Guarani'),
(60, 'gu', 'Gujarati'),
(61, 'ht', 'Haitian Creole'),
(62, 'ha', 'Hausa'),
(63, 'he', 'Hebrew'),
(64, 'hz', 'Herero'),
(65, 'hi', 'Hindi'),
(66, 'ho', 'Hiri Motu'),
(67, 'hu', 'Hungarian'),
(68, 'is', 'Icelandic'),
(69, 'io', 'Ido'),
(70, 'ig', 'Igbo'),
(71, 'id, in', 'Indonesian'),
(72, 'ia', 'Interlingua'),
(73, 'ie', 'Interlingue'),
(74, 'iu', 'Inuktitut'),
(75, 'ik', 'Inupiak'),
(76, 'ga', 'Irish'),
(77, 'it', 'Italian'),
(78, 'ja', 'Japanese'),
(79, 'jv', 'Javanese'),
(80, 'kl', 'Kalaallisut, Greenlandic'),
(81, 'kn', 'Kannada'),
(82, 'kr', 'Kanuri'),
(83, 'ks', 'Kashmiri'),
(84, 'kk', 'Kazakh'),
(85, 'km', 'Khmer'),
(86, 'ki', 'Kikuyu'),
(87, 'rw', 'Kinyarwanda (Rwanda)'),
(88, 'rn', 'Kirundi'),
(89, 'ky', 'Kyrgyz'),
(90, 'kv', 'Komi'),
(91, 'kg', 'Kongo'),
(92, 'ko', 'Korean'),
(93, 'ku', 'Kurdish'),
(94, 'kj', 'Kwanyama'),
(95, 'lo', 'Lao'),
(96, 'la', 'Latin'),
(97, 'lv', 'Latvian (Lettish)'),
(98, 'li', 'Limburgish ( Limburger)'),
(99, 'ln', 'Lingala'),
(100, 'lt', 'Lithuanian'),
(101, 'lu', 'Luga-Katanga'),
(102, 'lg', 'Luganda, Ganda'),
(103, 'lb', 'Luxembourgish'),
(104, 'gv', 'Manx'),
(105, 'mk', 'Macedonian'),
(106, 'mg', 'Malagasy'),
(107, 'ms', 'Malay'),
(108, 'ml', 'Malayalam'),
(109, 'mt', 'Maltese'),
(110, 'mi', 'Maori'),
(111, 'mr', 'Marathi'),
(112, 'mh', 'Marshallese'),
(113, 'mo', 'Moldavian'),
(114, 'mn', 'Mongolian'),
(115, 'na', 'Nauru'),
(116, 'nv', 'Navajo'),
(117, 'ng', 'Ndonga'),
(118, 'nd', 'Northern Ndebele'),
(119, 'ne', 'Nepali'),
(120, 'no', 'Norwegian'),
(121, 'nb', 'Norwegian bokmÃ¥l'),
(122, 'nn', 'Norwegian nynorsk'),
(123, 'ii', 'Nuosu'),
(124, 'oc', 'Occitan'),
(125, 'oj', 'Ojibwe'),
(126, 'cu', 'Old Church Slavonic, Old Bulga'),
(127, 'or', 'Oriya'),
(128, 'om', 'Oromo (Afaan Oromo)'),
(129, 'os', 'Ossetian'),
(130, 'pi', 'PÄli'),
(131, 'ps', 'Pashto, Pushto'),
(132, 'fa', 'Persian (Farsi)'),
(133, 'pl', 'Polish'),
(134, 'pt', 'Portuguese'),
(135, 'pa', 'Punjabi (Eastern)'),
(136, 'qu', 'Quechua'),
(137, 'rm', 'Romansh'),
(138, 'ro', 'Romanian'),
(139, 'ru', 'Russian'),
(140, 'se', 'Sami'),
(141, 'sm', 'Samoan'),
(142, 'sg', 'Sango'),
(143, 'sa', 'Sanskrit'),
(144, 'sr', 'Serbian'),
(145, 'sh', 'Serbo-Croatian'),
(146, 'st', 'Sesotho'),
(147, 'tn', 'Setswana'),
(148, 'sn', 'Shona'),
(149, 'ii', 'Sichuan Yi'),
(150, 'sd', 'Sindhi'),
(151, 'si', 'Sinhalese'),
(152, 'ss', 'Siswati'),
(153, 'sk', 'Slovak'),
(154, 'sl', 'Slovenian'),
(155, 'so', 'Somali'),
(156, 'nr', 'Southern Ndebele'),
(157, 'es', 'Spanish'),
(158, 'su', 'Sundanese'),
(159, 'sw', 'Swahili (Kiswahili)'),
(160, 'ss', 'Swati'),
(161, 'sv', 'Swedish'),
(162, 'tl', 'Tagalog'),
(163, 'ty', 'Tahitian'),
(164, 'tg', 'Tajik'),
(165, 'ta', 'Tamil'),
(166, 'tt', 'Tatar'),
(167, 'te', 'Telugu'),
(168, 'th', 'Thai'),
(169, 'bo', 'Tibetan'),
(170, 'ti', 'Tigrinya'),
(171, 'to', 'Tonga'),
(172, 'ts', 'Tsonga'),
(173, 'tr', 'Turkish'),
(174, 'tk', 'Turkmen'),
(175, 'tw', 'Twi'),
(176, 'ug', 'Uyghur'),
(177, 'uk', 'Ukrainian'),
(178, 'ur', 'Urdu'),
(179, 'uz', 'Uzbek'),
(180, 've', 'Venda'),
(181, 'vi', 'Vietnamese'),
(182, 'vo', 'VolapÃ¼k'),
(183, 'wa', 'Wallon'),
(184, 'cy', 'Welsh'),
(185, 'wo', 'Wolof'),
(186, 'fy', 'Western Frisian'),
(187, 'xh', 'Xhosa'),
(188, 'yi, ji', 'Yiddish'),
(189, 'yo', 'Yoruba'),
(190, 'za', 'Zhuang, Chuang'),
(191, 'zu', 'Zulu');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `target_user_groups` varchar(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `viewed_users` varchar(100) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `operator_id` int(3) NOT NULL,
  `guide_id` int(3) NOT NULL,
  `agent_id` int(3) NOT NULL,
  `datetime_airport_pickup` datetime NOT NULL,
  `datetime_airport_drop` datetime NOT NULL,
  `arrival_flight_time` datetime NOT NULL,
  `arrival_flight_no` varchar(6) NOT NULL,
  `departure_flight_time` datetime(6) NOT NULL,
  `departure_flight_no` varchar(6) NOT NULL,
  `pax_adult` int(3) NOT NULL,
  `pax_children` int(3) NOT NULL DEFAULT '0',
  `hotel_included` int(1) NOT NULL,
  `vehicle_included` int(1) NOT NULL,
  `guide_included` int(1) NOT NULL,
  `activity_included` int(1) NOT NULL,
  `extra_meals_included` int(1) NOT NULL,
  `shop_included` int(1) NOT NULL,
  `vehicle_id` int(3) NOT NULL,
  `driver_name` varchar(50) NOT NULL,
  `driver_phone` varchar(15) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `id` int(11) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `operator_id` int(3) NOT NULL,
  `datetime_airport_pickup` datetime NOT NULL,
  `datetime_airport_drop` datetime NOT NULL,
  `pax_adult` int(3) NOT NULL,
  `pax_children` int(3) NOT NULL DEFAULT '0',
  `hotel_included` int(1) NOT NULL,
  `vehicle_included` int(1) NOT NULL,
  `guide_included` int(1) NOT NULL,
  `activity_included` int(1) NOT NULL,
  `extra_meals_included` int(1) NOT NULL,
  `shop_included` int(1) NOT NULL,
  `vehicle_type_id` int(3) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `validity` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rate_type`
--

CREATE TABLE `rate_type` (
  `id` int(11) NOT NULL,
  `description` varchar(20) NOT NULL,
  `rate_class_id` int(3) NOT NULL COMMENT 'Entity type id which the rate available to'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `type_id` int(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `country_id` int(3) NOT NULL,
  `gps_location` varchar(100) NOT NULL,
  `reservation_contact_nos` varchar(100) NOT NULL,
  `reservation_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_rate`
--

CREATE TABLE `restaurant_rate` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(4) NOT NULL,
  `rate_type` int(3) NOT NULL,
  `ccy` int(2) NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `calculation_method_id` int(2) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_from` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_to` datetime NOT NULL,
  `approved_by` int(3) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_type`
--

CREATE TABLE `restaurant_type` (
  `id` int(11) NOT NULL,
  `description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `id` int(11) NOT NULL,
  `room_type` varchar(30) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `room_type`, `description`) VALUES
(1, 'Single', 'A room with the facility of single bed. It is meant for single occupancy. It has an attached bathroom, a small dressing table, a small bedside table, and a small writing table. Sometimes it has a single chair too.'),
(2, 'Double', 'A room with the facility of double bed. There are two variants in this type depending upon the size of the bed\r\n\r\n> King Double Room (with king size double bed)\r\n> Queen Double Room (with queen size double bed)\r\n\r\nIt is equipped with adequate furniture such as dressing table and a writing table, a TV, and a small fridge.'),
(3, 'Deluxe', 'Deluxe rooms are available in Single Deluxe and Double Deluxe variants. Deluxe room is well furnished. Some amenities are attached bathroom, a dressing table, a bedside table, a small writing table, a TV, and a small fridge. The floor is covered with carpet and most suitable for small families.'),
(4, 'Twin Single', 'This room provides two single beds with separate headboards. It is meant for two independent people. It also has a single bedside table shared between the two beds.'),
(5, 'Twin Double', 'This room provides two double beds with separate headboards. It is ideal for a family with two children below 12 years.'),
(6, 'Hollywood Twin', 'This room provides two single beds with a common headboard. If a need arises, the two beds can be brought together to form a double bed.'),
(7, 'Duplex', 'This type is composed of two rooms located on two different floors, connected with internal stairs.'),
(8, 'Cabana', 'This type of room faces water body, beach, or a swimming pool. It generally has a large balcony.'),
(9, 'Studio', 'They are twin adjacent rooms: A living room with sofa, coffee table and chairs, and a bedroom. It is also equipped with fan/air conditioner, a small kitchen corner, and a dining area. The furniture is often compact.'),
(10, 'Lanai', 'This room faces a landscape, a waterfall, or a garden.'),
(11, 'Suite', 'It is composed of one or more bedrooms, a living room, and a dining area. It is excellent for the guests who prefer more space, wish to entertain their guests without interruption and giving up privacy.There are various types of suites −\r\n\r\n> Regular Suite − Best for business travelers.\r\n\r\n> Penthouse Suite − Luxurious than the regular suite. It is provided with the access to terrace space above the suite. It is aloof from crowd and provides abird’s eye view of the city. It has all the amenities and structure similar to a regular suite.\r\n\r\n> Presidential Suite − The best possible suite in the hotel.'),
(12, 'Sico', 'This is a kind of multipurpose room, which can be used as a meeting room during the day and as a bedroom during the night. These rooms have special beds called Murphy Bed that can be folded entirely against a wall. This bed may or may not have headboard. The lower face of the bed which becomes visible after folding or placing upright, has a decorative wall paper, mirror, or a painting. After folding the bed, the room can accommodate sitting for five to ten people.');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `chain_id` int(3) NOT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(20) NOT NULL,
  `country_id` int(3) NOT NULL,
  `contact_nos` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `manager_name` varchar(15) NOT NULL,
  `manager_phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_product`
--

CREATE TABLE `shop_product` (
  `id` int(11) NOT NULL,
  `shop_id` int(3) NOT NULL,
  `product_id` int(3) NOT NULL,
  `commision_rate` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `id` int(11) NOT NULL,
  `description` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`id`, `description`) VALUES
(1, 'Mr.'),
(2, 'Mrs.'),
(3, 'Miss'),
(4, 'Ms.'),
(5, 'Dr.'),
(6, 'Madam'),
(7, 'Rev.'),
(8, 'Hon.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `usergroup` int(2) NOT NULL,
  `username` varchar(20) NOT NULL COMMENT 'User Name',
  `password` varchar(512) NOT NULL COMMENT 'Password',
  `fname` varchar(20) NOT NULL COMMENT 'First Name',
  `lname` varchar(30) NOT NULL COMMENT 'Last Name',
  `email` varchar(100) NOT NULL COMMENT 'Email',
  `contact` varchar(15) NOT NULL DEFAULT '0' COMMENT 'Contact Number',
  `status` int(2) NOT NULL DEFAULT '0',
  `activationhash` varchar(10) DEFAULT NULL,
  `createdby` int(5) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `usergroup`, `username`, `password`, `fname`, `lname`, `email`, `contact`, `status`, `activationhash`, `createdby`, `datecreated`, `datemodified`) VALUES
(1, 1, 'admin', 'C7AD44CBAD762A5DA0A452F9E854FDC1E0E7A52A38015F23F3EAB1D80B931DD472634DFAC71CD34EBC35D16AB7FB8A90C81F975113D6C7538DC69DD8DE9077EC', 'Admin', 'Lname', 'admin@email.com', '0094777666555', 1, NULL, 1, '2017-08-08 16:55:03', NULL),
(2, 3, 'operator1', 'DCC02FBDC08CF042F9D45F4FEC6CB4BE2AEC22CA282C4A0A7FB5D8F19F3E00AA9F850DA1465F6633208507200F6CBE1A336CB955CB37AD66425494059F54F0BD', 'Operator', 'One', 'operator1@email.com', '1111111', 1, NULL, 1, '2017-08-09 15:44:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `short_name` varchar(4) NOT NULL,
  `description` varchar(20) NOT NULL,
  `privileges` varchar(50) NOT NULL,
  `accessible_menu_items` varchar(200) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `short_name`, `description`, `privileges`, `accessible_menu_items`, `status`) VALUES
(1, 'admn', 'Administrator', '1,2,3,4,5,6,7,8,9,10,11,12', 'admin,hotel,report', 1),
(2, 'supv', 'Supervisor', '25,26', '', 1),
(3, 'oper', 'Operator', '13,14,15,16,17,18,19,20,21,22,23,24', 'supplier,hotel,vehicle,guide,restaurant,activity_providers,shop,rate,hotel_rate,vehicle_rate,guide_rate,entrance_activity_rate,quotations,order,operations,passengers', 1),
(4, 'agnt', 'Agent', '16,17,18', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `type` int(2) NOT NULL,
  `make` int(2) NOT NULL,
  `model` int(2) NOT NULL,
  `year` date NOT NULL,
  `color` int(3) NOT NULL,
  `registration_number` varchar(20) NOT NULL,
  `seating_capacity` int(2) NOT NULL,
  `owner_name` varchar(50) NOT NULL,
  `owner_contact_nos` varchar(100) NOT NULL,
  `owner_email` varchar(100) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `country_id` int(3) NOT NULL,
  `driver_name` varchar(50) NOT NULL,
  `driver_contact_nos` varchar(100) NOT NULL,
  `driver_nic` varchar(15) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_make`
--

CREATE TABLE `vehicle_make` (
  `id` int(11) NOT NULL,
  `description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_model`
--

CREATE TABLE `vehicle_model` (
  `id` int(11) NOT NULL,
  `make_id` int(3) NOT NULL,
  `description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_rate`
--

CREATE TABLE `vehicle_rate` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(4) NOT NULL,
  `rate_type` int(3) NOT NULL,
  `ccy` int(2) NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `calculation_method_id` int(2) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_from` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_to` datetime NOT NULL,
  `approved_by` int(3) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `id` int(11) NOT NULL,
  `description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calculation_method`
--
ALTER TABLE `calculation_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chain_type`
--
ALTER TABLE `chain_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_type`
--
ALTER TABLE `customer_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_privilege`
--
ALTER TABLE `group_privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guide_type`
--
ALTER TABLE `guide_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_facility`
--
ALTER TABLE `hotel_facility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_type`
--
ALTER TABLE `hotel_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_formbuilder`
--
ALTER TABLE `internal_formbuilder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_menu`
--
ALTER TABLE `internal_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_menu1`
--
ALTER TABLE `internal_menu1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_resource_locations`
--
ALTER TABLE `internal_resource_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate_type`
--
ALTER TABLE `rate_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_type`
--
ALTER TABLE `restaurant_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_make`
--
ALTER TABLE `vehicle_make`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_model`
--
ALTER TABLE `vehicle_model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calculation_method`
--
ALTER TABLE `calculation_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chain_type`
--
ALTER TABLE `chain_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_type`
--
ALTER TABLE `customer_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `group_privilege`
--
ALTER TABLE `group_privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `guide`
--
ALTER TABLE `guide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `guide_type`
--
ALTER TABLE `guide_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `hotel_facility`
--
ALTER TABLE `hotel_facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hotel_type`
--
ALTER TABLE `hotel_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `internal_formbuilder`
--
ALTER TABLE `internal_formbuilder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `internal_menu`
--
ALTER TABLE `internal_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `internal_menu1`
--
ALTER TABLE `internal_menu1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `internal_resource_locations`
--
ALTER TABLE `internal_resource_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `restaurant_type`
--
ALTER TABLE `restaurant_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicle_make`
--
ALTER TABLE `vehicle_make`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicle_model`
--
ALTER TABLE `vehicle_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
