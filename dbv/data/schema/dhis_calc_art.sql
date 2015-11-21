CREATE TABLE `dhis_calc_art` (
  `calc_art_ID` int(11) NOT NULL AUTO_INCREMENT,
  `county_ID` int(11) NOT NULL,
  `sub_county_ID` int(11) NOT NULL,
  `facility_ID` int(11) NOT NULL,
  `period` date NOT NULL,
  `total_children_starting` int(11) NOT NULL,
  `total_adults_starting` int(11) NOT NULL,
  `net_overall_cohort` int(11) NOT NULL,
  `alive_on_art` int(11) NOT NULL,
  `retained_on_art` int(11) NOT NULL COMMENT '%, 1/2',
  PRIMARY KEY (`calc_art_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1