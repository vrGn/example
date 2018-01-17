<?php

namespace AppBundle\Form;

use AppBundle\Entity\ExampleForm;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ExampleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('last_name', TextType::class, array(
                'label' => 'Last Name',
                'attr' => array(
                    'class' => 'rus-40 rus-num'
                )
            ))
            ->add('first_name', TextType::class, array(
                'label' => 'First Name',
                'attr' => array(
                    'class' => 'rus-40 rus-num'
                )
            ))
            ->add('middle_name', TextType::class, array(
                'label' => 'Middle Name',
                'attr' => array(
                    'class' => 'rus-40 rus-num'
                )
            ))
            ->add('email_address', EmailType::class, array(
                'label' => 'Email'
            ))

            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ExampleForm::class,
        ));
    }
}
