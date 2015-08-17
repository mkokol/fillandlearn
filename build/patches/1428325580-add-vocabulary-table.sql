CREATE TABLE IF NOT EXISTS `vocabularies` (
  `vocabulary_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `primary_language_id` int(11) NOT NULL,
  `secondary_language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`vocabulary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--//@UNDO
DROP TABLE IF EXISTS `vocabularies`;