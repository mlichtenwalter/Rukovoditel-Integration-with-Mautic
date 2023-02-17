<?php

namespace Mautic\Plugin\RukovoditelBundle\Transport;

use Mautic\CrmBundle\Integration\Interfaces\TransportFactoryInterface;
use Mautic\CrmBundle\Integration\Interfaces\TransportInterface;
use Mautic\Plugin\RukovoditelBundle\RukovoditelAPI;
use Symfony\Component\Form\FormBuilder;

class RukovoditelTransportFactory implements TransportFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createTransport(array $settings): TransportInterface
    {
        return new RukovoditelTransport($settings);
    }

    /**
     * {@inheritdoc}
     */
    public function getSettingsForm(FormBuilder $builder, array $settings): FormBuilder
    {
        return $builder;
    }

    /**
     * {@inheritdoc}
     */
    public function getTransportSettings(): array
    {
        return [];
    }
}
?>