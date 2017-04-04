<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\TaskInterface;

/**
 * User
 */
class User extends BaseUser implements UserInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var TaskListInterface[]
     */
    protected $lists;

    /**
     * Set lists
     *
     * @param ArrayCollection $lists
     *
     * @return UserInterface
     */
    public function setLists(ArrayCollection $lists)
    {
        $this->lists = $lists;

        return $this;
    }

    /**
     * Get lists
     *
     * @return TaskListInterface[]
     */
    public function getLists()
    {
        return $this->lists;
    }

    /**
     * Add list
     *
     * @param TaskListInterface $list
     *
     * @return UserInterface
     */
    public function addlist(TaskListInterface $list)
    {
        if (false === $this->haslist($list)) {
            $this->lists->add($list);
        }

        return $this;
    }

    /**
     * Remove list
     *
     * @param TaskListInterface $list
     *
     * @return UserInterface
     */
    public function removelist(TaskListInterface $list)
    {
        if ($this->haslist($list)) {
            $this->lists->remove($list);
        }

        return $this;
    }

    /**
     * Has list
     *
     * @param  TaskListInterface $list
     *
     * @return boolean
     */
    public function hasList(TaskListInterface $list)
    {
        return $this->lists->contains($list);
    }

    /**
     * User constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->lists = new ArrayCollection();
    }
}
