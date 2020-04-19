<?php

namespace Kematjaya\Breadcrumb\Lib;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class Builder 
{
    
    private $items;
    
    private $translator;
    
    private $router;
    
    function __construct(TranslatorInterface $translator) 
    {
        $this->translator = $translator;
        $this->items = new ArrayCollection();
    }
    
    public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
    }
    
    public function setDefault($label, $urlName = null, $urlParams = [], $icon = null)
    {
        if(!$this->items->first())
        {
            $this->add($label, $urlName, $urlParams, $icon);
        } else
        {
            $breadcrumb = $this->produce($label, $urlName, $urlParams, $icon);
            $exists = $this->items->toArray();
            $this->items = new ArrayCollection(array_merge([$breadcrumb], $exists));
        }
        
        return $this;
    }
    
    function produce($label, $urlName = null, $urlParams = [], $icon = null) 
    {
        $path = null;
        if($urlName)
        {
            $path = (!empty($urlParams)) ? $this->router->generate($urlName, $urlParams) : $this->router->generate($urlName);
        }
        
        return new Breadcrumb($this->translator->trans($label), $path, $icon);
    }
    
    function add($label, $urlName = null, $urlParams = [], $icon = null) 
    {
        $breadcrumb = $this->produce($label, $urlName, $urlParams, $icon);
        $this->items->add($breadcrumb);
    }
    
    function getAll()
    {
        $last = $this->items->last();
        if($last)
        {
            $last->setIsLast(true);
            $key = $this->items->indexOf($last);
            $this->items->set($key, $last);
        }
            
        return $this->items;
    }
}
