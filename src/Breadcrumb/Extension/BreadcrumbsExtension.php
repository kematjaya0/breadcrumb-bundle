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
    
    private $helper;
    
    function __construct(BreadcrumbHelper $helper) 
    {
        $this->helper = $helper;
    }
    
    public function getFunctions()
    {
        return [
            new TwigFunction('kmj_breadcrumb', [$this, 'render'], ['is_safe' => ['html']])
        ];
    }
    
    public function render()
    {
        return $this->helper->render();
    }
    
    public function getName()
    {
        return $this->name;
    }
}
