<?php

/**
 * Class FootballValidator
 */
class FootballValidator extends Validator
{
    /**
     * @var TeamsFootball
     */
    protected $teamsFootball;

    /**
     * @param $index
     * @return bool
     */
    public function validate($index)
    {
        if (!array_key_exists($index, $this->teamsFootball->data))
        {
            $this->errorMessages[] = 'Футбольной команды с номером #' . $index . ' нет.';
            $this->errorMessages[] = 'У футбольных команд номера от 0 до ' . $this->teamsFootball->getMaxTeamNumber() . '.';
            return false;
        }

        return true;
    }
}