<?php

namespace Mautic\Plugin\MauticCRMBundle\Rukovoditel\Transport;

use Mautic\CrmBundle\Api\AbstractCrmApi;
use Mautic\CrmBundle\Integration\AbstractIntegration;
use Mautic\CrmBundle\Transport\AbstractTransport;
use Mautic\Plugin\MauticCRMBundle\Rukovoditel\RukovoditelAPI;

class RukovoditelTransport extends AbstractTransport
{
    /**
     * @var RukovoditelAPI
     */
    protected $api;

    /**
     * RukovoditelTransport constructor.
     *
     * @param AbstractIntegration $integration
     * @param array $settings
     * @param AbstractCrmApi $api
     */
    public function __construct(AbstractIntegration $integration, array $settings, AbstractCrmApi $api)
    {
        $this->api = $api;

        parent::__construct($integration, $settings);
    }

    /**
     * {@inheritdoc}
     */
    public function pushLead(array $lead, $mapping = null, $objects = null)
    {
        return $this->api->insertContact($lead);
    }

    /**
     * {@inheritdoc}
     */
    public function getSupportedFeatures()
    {
        return [
            self::FEATURE_PUSH_LEAD
        ];
    }
}
?>