<?php

namespace Kematjaya\Breadcrumb;

use Kematjaya\Breadcrumb\Extension\BreadcrumbCompilerPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class KmjBreadcrumbBundle extends Bundle
{
    public function build(ContainerBuilder $container):void
    {
        $container->addCompilerPass(new BreadcrumbCompilerPass());

        parent::build($container);
    }
}
