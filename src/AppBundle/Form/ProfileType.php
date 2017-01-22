<?php
/**
 * Created by PhpStorm.
 * User: spajx
 * Date: 29.5.16
 * Time: 11:24
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ProfileType
 * @package AppBundle\Form
 */
class ProfileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('avatarFile');
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

}