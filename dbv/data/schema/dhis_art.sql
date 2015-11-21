CREATE TABLE `dhis_art` (
  `art_ID` int(11) NOT NULL AUTO_INCREMENT,
  `county_ID` int(11) NOT NULL,
  `sub_county_ID` int(11) NOT NULL,
  `facility_ID` int(11) NOT NULL,
  `period` date NOT NULL,
  `female_under_15_starting` int(11) NOT NULL,
  `male_under_15_starting` int(11) NOT NULL,
  `female_above_15_starting` int(11) NOT NULL,
  `male_above_15_starting` int(11) NOT NULL,
  `art_net_cohort` int(11) NOT NULL COMMENT 'at 12',
  `on_original` int(11) NOT NULL COMMENT '1st line',
  `on_alternative_1` int(11) NOT NULL COMMENT '1st alternative',
  `on_alternative_2` int(11) NOT NULL COMMENT '2nd alternative',
  `known_positive_status` int(11) NOT NULL,
  PRIMARY KEY (`art_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1