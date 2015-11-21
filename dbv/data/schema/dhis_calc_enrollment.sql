CREATE TABLE `dhis_calc_enrollment` (
  `calc_enrollment_ID` int(11) NOT NULL AUTO_INCREMENT,
  `county_ID` int(11) NOT NULL,
  `sub_county_ID` int(11) NOT NULL,
  `facility_ID` int(11) NOT NULL,
  `period` date NOT NULL,
  `total_children` int(11) NOT NULL,
  `total_adults` int(11) NOT NULL,
  `total` int(11) NOT NULL COMMENT 'total children + total adults',
  `cum_children` int(11) NOT NULL COMMENT 'cumulative children monthly',
  `cum_adults` int(11) NOT NULL COMMENT 'cumulative adults monthly',
  `cum_total` int(11) NOT NULL COMMENT 'cumulative total children + cumulative total adults',
  PRIMARY KEY (`calc_enrollment_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1