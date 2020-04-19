<?php

namespace Kematjaya\Tests\Breadcrumb;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class AppKernel extends Kernel 
{
    public function registerBundles()
    {
        return [
            new \Kematjaya\Breadcrumb\KmjBreadcrumbBundle(),
            new FrameworkBundle()
        ];
    }
    
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) use ($loader) 
        {
            $loader->load(__DIR__ .'/config.xml');
            
            $container->addObjectResource($this);
        });
    }
}
