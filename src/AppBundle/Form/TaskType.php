<?php

namespace AppBundle\Form;

use AppBundle\Entity\TaskListInterface;
use AppBundle\Entity\UserInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
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
            ->add('priority', TextType::class, [
                'label'       => 'form.task.priority',
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
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => $this->dataClass,
            'taskLists'  => $this->getListsByCurrentUser(),
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
