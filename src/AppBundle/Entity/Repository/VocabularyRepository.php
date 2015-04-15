<?php
namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Vocabulary;
use AppBundle\Entity\Word;
use Doctrine\ORM\EntityRepository;

class VocabularyRepository extends EntityRepository
{
    public function getAllWords(Vocabulary $vocabulary)
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('w')
            ->from(Word::class, 'w')
            ->innerJoin('w.sheets', 's')
            ->leftJoin('s.folder', 'f')
            ->where('s.vocabulary = :vocabularyId')
            ->orWhere('f.vocabulary = :vocabularyId')
            ->setParameter('vocabularyId', $vocabulary->getVocabularyId());

        return $qb
            ->getQuery()
            ->getResult();
    }
}