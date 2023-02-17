<?php

namespace Mautic\Plugin\RukovoditelBundle\Rukovoditel\Integration;

use Mautic\Plugin\RukovoditelBundle\Rukovoditel\RukovoditelAPI;
use Mautic\Plugin\RukovoditelBundle\Rukovoditel\Form\Type\ConfigType;
use Mautic\CoreBundle\Helper\CacheStorageHelper;
use Mautic\IntegrationsBundle\Integration\AbstractIntegration;
use Mautic\IntegrationsBundle\Integration\Interfaces\ConfigFormInterface;
use Mautic\IntegrationsBundle\Integration\Interfaces\ConnectionTestInterface;
use Mautic\IntegrationsBundle\Integration\Interfaces\SyncInterface;

public function isPublished()
{
    return true;
}


/**
 * Class RukovoditelIntegration
 */
class RukovoditelIntegration extends AbstractIntegration implements ConfigFormInterface, ConnectionTestInterface, SyncInterface
{
    /**
     * @var RukovoditelAPI
     */
    private $api;

    /**
     * RukovoditelIntegration constructor.
     *
     * @param RukovoditelAPI $api
     * @param CacheStorageHelper $cacheStorageHelper
     */
    public function __construct(RukovoditelAPI $api, CacheStorageHelper $cacheStorageHelper)
    {
        $this->api                 = $api;
        $this->cacheStorageHelper  = $cacheStorageHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'Rukovoditel';
    }

    /**
     * {@inheritdoc}
     */
    public function getIcon(): string
    {
        return 'plugins/MauticRukovoditelBundle/Assets/img/Rukovoditel.png';
    }

    /**
     * {@inheritdoc}
     */
    public function getSupportedFeatures(): array
    {
        return [
            'push_lead'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFormName(): string
    {
        return ConfigType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getConnectionTester()
    {
        return $this->api;
    }

    /**
     * {@inheritdoc}
     */
    public function getSyncIntegrations()
    {
        // TODO: Implement getSyncIntegrations() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getSyncMappedObjects()
    {
        // TODO: Implement getSyncMappedObjects() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getSyncQueries()
    {
        // TODO: Implement getSyncQueries() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getSyncObjectName()
    {
        // TODO: Implement getSyncObjectName() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getSyncPriority()
    {
        // TODO: Implement getSyncPriority() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getSyncCanRunInBackground()
    {
        // TODO: Implement getSyncCanRunInBackground() method.
    }
}


?>