-- 
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(4) NOT NULL auto_increment,
  `body` text NOT NULL,
  `timestamp` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 ;


-- --------------------------------------------------------

-- 
-- Table structure for table `settings`
-- 

CREATE TABLE `settings` (
  `id` int(1) NOT NULL auto_increment,
  `dayColor` varchar(6) NOT NULL,
  `weekendColor` varchar(6) NOT NULL,
  `todayColor` varchar(6) NOT NULL,
  `eventColor` varchar(6) NOT NULL,
  `iteratorColor1` varchar(6) NOT NULL,
  `iteratorColor2` varchar(6) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `settings`
-- 

INSERT INTO `settings` (`id`, `dayColor`, `weekendColor`, `todayColor`, `eventColor`, `iteratorColor1`, `iteratorColor2`) VALUES 
(1, 'e6e1d3', 'a0a395', 'ffeb45', 'fa0032', 'e6ffab', 'ffffff');

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `id` int(3) NOT NULL auto_increment,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` (`id`, `username`, `password`) VALUES 
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');
