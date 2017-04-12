<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * TaskList
 */
class TaskList implements TaskListInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var ArrayCollection
     */
    private $tasks;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tasks = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return TaskListInterface
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return TaskListInterface
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Add task
     *
     * @param TaskInterface $task
     *
     * @return TaskListInterface
     */
    public function addTask(TaskInterface $task)
    {
        if (false === $this->hasTask($task)) {
            $this->tasks->add($task);
        }

        return $this;
    }

    /**
     * Remove task
     *
     * @param TaskInterface $task
     *
     * @return TaskListInterface
     */
    public function removeTask(TaskInterface $task)
    {
        if ($this->hasTask($task)) {
            $this->tasks->removeElement($task);
        }

        return $this;
    }

    /**
     * @param TaskInterface $task
     *
     * @return bool
     */
    public function hasTask(TaskInterface $task)
    {
        return $this->tasks->contains($task);
    }

    /**
     * Get tasks
     *
     * @return ArrayCollection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Set user
     *
     * @param UserInterface $user
     *
     * @return TaskListInterface
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }
}

