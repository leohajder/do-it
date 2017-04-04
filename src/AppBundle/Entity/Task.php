<?php

namespace AppBundle\Entity;

use AppBundle\Entity\TaskInterface;
use AppBundle\Entity\ListInterface;

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
    protected $content;

    /**
     * @var int
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
     * @var ListInterface
     */
    protected $list;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @param integer $priority
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
     * @return int
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
     * Set list
     *
     * @param ListInterface $list
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
     * @return ListInterface
     */
    public function getList()
    {
        return $this->list;
    }
}
