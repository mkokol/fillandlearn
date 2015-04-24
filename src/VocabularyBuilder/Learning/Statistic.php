<?php
namespace VocabularyBuilderComponent\Learning;

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
}