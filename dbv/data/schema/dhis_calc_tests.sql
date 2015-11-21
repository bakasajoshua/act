CREATE TABLE `dhis_calc_tests` (
  `calc_tests_ID` int(11) NOT NULL AUTO_INCREMENT,
  `county_ID` int(11) NOT NULL,
  `sub_county_ID` int(11) NOT NULL,
  `facility_ID` int(11) NOT NULL,
  `period` date NOT NULL,
  `total_children` int(11) NOT NULL,
  `total_adults` int(11) NOT NULL,
  PRIMARY KEY (`calc_tests_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1