<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\TaskInterface;
use AppBundle\Entity\TaskListInterface;
use AppBundle\Entity\UserInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\NotBlank;

class TaskType extends AbstractType
{
    /**
     * @var string $dataClass
     */
    protected $dataClass;

    /**
     * @var string $taskListClass
     */
    protected $taskListClass;

    /**
     * @var EntityRepository $taskListRepository
     */
    protected $taskListRepository;

    /**
     * @var TokenStorageInterface $tokenStorage
     */
    protected $tokenStorage;

    /**
     * TaskType constructor.
     *
     * @param string $dataClass
     * @param string $taskListClass
     * @param EntityRepository $taskListRepository
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        $dataClass,
        $taskListClass,
        EntityRepository $taskListRepository,
        TokenStorageInterface $tokenStorage
    ) {
        $this->dataClass = $dataClass;
        $this->taskListClass = $taskListClass;
        $this->taskListRepository = $taskListRepository;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'       => 'form.task.title',
                'required'    => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('content', TextareaType::class, [
                'label'       => 'form.task.content',
                'required'    => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('priority', ChoiceType::class, [
                'label'       => 'form.task.priority',
                'choices'     => $options['priorities'],
                'required'    => false,
            ])
            ->add('dueDate', DateType::class, [
                'label'       => 'form.task.due_date',
                'widget'      => 'single_text',
                'required'    => false,
                'constraints' => [
                    new DateTime(),
                ],
            ])
            ->add('list', EntityType::class, [
                'label'       => 'form.task.list',
                'class'       => $this->taskListClass,
                'choices'     => $options['taskLists'],
                'choice_label' => function(TaskListInterface $taskList) {
                    return $taskList->getName();
                },
                'constraints' => [
                  new NotBlank(),
                ],
            ])
            ->add('completed', CheckboxType::class, [
                'label'       => 'form.task.completed',
                'required'    => false,
            ])
        ;

        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
                $data = $event->getData();
                $data->getCompleted() ? $data->setCompleted(true) : $data->setCompleted(null);
            })
            ->addEventListener(FormEvents::SUBMIT, function(FormEvent $event) {
                /** @var TaskInterface $data */
                $data = $event->getData();
                $data->getCompleted() ? $data->setCompleted(new \DateTime()) : $data->setCompleted(null);
            })
        ;
    }

    /**
     * @return UserInterface
     */
    private function getCurrentUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }

    /**
     * @return TaskListInterface[]
     */
    private function getListsByCurrentUser()
    {
        return $this->taskListRepository->findBy([
            'user' => $this->getCurrentUser(),
        ]);
    }

    /**
     * @return array
     */
    private function getPriorityChoices()
    {
        return [
            'form.task.priority_choice.1' => 1,
            'form.task.priority_choice.2' => 2,
            'form.task.priority_choice.3' => 3,
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => $this->dataClass,
            'taskLists'  => $this->getListsByCurrentUser(),
            'priorities' => $this->getPriorityChoices(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_task';
    }
}
