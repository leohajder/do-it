<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\UserInterface as BaseUserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UserInterface
 */
interface UserInterface extends BaseUserInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale();

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return UserInterface
     */
    public function setLocale($locale);

    /**
     * @param TaskListInterface $list
     *
     * @return UserInterface
     */
    public function addList(TaskListInterface $list);

    /**
     * Remove list
     *
     * @param TaskListInterface $list
     */
    public function removeList(TaskListInterface $list);

    /**
     * @param TaskListInterface $list
     *
     * @return bool
     */
    public function hasList(TaskListInterface $list);

    /**
     * @return ArrayCollection
     */
    public function getLists();
}
