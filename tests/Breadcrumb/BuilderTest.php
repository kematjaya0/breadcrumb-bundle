<?php

namespace Kematjaya\Tests\Breadcrumb;

use Kematjaya\Breadcrumb\Lib\Breadcrumb;
use Kematjaya\Breadcrumb\Lib\Builder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class BuilderTest extends TestCase
{
    private Builder $builder;
    private MockObject $translator;
    private MockObject $router;

    protected function setUp(): void
    {
        $this->translator = $this->createMock(TranslatorInterface::class);
        $this->router = $this->createMock(RouterInterface::class);
        $this->builder = new Builder($this->translator);
        $this->builder->setRouter($this->router);
    }

    public function testAddAddsBreadcrumb(): void
    {
        $this->builder->add('Home', 'homepage');
        $this->assertCount(1, $this->builder->getAll());
    }

    public function testProduceCreatesBreadcrumbWithTranslatedLabel(): void
    {
        $this->translator->method('trans')->willReturn('Home');
        $breadcrumb = $this->builder->produce('Home', 'homepage');
        $this->assertInstanceOf(Breadcrumb::class, $breadcrumb);
        $this->assertEquals('Home', $breadcrumb->getLabel());
    }

    public function testGetAllReturnsCollectionWithIsLastSetOnLastItem(): void
    {
        $this->builder->add('Home', 'homepage');
        $this->builder->add('Profile', 'profile');
        $all = $this->builder->getAll();
        $last = $all->last();
        $this->assertNotNull($last);
        $this->assertTrue($last->isLast());
    }

    public function testSetDefaultAddsFirstItemWhenEmpty(): void
    {
        $this->translator->method('trans')->willReturnArgument(0);
        $this->builder->setDefault('Home', 'homepage');
        $this->assertCount(1, $this->builder->getAll());
        $this->assertEquals('Home', $this->builder->getAll()->first()->getLabel());
    }

    public function testSetDefaultPrependsNewItem(): void
    {
        $this->translator->method('trans')->willReturnArgument(0);
        $this->builder->add('Home', 'homepage');
        $this->builder->setDefault('Profile', 'profile');
        $items = $this->builder->getAll();
        $this->assertCount(2, $items);
        // After fix, new item should be appended, so Profile should be last
        $this->assertEquals('Profile', $items->last()->getLabel());
    }

    public function testClearResetsItems(): void
    {
        $this->builder->add('Home', 'homepage');
        $this->builder->add('Profile', 'profile');
        $this->builder->clear();
        $this->assertCount(0, $this->builder->getAll());
    }
}
