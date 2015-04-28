ALTER TABLE `sheets_words` ADD `translation_statistic` int(11) NOT NULL DEFAULT 0 AFTER `statistic`;

UPDATE `sheets_words` SET `statistic` = '{"__jsonclass__":"VocabularyBuilder\\\\Learning\\\\Statistic","practiceTranslation":[{"__jsonclass__":"VocabularyBuilder\\\\Learning\\\\Practice","passed":false,"tries":[]}]}';

--//@UNDO
ALTER TABLE `sheets_words` DROP `translation_statistic`;