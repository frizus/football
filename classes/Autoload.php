<?php
/**
 * @param $className
 * @return bool
 */
function __autoload($className)
{
    $fileName = str_replace("\\", DIRECTORY_SEPARATOR, $className) . ".php";
    foreach(glob(__DIR__ . '/*' , GLOB_ONLYDIR) as $directory)
    {
        $path = str_replace("\\", DIRECTORY_SEPARATOR, $directory) . DIRECTORY_SEPARATOR . $fileName;
        if (file_exists($path))
        {
            include $path;
            if (class_exists($className))
            {
                return true;
            }
        }
    }

    return false;
}