<?php

namespace Kematjaya\Tests\Breadcrumb;

use Kematjaya\Breadcrumb\Extension\BreadcrumbsExtension;
use Kematjaya\Breadcrumb\Lib\Breadcrumb;
use Kematjaya\Breadcrumb\Lib\Builder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class BundleTest extends WebTestCase
{
    public function testCreateBreadcrumb(): void
    {
        $br = new Breadcrumb('test');
        $this->assertEquals('test', $br->getLabel());
    }
    public function testInitBundle(): void
    {
        $container = static::getContainer();
        // Test if the service exists
        $this->assertTrue($container->has('kematjaya.breadcrumbs_builder'));
        $this->assertTrue($container->has('kematjaya.breadcrumbs_extension'));
        $service = $container->get('kematjaya.breadcrumbs_builder');
        $ext = $container->get('kematjaya.breadcrumbs_extension');
        $this->assertNotEmpty($ext->render());
        $this->assertInstanceOf(Builder::class, $service);
        $this->assertInstanceOf(Builder::class, $container->get(Builder::class));
        $this->assertInstanceOf(BreadcrumbsExtension::class, $container->get(BreadcrumbsExtension::class));
    }

    public static function getKernelClass(): string
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
            $previousHandler = set_exception_handler(static fn () => null);

            restore_exception_handler();

            if ($previousHandler === null) {
                break;
            }

            restore_exception_handler();
        }
    }
}
