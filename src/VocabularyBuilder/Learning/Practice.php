<?php
namespace VocabularyBuilderComponent\Learning;

use DateTime;

class Practice
{
    /** @var bool */
    private $passed;

    /** @var array */
    private $tries;

    public function __construct()
    {
        $this->passed = false;
        $this->tries = [];
    }

    public function setPassed($passed)
    {
        $this->passed = $passed;
    }

    /** @return bool */
    public function getPassed()
    {
        return $this->passed;
    }

    public function setTries($tries)
    {
        $this->tries = $tries;
    }

    public function getTries()
    {
        return $this->tries;
    }

    public function addTry()
    {
        $this->tries[] = new DateTime();
    }

    public function getTriesCount()
    {
        return count($this->tries);
    }
}