<?php

/**
 * Class SameTeamValidator
 */
class SameTeamValidator extends Validator
{
    /**
     * @param $c1
     * @param $c2
     * @return bool
     */
    public function validate($c1, $c2)
    {
        if ($c1 == $c2)
        {
            $this->errorMessages[] = 'Команда #' . $c1 . ' не может играть против себя же.';
            return false;
        }

        return true;
    }
}