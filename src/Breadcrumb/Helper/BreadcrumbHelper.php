<?php

namespace Kematjaya\Breadcrumb\Helper;

use Twig\Environment;
use Kematjaya\Breadcrumb\Lib\Builder;
use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class BreadcrumbHelper extends Helper
{
    private $templating;
    
    private $breadcrumbs;
    
    private $container;
    
    public function __construct(Environment $templating, Builder $breadcrumbs,  ContainerInterface $container)
    {
        $this->templating = $templating;
        $this->breadcrumbs = $breadcrumbs;
        $this->container = $container;
    }
    
    public function getName(): string 
    {
        return 'breadcrumbs';
    }

    function render()
    {
        $loader = $this->templating->getLoader();
        $loader->addPath($this->container->get('kernel')->locateResource('@KmjBreadcrumbBundle/Resources/views'));
        return $this->templating->render('breadcrumb.html.twig', ['breadcrumbs' => $this->breadcrumbs->getAll()]);
    }
}
