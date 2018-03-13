<?php
include __DIR__ . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Autoload.php';

/**
 * @param $c1
 * @param $c2
 * @return array
 */
function match($c1, $c2)
{
    $rollScore = new Football([], __DIR__ . DIRECTORY_SEPARATOR . 'data.php');
    return $rollScore->getRollScore($c1, $c2);
}