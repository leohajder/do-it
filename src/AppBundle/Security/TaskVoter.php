<?php

namespace AppBundle\Security;

use AppBundle\Entity\TaskInterface;
use AppBundle\Entity\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class TaskVoter extends Voter
{
    const EDIT = 'EDIT';
    const VIEW = 'VIEW';
    const DELETE = 'DELETE';

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        if (false === in_array($attribute, [
            self::EDIT,
            self::VIEW,
            self::DELETE
        ])) {
            return false;
        }

        if (!$subject instanceof TaskInterface) {
            return false;
        }

        return true;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     * It is safe to assume that $attribute and $subject already passed the "supports()" method check.
     *
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        /** @var TaskInterface $taskList */
        $task = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($task, $user);
            case self::VIEW:
                return $this->canView($task, $user);
            case self::DELETE:
                return $this->canDelete($task, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canEdit(TaskInterface $task, UserInterface $user)
    {
        return $user === $task->getList()->getUser();
    }

    private function canView(TaskInterface $task, UserInterface $user)
    {
        return $this->canEdit($task, $user);
    }

    private function canDelete(TaskInterface $task, UserInterface $user)
    {
        return $this->canEdit($task, $user);
    }
}