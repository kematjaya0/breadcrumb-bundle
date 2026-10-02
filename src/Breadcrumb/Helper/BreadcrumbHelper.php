<?php

namespace Kematjaya\Breadcrumb\Helper;

use Kematjaya\Breadcrumb\Lib\Builder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Templating\Helper\Helper;
use Twig\Environment;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class BreadcrumbHelper extends Helper
{
    public function __construct(
        private readonly Environment $templating,
        private readonly Builder $breadcrumbs,
        private readonly ContainerInterface $container,
    ) {}

    public function getName(): string
    {
        return 'breadcrumbs';
    }

    public function render(): string
    {
        $loader = $this->templating->getLoader();
        $loader->addPath($this->container->get('kernel')->locateResource('@KmjBreadcrumbBundle/Resources/views'));
        $this->templating->setLoader($loader);

        return $this->templating->render('@KmjBreadcrumb' . DIRECTORY_SEPARATOR . 'breadcrumb.html.twig', ['breadcrumbs' => $this->breadcrumbs->getAll()]);
    }
}
