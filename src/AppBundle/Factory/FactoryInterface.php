<?php
/**
 * Created by PhpStorm.
 * User: leo.hajder
 * Date: 4/13/17
 * Time: 10:02 AM
 */

namespace AppBundle\Factory;


/**
 * Factory
 */
interface FactoryInterface
{
    /**
     * @return mixed
     */
    public function createNew();
}