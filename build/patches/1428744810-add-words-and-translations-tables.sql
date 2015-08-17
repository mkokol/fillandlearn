CREATE TABLE IF NOT EXISTS `words` (
  `word_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `word` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`word_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `translations` (
  `translation_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `word_id` int(11) NOT NULL,
  `translation` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`translation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--//@UNDO
DROP TABLE IF EXISTS `words`;
DROP TABLE IF EXISTS `translations`;
