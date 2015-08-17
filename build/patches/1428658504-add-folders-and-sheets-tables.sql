CREATE TABLE IF NOT EXISTS `folders` (
  `folder_id` int(11) NOT NULL AUTO_INCREMENT,
  `vocabulary_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`folder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `sheets` (
  `sheet_id` int(11) NOT NULL AUTO_INCREMENT,
  `vocabulary_id` int(11) NULL,
  `folder_id` int(11) NULL,
  `name` varchar(255) NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`sheet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--//@UNDO
DROP TABLE IF EXISTS `folders`;
DROP TABLE IF EXISTS `sheets`;