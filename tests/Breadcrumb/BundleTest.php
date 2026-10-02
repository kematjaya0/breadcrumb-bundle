<?php

namespace Kematjaya\Tests\Breadcrumb;

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
        $client = static::createClient();
        $container = $client->getContainer();
        // Test if the service exists
        $this->assertTrue($container->has('kematjaya.breadcrumbs_builder'));
        $this->assertTrue($container->has('kematjaya.breadcrumbs_extension'));
        $service = $container->get('kematjaya.breadcrumbs_builder');
        $ext = $container->get('kematjaya.breadcrumbs_extension');
        echo $ext->render();
        $this->assertInstanceOf(Builder::class, $service);
    }

    public static function getKernelClass(): string
    {
        return AppKernel::class;
    }
}
