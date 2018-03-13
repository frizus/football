<?php

/**
 * Class Validator
 */
class Validator extends Component
{
    /**
     * @var array
     */
    protected $errorMessages = [];

    /**
     * @param $message
     */
    public function addMessage($message)
    {
        $this->errorMessages[] = $message;
    }

    /**
     * @param Exception|null $e
     * @throws Exception
     */
    public function throwError()
    {
        $message = '';

        foreach($this->errorMessages as $errorMessage)
        {
            $message .= $errorMessage . PHP_EOL;
        }

        throw new Exception($message);
    }
}