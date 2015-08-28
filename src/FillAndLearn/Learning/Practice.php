<?php
namespace FillAndLearn\Learning;

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

    public function addTry($passed = null)
    {
        if ($passed !== null) {
            $this->passed = (bool) $passed;
        }

        $now = new DateTime();
        $this->tries[] = $now->format("d/m/Y H:i:s");
    }

    public function getTriesCount()
    {
        return count($this->tries);
    }
}
