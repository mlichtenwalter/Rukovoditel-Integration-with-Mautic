<?php

namespace Mautic\Plugin\RukovoditelBundle\Form\Type\Integration;

use Mautic\CoreBundle\Form\Type\YesNoButtonGroupType;
use Mautic\Plugin\RukovoditelBundle\Transport\RukovoditelTransport;
use Mautic\CrmBundle\Form\Type\ConnectionSettingsType;
use Mautic\CrmBundle\Form\Type\FeaturesSettingsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class RukovoditelConfigurationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'connection',
                ConnectionSettingsType::class,
                [
                    'label' => 'mautic.integration.connection.settings',
                    'data_class' => RukovoditelTransport::class,
                ]
            )
            ->add(
                'features',
                FeaturesSettingsType::class,
                [
                    'label' => 'mautic.integration.features',
                    'choices' => [
                        'push_lead' => 'mautic.integration.push_lead',
                    ],
                    'data_class' => RukovoditelTransport::class,
                ]
            );
    }

    public function getBlockPrefix()
    {
        return 'integration_settings';
    }
}

?>