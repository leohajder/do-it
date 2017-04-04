<?php

namespace AppBundle\Entity;

use AppBundle\Entity\TaskInterface;
use AppBundle\Entity\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TaskList
 */
class TaskList implements TaskListInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var TaskInterface[]
     */
    protected $tasks;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * Get id
     *
     * @return int
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
    public function setCreated(\DateTime $created)
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
     * Set tasks
     *
     * @param ArrayCollection $tasks
     *
     * @return TaskListInterface
     */
    public function setTasks(ArrayCollection $tasks)
    {
        $this->tasks = $tasks;

        return $this;
    }

    /**
     * Get tasks
     *
     * @return TaskInterface[]
     */
    public function getTasks()
    {
        return $this->tasks;
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
            $this->tasks->remove($task);
        }

        return $this;
    }

    /**
     * Has task
     *
     * @param  TaskInterface $task
     *
     * @return boolean
     */
    public function hasTask(TaskInterface $task)
    {
        return $this->tasks->contains($task);
    }

    /**
     * Set user
     *
     * @param UserInterface $user
     *
     * @return TaskListInterface
     */
    public function setUser(UserInterface $user)
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


    /**
     * TaskList constructor
     */
    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }
}
