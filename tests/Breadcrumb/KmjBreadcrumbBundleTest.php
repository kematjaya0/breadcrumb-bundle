<?php

namespace Kematjaya\Tests\Breadcrumb;

//use Kematjaya\Breadcrumb\Lib\Breadcrumb;
use Kematjaya\Tests\Breadcrumb\AppKernel;
use PHPUnit\Framework\TestCase;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class KmjBreadcrumbBundleTest extends TestCase
{
    
    /*public function testCreateBreadcrumb()
    {
        $br = new Breadcrumb('test');
        $this->assertEquals('test', $br->getLabel());
    }*/
    
    public function testCreateBuilder()
    {
        $kernel  = new AppKernel('test', true);
        $kernel->boot();
        dump($kernel->getContainer());exit;
    }
}
