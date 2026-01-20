<?php

namespace Kematjaya\Breadcrumb\Helper;

use Symfony\Component\HttpKernel\KernelInterface;
use Twig\Environment;
use Kematjaya\Breadcrumb\Lib\Builder;
use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class BreadcrumbHelper extends Helper
{
    
    public function __construct(private Environment $templating, private Builder $breadcrumbs,  private KernelInterface $kernel)
    {
    }
    
    public function getName(): string 
    {
        return 'breadcrumbs';
    }

    function render():?string
    {
        $loader = $this->templating->getLoader();
        $loader->addPath($this->kernel->locateResource('@KmjBreadcrumbBundle/Resources/views'));
        
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

        $template = '@KmjBreadcrumb/breadcrumb.html.twig';
        if ($loadByNamespace) {
            
            $template = '@KmjBreadcrumb/'.$templatePath;
        }
        
        return $this->templating->render($template, ['breadcrumbs' => $this->breadcrumbs->getAll()]);
    }
}
