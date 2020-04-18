<?php

namespace Kematjaya\Tests\Breadcrumb;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class AppKernel extends Kernel 
{
    public function registerBundles()
    {
        return [
            new \Kematjaya\Breadcrumb\KmjBreadcrumbBundle()
        ];
    }
    
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        
    }
}
