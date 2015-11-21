CREATE TABLE `dhis_enrollment` (
  `enrollment_ID` int(11) NOT NULL AUTO_INCREMENT,
  `county_ID` int(11) NOT NULL,
  `sub_county_ID` int(11) NOT NULL,
  `facility_ID` int(11) NOT NULL,
  `period` date NOT NULL,
  `female_under_15` int(11) NOT NULL,
  `male_under_15` int(11) NOT NULL,
  `female_above_15` int(11) NOT NULL,
  `male_above_15` int(11) NOT NULL,
  PRIMARY KEY (`enrollment_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1