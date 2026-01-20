<?php

namespace Kematjaya\Tests\Breadcrumb;

use Kematjaya\Breadcrumb\Extension\BreadcrumbsExtension;
use Kematjaya\Tests\Breadcrumb\AppKernel;
use Kematjaya\Breadcrumb\Lib\Breadcrumb;
use Kematjaya\Breadcrumb\Lib\Builder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class BundleTest extends WebTestCase 
{
    
    public function testCreateBreadcrumb()
    {
        $br = new Breadcrumb('test');
        $this->assertEquals('test', $br->getLabel());
    }
    
    public function testInitBundle():void
    {
        $container = static::getContainer();
        // Test if the service exists
        $builder = $container->get(Builder::class);
        $this->assertInstanceOf(
            Builder::class,
            $builder
        );
        $ext = $container->get(BreadcrumbsExtension::class);
        $this->assertInstanceOf(
            BreadcrumbsExtension::class,
            $ext
        );
        $builder->add("test");
        echo $ext->render();
    }
    
    public static function getKernelClass() :string
    {
        return AppKernel::class;
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->restoreExceptionHandler();
    }

    protected function restoreExceptionHandler(): void
    {
        while (true) {
            $previousHandler = set_exception_handler(static fn() => null);

            restore_exception_handler();

            if ($previousHandler === null) {
                break;
            }

            restore_exception_handler();
        }
    }
}
