<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 */
class User extends BaseUser implements UserInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $lists;

    /**
     * @var string
     */
    protected $locale = 'en';

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->lists = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return UserInterface
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @param TaskListInterface $list
     *
     * @return UserInterface
     */
    public function addList(TaskListInterface $list)
    {
        if (false === $this->hasList($list)) {
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
    public function removeList(TaskListInterface $list)
    {
        if ($this->hasList($list)) {
            $this->lists->removeElement($list);
        }

        return $this;
    }

    /**
     * @param TaskListInterface $list
     *
     * @return bool
     */
    public function hasList(TaskListInterface $list)
    {
        return $this->lists->contains($list);
    }

    /**
     * @return ArrayCollection
     */
    public function getLists()
    {
        return $this->lists;
    }
}
