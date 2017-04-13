<?php

namespace AppBundle\Form;

use AppBundle\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\NotBlank;

class TaskType extends AbstractType
{
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
                ]
            ])
            ->add('content', TextareaType::class, [
                'label'       => 'form.task.content',
                'required'    => true,
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('priority', TextType::class, [
                'label'       => 'form.task.priority',
                'required'    => false,
            ])
            ->add('dueDate', DateTimeType::class, [
                'label'       => 'form.task.due_date',
                'required'    => false,
                'constraints' => [
                    new DateTime(),
                ]
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
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
