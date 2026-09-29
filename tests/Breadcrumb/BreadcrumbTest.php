<?php

namespace Kematjaya\Tests\Breadcrumb;

use Kematjaya\Breadcrumb\Lib\Breadcrumb;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class BreadcrumbTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructorSetsLabel()
    {
        $br = new Breadcrumb('Home');
        $this->assertEquals('Home', $br->getLabel());
    }

    public function testConstructorSetsUrl()
    {
        $br = new Breadcrumb('Home', '/home');
        $this->assertEquals('/home', $br->getUrl());
    }

    public function testConstructorSetsIcon()
    {
        $br = new Breadcrumb('Home', null, 'home-icon');
        $this->assertEquals('home-icon', $br->getIcon());
    }

    public function testSetLabel()
    {
        $br = new Breadcrumb('Home');
        $br->setLabel('Index');
        $this->assertEquals('Index', $br->getLabel());
    }

    public function testSetUrl()
    {
        $br = new Breadcrumb('Home');
        $br->setUrl('/new-home');
        $this->assertEquals('/new-home', $br->getUrl());
    }

    public function testSetIcon()
    {
        $br = new Breadcrumb('Home');
        $br->setIcon('new-icon');
        $this->assertEquals('new-icon', $br->getIcon());
    }

    public function testSetIsLast()
    {
        $br = new Breadcrumb('Home');
        $br->setIsLast(true);
        $this->assertTrue($br->isLast());
    }

    public function testSetIsLastDefaultFalse()
    {
        $br = new Breadcrumb('Home');
        $this->assertFalse($br->isLast());
    }
}