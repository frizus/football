<?php

/**
 * Class Component
 */
abstract class Component
{
    /**
     * Component constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        foreach($config as $name => $value)
        {
            if (property_exists($this, $name))
            {
                $this->{$name} = $value;
            }
        }
    }
}