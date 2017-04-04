<?php

namespace AppBundle\Entity;

use AppBundle\Entity\ListInterface;

/**
 * TaskInterface
 */
interface TaskInterface
{
    /**
     * Get id
     *
     * @return int
     */
    public function getId();

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
     * @param integer $priority
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
     * @param ListInterface $list
     *
     * @return TaskInterface
     */
    public function setList($list);

    /**
     * Get list
     *
     * @return ListInterface
     */
    public function getList();
}
