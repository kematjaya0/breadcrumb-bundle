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
    
    /**
     * 
     * @var Environment
     */
    private $templating;
    
    /**
     * 
     * @var Builder
     */
    private $breadcrumbs;
    
    /**
     * 
     * @var ContainerInterface
     */
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
        $this->templating->setLoader($loader);
        
        return $this->templating->render('@KmjBreadcrumb' . DIRECTORY_SEPARATOR . 'breadcrumb.html.twig', ['breadcrumbs' => $this->breadcrumbs->getAll()]);
    }
}
