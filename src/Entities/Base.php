<?php

namespace AntonAm\Telegraph\Entities;

/**
 * Class Base
 *
 * @package  AntonAm\Telegraph\Entities
 */
class Base
{
    public function __construct($parameters = [])
    {
        foreach ($parameters as $key => $value) {
            $this->$key = $value;
        }
    }
}