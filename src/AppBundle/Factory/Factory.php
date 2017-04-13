<?php

namespace AppBundle\Factory;

/**
 * Factory
 */
class Factory implements FactoryInterface
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @param string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function createNew()
    {
        return new $this->class();
    }
}
