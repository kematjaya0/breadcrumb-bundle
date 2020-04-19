<?php

namespace Kematjaya\Breadcrumb\Helper;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Kematjaya\Breadcrumb\Lib\Builder;
use Symfony\Component\Templating\Helper\Helper;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class BreadcrumbHelper extends Helper
{
    private $templating;
    
    private $breadcrumbs;
    
    public function __construct(Environment $templating, Builder $breadcrumbs)
    {
        $this->templating = $templating;
        $this->breadcrumbs = $breadcrumbs;
    }
    
    public function getName(): string 
    {
        return 'breadcrumbs';
    }

    function render()
    {
        $loader = new FilesystemLoader(__DIR__.'/../Resources/views');
        $this->templating->setLoader($loader);
        $this->templating->load('breadcrumb.html.twig');
        return $this->templating->render('breadcrumb.html.twig', ['breadcrumbs' => $this->breadcrumbs->getAll()]);
    }
}
