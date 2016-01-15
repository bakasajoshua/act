ALTER TABLE `sub_counties` ADD UNIQUE (
 `sub_county_name` 
);

ALTER TABLE `facilities` ADD UNIQUE (
 `MFL_Code` 
);

ALTER TABLE  `dhis_calc_art` ADD  `total_starting` INT NOT NULL AFTER  `total_adults_starting` ,
ADD  `cum_children` INT NOT NULL AFTER  `total_starting` ,
ADD  `cum_adults` INT NOT NULL AFTER  `cum_children` ,
ADD  `cum_total` INT NOT NULL AFTER  `cum_adults` ;

ALTER TABLE  `dhis_calc_art` ADD  `prophylaxisHAART` INT NOT NULL ;