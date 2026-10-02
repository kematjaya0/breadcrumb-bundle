<?php

namespace Kematjaya\Tests\Breadcrumb;

use Kematjaya\Breadcrumb\Lib\Breadcrumb;
use PHPUnit\Framework\TestCase;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class BreadcrumbTest extends TestCase
{
    public function testConstructorSetsLabel(): void
    {
        $br = new Breadcrumb('Home');
        $this->assertEquals('Home', $br->getLabel());
    }

    public function testConstructorSetsUrl(): void
    {
        $br = new Breadcrumb('Home', '/home');
        $this->assertEquals('/home', $br->getUrl());
    }

    public function testConstructorSetsIcon(): void
    {
        $br = new Breadcrumb('Home', null, 'home-icon');
        $this->assertEquals('home-icon', $br->getIcon());
    }

    public function testSetIcon(): void
    {
        $br = new Breadcrumb('Home');
        $br->setIcon('new-icon');
        $this->assertEquals('new-icon', $br->getIcon());
    }

    public function testSetIsLast(): void
    {
        $br = new Breadcrumb('Home');
        $br->setIsLast(true);
        $this->assertTrue($br->isLast());
    }

    public function testSetIsLastDefaultFalse(): void
    {
        $br = new Breadcrumb('Home');
        $this->assertFalse($br->isLast());
    }
}
