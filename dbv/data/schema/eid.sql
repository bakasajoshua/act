CREATE TABLE `eid` (
  `eid_ID` int(11) NOT NULL AUTO_INCREMENT,
  `county_ID` int(11) NOT NULL,
  `sub_county_ID` int(11) NOT NULL,
  `facility_ID` int(11) NOT NULL,
  `MFL` varchar(20) NOT NULL,
  `period` date NOT NULL,
  `test` int(11) NOT NULL,
  `negative` int(11) NOT NULL,
  `positive` int(11) NOT NULL,
  `onTx` int(11) NOT NULL,
  `invalid` int(11) NOT NULL,
  PRIMARY KEY (`eid_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1