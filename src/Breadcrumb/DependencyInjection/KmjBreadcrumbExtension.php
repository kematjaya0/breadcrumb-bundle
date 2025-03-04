<?php

namespace Kematjaya\Breadcrumb\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class KmjBreadcrumbExtension extends Extension
{
    
    public function load(array $configs, ContainerBuilder $container) :void
    {
        $loader = new XmlFileLoader($container,
            new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }
}
