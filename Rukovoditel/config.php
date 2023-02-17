<?php

return [
    'services' => [
        'plugin.RukovoditelBundle.rukovoditel_api' => [
            'class'     => Mautic\Plugin\RukovoditelBundle\Rukovoditel\RukovoditelAPI::class,
            'arguments' => [
                '%mautic.plugin.rukovoditel.settings.base_url%',
                '%mautic.plugin.rukovoditel.settings.username%',
                '%mautic.plugin.rukovoditel.settings.password%',
            ],
        ],
        'plugin.RukovoditelBundle.rukovoditel_transport' => [
            'class'     => Mautic\Plugin\RukovoditelBundle\Rukovoditel\Transport\RukovoditelTransport::class,
            'arguments' => [
                '@mautic.integrations',
                '%mautic.plugin.rukovoditel.settings%',
                '@plugin.RukovoditelBundle.rukovoditel_api',
            ],
        ],
        'plugin.RukovoditelBundle.rukovoditel_integration' => [
            'class'     => Mautic\Plugin\RukovoditelBundle\Rukovoditel\Integration\RukovoditelIntegration::class,
            'arguments' => [
                '@plugin.RukovoditelBundle.rukovoditel_api',
                '@mautic.helper.cache_storage',
            ],
            'tags'      => [
                'mautic.integration',
            ],
        ],
    ],
];
?>