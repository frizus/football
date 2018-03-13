<?php

/**
 * Class Math
 */
class Math
{
    /**
     * Вычисление факториала
     * @param $x
     * @return float|int
     */
    public static function getFactorial($x)
    {
        $factorial = 1;

        for ($i = $x; $i >= 1; $i--)
        {
            $factorial *= $i;
        }

        return $factorial;
    }

    /**
     * Вычисление распределения Пуассона
     * @param $u
     * @param $x
     * @return float|int
     */
    public static function getPoissonDistribution($u, $x)
    {
        return pow(M_E, -$u) * (pow($u, $x)) / Math::getFactorial($x);
    }
}