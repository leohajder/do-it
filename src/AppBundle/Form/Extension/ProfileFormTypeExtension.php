<?php

namespace AppBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfileFormTypeExtension extends AbstractTypeExtension
{

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return ProfileFormType::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('locale', ChoiceType::class, [
            'label'              => 'profile.show.locale',
            'translation_domain' => 'FOSUserBundle',
            'choices'            => [
                'en',
                'hr',
            ],
            'choice_label'       => function($key, $value) {
                return $key;
            },
            'constraints'        => [
                new NotBlank(),
            ],
        ]);
    }
}
