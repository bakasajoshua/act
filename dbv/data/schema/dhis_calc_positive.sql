CREATE TABLE `dhis_calc_positive` (
  `calc_positive_ID` int(11) NOT NULL AUTO_INCREMENT,
  `county_ID` int(11) NOT NULL,
  `sub_county_ID` int(11) NOT NULL,
  `facility_ID` int(11) NOT NULL,
  `period` date NOT NULL,
  `total_children` int(11) NOT NULL,
  `total_adults` int(11) NOT NULL,
  `total` int(11) NOT NULL COMMENT 'total children + total adults',
  `cum_children` int(11) NOT NULL,
  `cum_adults` int(11) NOT NULL,
  `cum_total` int(11) NOT NULL COMMENT 'cu',
  `pregnant_mothers` int(11) NOT NULL,
  PRIMARY KEY (`calc_positive_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1