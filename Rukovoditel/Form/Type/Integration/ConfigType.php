<?php
namespace Mautic\Plugin\RukovoditelBundle\Rukovoditel\Form\Type\Integration;

use Mautic\CoreBundle\Form\Type\YesNoButtonGroupType;
use Mautic\IntegrationsBundle\Form\Type\ConnectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ConfigType
 */
class ConfigType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'enabled',
            YesNoButtonGroupType::class,
            [
                'label' => 'mautic.plugin.rukovoditel.enabled',
                'data'  => true,
                'attr'  => [
                    'tooltip' => 'mautic.plugin.rukovoditel.enabled.tooltip',
                ],
            ]
        );

        $builder->add(
            'url',
            TextType::class,
            [
                'label'      => 'mautic.plugin.rukovoditel.url',
                'required'   => true,
                'attr'       => [
                    'placeholder' => 'mautic.plugin.rukovoditel.url.placeholder',
                ],
            ]
        );

        $builder->add(
            'username',
            TextType::class,
            [
                'label'      => 'mautic.plugin.rukovoditel.username',
                'required'   => true,
                'attr'       => [
                    'placeholder' => 'mautic.plugin.rukovoditel.username.placeholder',
                ],
            ]
        );

        $builder->add(
            'password',
            TextType::class,
            [
                'label'      => 'mautic.plugin.rukovoditel.password',
                'required'   => true,
                'attr'       => [
                    'placeholder' => 'mautic.plugin.rukovoditel.password.placeholder',
                ],
            ]
        );

        $builder->add(
            'fetch_frequency',
            TextType::class,
            [
                'label'    => 'mautic.plugin.rukovoditel.fetch_frequency',
                'required' => true,
                'attr'     => [
                    'placeholder' => 'mautic.plugin.rukovoditel.fetch_frequency.placeholder',
                ],
            ]
        );

        $builder->add(
            'fetch_enabled',
            YesNoButtonGroupType::class,
            [
                'label' => 'mautic.plugin.rukovoditel.fetch_enabled',
                'data'  => false,
                'attr'  => [
                    'tooltip' => 'mautic.plugin.rukovoditel.fetch_enabled.tooltip',
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'Rukovoditel_config';
    }
}
?>
