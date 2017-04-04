<?php

namespace AppBundle\Entity;

use AppBundle\Entity\TaskInterface;
use AppBundle\Entity\TaskListInterface;

/**
 * Task
 */
class Task implements TaskInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $priority;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $completed;

    /**
     * @var TaskListInterface
     */
    protected $list;

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
     * Set title
     *
     * @param string $title
     *
     * @return TaskInterface
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return TaskInterface
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set priority
     *
     * @param string $priority
     *
     * @return TaskInterface
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return TaskInterface
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
     * Set completed
     *
     * @param \DateTime $completed
     *
     * @return TaskInterface
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get completed
     *
     * @return \DateTime
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Is completed
     *
     * @return boolean
     */
    public function isCompleted()
    {
        return $this->completed != null;
    }

    /**
     * Set list
     *
     * @param TaskListInterface $list
     *
     * @return TaskInterface
     */
    public function setList($list)
    {
        $this->list = $list;

        return $this;
    }

    /**
     * Get list
     *
     * @return TaskListInterface
     */
    public function getList()
    {
        return $this->list;
    }
}
