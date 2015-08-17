<?php
namespace AppBundle\Entity\Repository;

use AppBundle\Entity\SheetWord;
use Doctrine\ORM\EntityRepository;

class VocabularyRepository extends EntityRepository
{
    public function getAllWords($vocabularyId, $sheetId, $wordStatus = "all")
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('sheet_word')
            ->addSelect('RAND() as HIDDEN rand')
            ->from(SheetWord::class, 'sheet_word')
            ->innerJoin('sheet_word.sheet', 'sheet')
            ->innerJoin('sheet_word.word', 'word')
            ->innerJoin('sheet_word.sheetWordTranslations', 'sheetWordTranslations')
            ->innerJoin('sheetWordTranslations.translation', 'translation')
            ->addOrderBy('rand');

        if ($sheetId) {
            $queryBuilder
                ->where('sheet.sheetId = :sheetId')
                ->setParameter('sheetId', $sheetId);
        } else {
            $queryBuilder
                ->leftJoin('sheet.folder', 'folder')
                ->where('sheet.vocabulary = :vocabularyId')
                ->orWhere('folder.vocabulary = :vocabularyId')
                ->setParameter('vocabularyId', $vocabularyId);
        }

        if ($wordStatus == "notPassed") {
            $queryBuilder
                ->andWhere("sheet_word.translationStatistic <= 0");
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }
}