<?php

namespace Kematjaya\Tests\Breadcrumb;

use Kematjaya\Breadcrumb\KmjBreadcrumbBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class AppKernel extends Kernel
{
    public function registerBundles(): iterable
    {
        return [
            new KmjBreadcrumbBundle(),
            new FrameworkBundle(),
            new TwigBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(function (ContainerBuilder $container) use ($loader): void {
            $loader->load(__DIR__ . '/config.xml');

            $container->addObjectResource($this);
        });
    }
}
