<?php

namespace AppBundle\Entity;

use AppBundle\Entity\UserInterface;
use AppBundle\Entity\TaskInterface;
use Doctrine\Common\Collections\ArrayCollection;

interface TaskListInterface
{
    /**
     * Get id
     *
     * @return int
     */
    public function getId();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return TaskListInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return TaskListInterface
     */
    public function setCreated(\DateTime $created);

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated();

    /**
     * Set tasks
     *
     * @param ArrayCollection $tasks
     *
     * @return TaskListInterface
     */
    public function setTasks(ArrayCollection $tasks);

    /**
     * Get tasks
     *
     * @return TaskInterface[]
     */
    public function getTasks();

    /**
     * Add task
     *
     * @param TaskInterface $task
     *
     * @return TaskListInterface
     */
    public function addTask(TaskInterface $task);

    /**
     * Remove task
     *
     * @param TaskInterface $task
     *
     * @return TaskListInterface
     */
    public function removeTask(TaskInterface $task);

    /**
     * Has task
     *
     * @param  TaskInterface $task
     *
     * @return boolean
     */
    public function hasTask(TaskInterface $task);

    /**
     * Set user
     *
     * @param UserInterface $user
     *
     * @return TaskListInterface
     */
    public function setUser(UserInterface $user);

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser();
}
