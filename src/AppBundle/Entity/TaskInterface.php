<?php

namespace AppBundle\Entity;

use AppBundle\Entity\TaskListInterface;

interface TaskInterface
{
    /**
     * Get id
     *
     * @return int
     */
    public function getId();

    /**
     * Set title
     *
     * @param string $title
     *
     * @return TaskInterface
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set content
     *
     * @param string $content
     *
     * @return TaskInterface
     */
    public function setContent($content);

    /**
     * Get content
     *
     * @return string
     */
    public function getContent();

    /**
     * Set priority
     *
     * @param string $priority
     *
     * @return TaskInterface
     */
    public function setPriority($priority);

    /**
     * Get priority
     *
     * @return string
     */
    public function getPriority();

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return TaskInterface
     */
    public function setCreated($created);

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated();

    /**
     * Set completed
     *
     * @param \DateTime $completed
     *
     * @return TaskInterface
     */
    public function setCompleted($completed);

    /**
     * Get completed
     *
     * @return \DateTime
     */
    public function getCompleted();

    /**
     * Is completed
     *
     * @return boolean
     */
    public function isCompleted();

    /**
     * Set list
     *
     * @param TaskListInterface $list
     *
     * @return TaskInterface
     */
    public function setlist(TaskListInterface $list);

    /**
     * Get list
     *
     * @return TaskListInterface
     */
    public function getList();
}
