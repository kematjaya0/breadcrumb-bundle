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
    
    public function __construct(private Environment $templating, private Builder $breadcrumbs,  private ContainerInterface $container)
    {
    }
    
    public function getName(): string 
    {
        return 'breadcrumbs';
    }

    function render():?string
    {
        $loader = $this->templating->getLoader();
        $loader->addPath($this->container->get('kernel')->locateResource('@KmjBreadcrumbBundle/Resources/views'));
        
        $loadByNamespace = false;
        $templatePath = 'Resources/views/breadcrumb.html.twig';
        if (method_exists($loader, 'getPaths')) {
            foreach ($loader->getPaths('KmjBreadcrumb') as $path) {
                if (file_exists($path . DIRECTORY_SEPARATOR . $templatePath)) {
                    $loadByNamespace = true;
                    break;
                }
            }
        }
        
        if ($this->container->has('twig') and $loadByNamespace) {
            
            return $this->container->get('twig')->render('@KmjBreadcrumb/'.$templatePath, ['breadcrumbs' => $this->breadcrumbs->getAll()]);
        }
        
        return $this->templating->render('breadcrumb.html.twig', ['breadcrumbs' => $this->breadcrumbs->getAll()]);
    }
}
