ALTER TABLE `sheets_words` ADD `statistic` TEXT AFTER `word_id`;

UPDATE `sheets_words` SET `statistic` = '{"__jsonclass__":"VocabularyBuilderComponent\\Learning\\Statistic","practiceTranslation":[{"__jsonclass__":"VocabularyBuilderComponent\\Learning\\Practice","passed":false,"tries":[]}]}';

--//@UNDO
ALTER TABLE `sheets_words` DROP `statistic`;