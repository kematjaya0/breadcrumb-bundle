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
    
    /**
     * 
     * @var Collection
     */
    private $items;
    
    /**
     * 
     * @var RouterInterface
     */
    private $router;
    
    function __construct(private TranslatorInterface $translator)
    {
        $this->items = new ArrayCollection();
    }
    
    /**
     * Set Router Object
     * @param RouterInterface $router
     */
    public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
    }
    
    /**
     * 
     * @param string $label
     * @param string $urlName
     * @param array $urlParams
     * @param string $icon
     * @return self
     */
    public function setDefault(string $label, string $urlName = null, array $urlParams = [], string $icon = null):self
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
    
    /**
     * 
     * @param string $label
     * @param string $urlName
     * @param array $urlParams
     * @param string $icon
     * @return \Kematjaya\Breadcrumb\Lib\Breadcrumb
     */
    public function produce(string $label, string $urlName = null, array $urlParams = [], string $icon = null) 
    {
        $path = null;
        if ($urlName) {
            $path = (!empty($urlParams)) ? $this->router->generate($urlName, $urlParams) : $this->router->generate($urlName);
        }
        
        return new Breadcrumb($this->translator->trans($label), $path, $icon);
    }
    
    /**
     * 
     * @param string $label
     * @param string $urlName
     * @param array $urlParams
     * @param string $icon
     */
    public function add(string $label, string $urlName = null, array $urlParams = [], string $icon = null) 
    {
        $breadcrumb = $this->produce($label, $urlName, $urlParams, $icon);
        $this->items->add($breadcrumb);
    }
    
    /**
     * 
     * @return Collection
     */
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
