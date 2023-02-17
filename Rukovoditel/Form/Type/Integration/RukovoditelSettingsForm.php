<?php

namespace Mautic\Plugin\RukovoditelBundle\Form\Type\Integration;

use Mautic\CoreBundle\Form\Type\FormButtonsType;
use Mautic\Plugin\RukovoditelBundle\Form\Type\ConnectionType;
use Mautic\Plugin\RukovoditelBundle\Form\Type\RukovoditelApiAuthType;
use Mautic\Plugin\RukovoditelBundle\Form\Type\RukovoditelSettingsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class RukovoditelSettingsForm.
 */
class RukovoditelSettingsForm extends AbstractType
{
    /**
     * Build the form.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('settings', RukovoditelSettingsType::class);
        $builder->add('save', FormButtonsType::class, [
            'apply_text' => 'mautic.core.form.apply',
            'save_text' => 'mautic.core.form.save',
            'attr' => ['class' => 'btn btn-primary'],
        ]);
    }

    /**
     * Get the name of the form.
     *
     * @return string
     */
    public function getName()
    {
        return 'rukovoditel_settings';
    }
}


?>