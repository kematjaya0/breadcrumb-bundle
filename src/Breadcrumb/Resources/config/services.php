<?php

declare(strict_types=1);

use Kematjaya\Breadcrumb\Extension\BreadcrumbsExtension;
use Kematjaya\Breadcrumb\Helper\BreadcrumbHelper;
use Kematjaya\Breadcrumb\Lib\Breadcrumb;
use Kematjaya\Breadcrumb\Lib\Builder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container): void {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->set(Breadcrumb::class);
    $services->set(Builder::class)
        ->call('setRouter', [service('router')]);
    $services->alias('kematjaya.breadcrumbs_builder', Builder::class)
        ->public();

    $services->set(BreadcrumbHelper::class)
        ->args([
            service('twig'),
            service('kematjaya.breadcrumbs_builder'),
            service('service_container'),
        ]);
    $services->alias('kematjaya.breadcrumbs_helper', BreadcrumbHelper::class)
        ->public();

    $services->set(BreadcrumbsExtension::class)
        ->args([service('kematjaya.breadcrumbs_helper')])
        ->tag('twig.extension');
    $services->alias('kematjaya.breadcrumbs_extension', BreadcrumbsExtension::class)
        ->public();
};
