<?php

namespace AntonAm\Telegraph\Services;

use AntonAm\Telegraph\Interfaces\ServiceInterface;
use AntonAm\Telegraph\Manager;

/**
 * Class Base
 *
 * @package  AntonAm\Telegraph\Services
 */
abstract class Base implements ServiceInterface
{
    protected $manager;
    protected $entity;

    public function __construct(Manager $manager, $entity = null)
    {
        $this->manager = $manager;
        $this->entity = $entity;
    }
}