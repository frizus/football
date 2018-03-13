<?php

/**
 * Class DataValidator
 */
class DataValidator extends Validator
{
    /**
     * @var string
     */
    public $file;

    /**
     * @return bool
     */
    public function isFileExists()
    {
        if (!file_exists($this->file))
        {
            $this->errorMessages[] = 'Файл "' . $this->file . '" с массивом футбольных команд не найден.';
            return false;
        }

        return true;
    }

    /**
     * @param $data
     * @return bool
     */
    public function validate($data)
    {
        if (!isset($data) || !is_array($data) || empty($data))
        {
            $this->errorMessages[] = 'Структура данных массива футбольных команд из файла "' . $this->file . '" нарушена .';
            return false;
        }

        return true;
    }
}