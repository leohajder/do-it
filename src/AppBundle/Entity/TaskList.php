<?php

namespace AppBundle\Entity;

use AppBundle\Entity\TaskInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TaskList
 */
class TaskList implements TaskListInterface
{
    /**
     * @var int
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
     * @var TaskInterface[]
     */
    private $tasks;

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
     * TaskList constructor
     */
    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }
}
