CREATE TABLE IF NOT EXISTS `languages` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--//@UNDO
DROP TABLE IF EXISTS `languages`;