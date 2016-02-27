<?php

namespace Bones\UserBundle\Form\Registration;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

abstract class AbstractRegistrationType extends AbstractType
{
    const ROLE_TYPE = "ROLE_ABSTRACT";
    const NAME = 'bones_user_registration';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', 'hidden', array(
            'data' => static::ROLE_TYPE,
            'mapped' => false
        ));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return static::NAME;
    }
}