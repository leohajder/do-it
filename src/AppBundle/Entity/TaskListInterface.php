<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * TaskListInterface
 */
interface TaskListInterface
{
    /**
     * Get id
     *
     * @return integer
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
    public function setCreated($created);

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated();

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
     * @param TaskInterface $task
     *
     * @return bool
     */
    public function hasTask(TaskInterface $task);

    /**
     * Get tasks
     *
     * @return ArrayCollection
     */
    public function getTasks();

    /**
     * Set user
     *
     * @param UserInterface $user
     *
     * @return TaskListInterface
     */
    public function setUser(UserInterface $user = null);

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser();
}
