<?php

namespace AppBundle\Security;

use AppBundle\Entity\TaskListInterface;
use AppBundle\Entity\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class TaskListVoter extends Voter
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

        if (!$subject instanceof TaskListInterface) {
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

        /** @var TaskListInterface $taskList */
        $taskList = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($taskList, $user);
            case self::VIEW:
                return $this->canView($taskList, $user);
            case self::DELETE:
                return $this->canDelete($taskList, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canEdit(TaskListInterface $taskList, UserInterface $user)
    {
        return $user === $taskList->getUser();
    }

    private function canView(TaskListInterface $taskList, UserInterface $user)
    {
        return $this->canEdit($taskList, $user);
    }

    private function canDelete(TaskListInterface $taskList, UserInterface $user)
    {
        return $this->canEdit($taskList, $user);
    }
}
