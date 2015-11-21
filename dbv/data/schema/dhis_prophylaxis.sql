CREATE TABLE `dhis_prophylaxis` (
  `prophylaxis_ID` int(11) NOT NULL AUTO_INCREMENT,
  `county_ID` int(11) NOT NULL,
  `sub_county_ID` int(11) NOT NULL,
  `facility_ID` int(11) NOT NULL,
  `period` date NOT NULL,
  `haart` int(11) NOT NULL,
  `option_a` int(11) NOT NULL,
  `interrupted_haart` int(11) NOT NULL,
  `nvp` int(11) NOT NULL,
  PRIMARY KEY (`prophylaxis_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1