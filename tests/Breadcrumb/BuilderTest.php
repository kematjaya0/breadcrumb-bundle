<?php

namespace Kematjaya\Tests\Breadcrumb;

use Kematjaya\Breadcrumb\Lib\Builder;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Routing\RouterInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class BuilderTest extends TestCase
{
    private $builder;
    private $translator;
    private $router;

    protected function setUp(): void
    {
        $this->translator = $this->createMock(TranslatorInterface::class);
        $this->router = $this->createMock(RouterInterface::class);
        $this->builder = new Builder($this->translator);
        $this->builder->setRouter($this->router);
    }

    public function testAdd Adds Breadcrumb()
    {
        $this->builder->add('Home', 'homepage');
        $this->assertCount(1, $this->builder->getAll());
    }

    public function testProduce Creates Breadcrumb With Translated Label
    {
        $this->translator->method('trans')->willReturn('Home');
        $breadcrumb = $this->builder->produce('Home', 'homepage');
        $this->assertInstanceOf(\Kematjaya\Breadcrumb\Lib\Breadcrumb::class, $breadcrumb);
        $this->assertEquals('Home', $breadcrumb->getLabel());
    }

    public function testGetAll Returns Collection With IsLast Set On Last Item()
    {
        $this->builder->add('Home', 'homepage');
        $this->builder->add('Profile', 'profile');
        $all = $this->builder->getAll();
        $last = $all->last();
        $this->assertNotNull($last);
        $this->assertTrue($last->isLast());
    }

    public function testSetDefault Adds First Item When Empty()
    {
        $result = $this->builder->setDefault('Home', 'homepage');
        $this->assertCount(1, $this->builder->getAll());
        $this->assertEquals('Home', $this->builder->getAll()->first()->getLabel());
    }

    public function testSetDefault Prepends New Item()
    {
        $this->builder->add('Home', 'homepage');
        $result = $this->builder->setDefault('Profile', 'profile');
        $items = $this->builder->getAll();
        $this->assertCount(2, $items);
        // After fix, new item should be appended, so Profile should be last
        $this->assertEquals('Profile', $items->last()->getLabel());
    }

    public function testClearResetsItems()
    {
        $this->builder->add('Home', 'homepage');
        $this->builder->add('Profile', 'profile');
        $this->builder->clear();
        $this->assertCount(0, $this->builder->getAll());
    }
}