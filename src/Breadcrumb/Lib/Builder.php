<?php

namespace Kematjaya\Breadcrumb\Lib;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class Builder 
{
    
    private Collection $items;
    
    function __construct(private TranslatorInterface $translator, private RouterInterface $router)
    {
        $this->items = new ArrayCollection();
    }

    public function setDefault(string $label, ?string $urlName = null, array $urlParams = [], ?string $icon = null):self
    {
        if (!$this->items->first()) {
            $this->add($label, $urlName, $urlParams, $icon);
             
            return $this;
        } 
        
        $breadcrumb = $this->produce($label, $urlName, $urlParams, $icon);
        $exists = $this->items->toArray();
        $this->items = new ArrayCollection(array_merge([$breadcrumb], $exists));
        
        return $this;
    }

    public function produce(string $label, ?string $urlName = null, array $urlParams = [], ?string $icon = null) :Breadcrumb
    {
        $path = null;
        if ($urlName) {
            $path = (!empty($urlParams)) ? $this->router->generate($urlName, $urlParams) : $this->router->generate($urlName);
        }
        
        return new Breadcrumb($this->translator->trans($label), $path, $icon);
    }

    public function add(string $label, ?string $urlName = null, array $urlParams = [], ?string $icon = null) :void
    {
        $breadcrumb = $this->produce($label, $urlName, $urlParams, $icon);
        $this->items->add($breadcrumb);
    }

    public function getAll(): Collection
    {
        $last = $this->items->last();
        if ($last) {
            $last->setIsLast(true);
            $key = $this->items->indexOf($last);
            $this->items->set($key, $last);
        }
            
        return $this->items;
    }
}
