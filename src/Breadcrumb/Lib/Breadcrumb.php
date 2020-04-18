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
    
    private $isLast;
    
    function __construct($label, $url = null, $icon = null) 
    {
        $this->label = $label;
        $this->url = $url;
        $this->icon = $icon;
    }
    
    function getLabel()
    {
        return $this->label;
    }
    
    function getUrl()
    {
        return $this->url;
    }
    
    function getIcon()
    {
        return $this->icon;
    }
    
    function setIsLast($isLast = false) 
    {
        $this->isLast = $isLast;
    }
    
    function isLast()
    {
        return $this->isLast;
    }
}
