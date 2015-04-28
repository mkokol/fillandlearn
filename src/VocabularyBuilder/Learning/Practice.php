<?php
namespace VocabularyBuilder\Learning;

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
        $now = new DateTime();
        $this->tries[] = $now->format("d/m/Y H:i:s");
    }

    public function getTriesCount()
    {
        return count($this->tries);
    }
}