CREATE TABLE `eid_calc` (
  `eid_calc_ID` int(11) NOT NULL AUTO_INCREMENT,
  `county_ID` int(11) NOT NULL,
  `sub_county_ID` int(11) NOT NULL,
  `period` date NOT NULL,
  `cumulative_test` int(11) NOT NULL,
  `cumulative_negative` int(11) NOT NULL,
  `cumulative_positive` int(11) NOT NULL,
  `cumulative_onTx` int(11) NOT NULL,
  `cumulative_invalid` int(11) NOT NULL,
  PRIMARY KEY (`eid_calc_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1