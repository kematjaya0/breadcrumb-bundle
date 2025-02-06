<?php

namespace Kematjaya\Breadcrumb\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Kematjaya\Breadcrumb\Helper\BreadcrumbHelper;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class BreadcrumbsExtension extends AbstractExtension 
{
    private $name = 'breadcrumbs';
    
    function __construct(private BreadcrumbHelper $helper)
    {

    }
    
    public function getFunctions():array
    {
        return [
            new TwigFunction('kmj_breadcrumb', [$this, 'render'], ['is_safe' => ['html']])
        ];
    }
    
    public function render():?string
    {
        return $this->helper->render();
    }
    
    public function getName()
    {
        return $this->name;
    }
}
