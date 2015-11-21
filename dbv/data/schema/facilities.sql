CREATE TABLE `facilities` (
  `facility_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MFL_Code` varchar(20) NOT NULL,
  `facility_name` varchar(100) NOT NULL,
  `sub_county_ID` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`facility_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1