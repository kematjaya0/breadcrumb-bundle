<?php

namespace Kematjaya\Breadcrumb\Lib;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class Breadcrumb 
{
    private $label;
    
    private $url;
    
    private $icon;
    
    private $isLast = false;
    
    function __construct(string $label, string $url = null, string $icon = null) 
    {
        $this->label = $label;
        $this->url = $url;
        $this->icon = $icon;
    }
    
    function getLabel():string
    {
        return $this->label;
    }
    
    function getUrl():string
    {
        return $this->url;
    }
    
    function getIcon():string
    {
        return $this->icon;
    }
    
    function setIsLast(bool $isLast = false) :self
    {
        $this->isLast = $isLast;
        
        return $this;
    }
    
    function isLast():bool
    {
        return $this->isLast;
    }
}
