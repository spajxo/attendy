<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimeEntryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'date',
            DateTimeType::class,
            [
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
                'attr' => [
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd.mm.yyyy',
                    'data-date-today-highlight' => 'true',
                ],
            ]
        )->add(
            'timeIn',
            TimeType::class,
            [
                'widget' => 'single_text',
                'html5' => false,
                'input' => 'string',
                'required' => false,
                'attr' => [
                    'class' => 'timepicker',
                    'data-provide' => 'timepicker',
                    'data-show-meridian' => 'false',
                    'data-show-inputs' => 'false',
                    'data-default-time' => '8:00',
                ],
            ]
        )->add(
            'timeOut',
            TimeType::class,
            [
                'widget' => 'single_text',
                'html5' => false,
                'input' => 'string',
                'required' => false,
                'attr' => [
                    'class' => 'timepicker',
                    'data-provide' => 'timepicker',
                    'data-show-meridian' => 'false',
                    'data-show-inputs' => 'false',
                    'data-default-time' => '16:00',
                ],
            ]
        )->add(
            'break',
            IntegerType::class,
            [
                'required' => false,
                'attr' => [
                    'step' => 5,
                ],
            ]
        )->add('user');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\TimeEntry',
            )
        );
    }
}
