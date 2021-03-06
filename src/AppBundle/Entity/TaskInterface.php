<?php

namespace AppBundle\Entity;

/**
 * TaskInterface
 */
interface TaskInterface
{
    /**
     * Get id
     *
     * @return integer
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
     * @param int $priority
     *
     * @return TaskInterface
     */
    public function setPriority($priority);

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority();

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     *
     * @return TaskInterface
     */
    public function setDueDate($dueDate);

    /**
     * Get dueDate
     *
     * @return \DateTime
     */
    public function getDueDate();

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
     * Set list
     *
     * @param TaskListInterface $list
     *
     * @return TaskInterface
     */
    public function setList(TaskListInterface $list = null);

    /**
     * Get list
     *
     * @return TaskListInterface
     */
    public function getList();
}
