<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\UserInterface as BaseUserInterface;
use AppBundle\Entity\TaskListInterface;
use Doctrine\Common\Collections\ArrayCollection;

interface UserInterface extends BaseUserInterface
{
    /**
     * Set lists
     *
     * @param ArrayCollection $lists
     *
     * @return UserInterface
     */
    public function setLists(ArrayCollection $lists);

    /**
     * Get lists
     *
     * @return TaskListInterface[]
     */
    public function getlists();

    /**
     * Add list
     *
     * @param TaskListInterface $list
     *
     * @return UserInterface
     */
    public function addlist(TaskListInterface $list);

    /**
     * Remove list
     *
     * @param TaskListInterface $list
     *
     * @return UserInterface
     */
    public function removelist(TaskListInterface $list);

    /**
     * Has list
     *
     * @param  TaskListInterface $list
     *
     * @return boolean
     */
    public function hasList(TaskListInterface $list);
}
