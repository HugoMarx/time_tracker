<?php

namespace App\Form;

use DateTime;
use App\Entity\Slot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SlotFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'choice',
                'data' => new DateTime()
            ])
            ->add('startTime', TimeType::class, [
                'widget' => 'text'
            ])
            ->add('endTime', TimeType::class, [
                'widget' => 'text',
            ])
            ->add('stressLevel', ChoiceType::class, [
                'choices' => [
                    '😀' => 0,
                    '😋' => 1,
                    '🙂' => 2,
                    '😑' => 3,
                    '😬' => 4,
                    '🥵' => 5,
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => [
                    'class' => 'radio'
                ],
                'choice_attr' =>  function () {
                    return ['class' => 'mx-2'];
                }
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'button is-link'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Slot::class,
        ]);
    }
}
