CREATE TABLE `sub_counties` (
  `sub_county_ID` int(11) NOT NULL AUTO_INCREMENT,
  `sub_county_name` varchar(100) NOT NULL,
  `county_ID` int(11) NOT NULL,
  PRIMARY KEY (`sub_county_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1