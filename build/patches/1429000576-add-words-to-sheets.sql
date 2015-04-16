CREATE TABLE IF NOT EXISTS `sheets_words` (
  `sheet_word_id` int(11) NOT NULL AUTO_INCREMENT,
  `sheet_id` int(11) NOT NULL,
  `word_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`sheet_word_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--//@UNDO
DROP TABLE IF EXISTS `sheets_words`;