<?php
namespace VocabularyBuilder\Learning;

use Component\Serializer\SerializableTrait;

/**
 * @AccessType("private_method")
 */
class Statistic
{
    use SerializableTrait;

    /**
     * @var array $practiceTranslation
     *
     * @Include
     */
    private $practiceTranslation;

    public function __construct()
    {
        $this->practiceTranslation = [new Practice()];
    }

    public function setPracticeTranslation($practiceTranslation)
    {
        $this->practiceTranslation = $practiceTranslation;
    }

    /** @return Practice[] */
    public function getPracticeTranslation()
    {
        return $this->practiceTranslation;
    }

    public function addPracticeTranslation(Practice $practice)
    {
        $this->practiceTranslation[] = $practice;
    }

    public function updatePracticeStatus($status)
    {
        /** @var Practice $currentPracticeTranslation */
        $currentPracticeTranslation = end($this->practiceTranslation);

        if (!$status) {
            $currentPracticeTranslation->addTry();

            return;
        }

        if (!$currentPracticeTranslation->getPassed()) {
            $currentPracticeTranslation->addTry();
            $currentPracticeTranslation->setPassed(true);
        } else {
            $this->addPracticeTranslation(new Practice());
            $currentPracticeTranslation = end($this->practiceTranslation);
            $currentPracticeTranslation->addTry();
            $currentPracticeTranslation->setPassed(true);
        }
    }

    public function getCurrentTranslationStatistic()
    {
        /** @var Practice $currentPracticeTranslation */
        $currentPracticeTranslation = end($this->practiceTranslation);
        $triesCount = $currentPracticeTranslation->getTriesCount();
        $currentState = $currentPracticeTranslation->getPassed();

        return ($currentState) ? $triesCount : - $triesCount;
    }
}