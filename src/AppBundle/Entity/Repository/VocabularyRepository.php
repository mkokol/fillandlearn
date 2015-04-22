<?php
namespace AppBundle\Entity\Repository;

use AppBundle\Entity\SheetWord;
use Doctrine\ORM\EntityRepository;

class VocabularyRepository extends EntityRepository
{
    public function getAllWords($vocabularyId)
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('sheet_word', 'word', 'sheetWordTranslations', 'translation')
            ->addSelect('RAND() as HIDDEN rand')
            ->from(SheetWord::class, 'sheet_word')
            ->innerJoin('sheet_word.sheet', 'sheet')
            ->leftJoin('sheet.folder', 'folder')
            ->innerJoin('sheet_word.word', 'word')
            ->innerJoin('sheet_word.sheetWordTranslations', 'sheetWordTranslations')
            ->innerJoin('sheetWordTranslations.translation', 'translation')
            ->where('sheet.vocabulary = :vocabularyId')
            ->orWhere('folder.vocabulary = :vocabularyId')
            ->setParameter('vocabularyId', $vocabularyId)
            ->addOrderBy('rand');

        return $qb
            ->getQuery()
            ->getResult();
    }
}