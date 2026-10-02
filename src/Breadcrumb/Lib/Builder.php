<?php

namespace Kematjaya\Breadcrumb\Lib;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class Builder
{
    private ArrayCollection $items;

    private ?RouterInterface $router = null;

    public function __construct(private readonly TranslatorInterface $translator)
    {
        $this->items = new ArrayCollection();
    }

    /**
     * Set Router Object
     */
    public function setRouter(RouterInterface $router): void
    {
        $this->router = $router;
    }

    public function setDefault(string $label, ?string $urlName = null, array $urlParams = [], ?string $icon = null): self
    {
        if ($this->items->isEmpty()) {
            $this->add($label, $urlName, $urlParams, $icon);

            return $this;
        }

        $breadcrumb = $this->produce($label, $urlName, $urlParams, $icon);
        $exists = $this->items->toArray();
        $this->items = new ArrayCollection(array_merge($exists, [$breadcrumb]));

        return $this;
    }

    /**
     * Reset all breadcrumbs
     */
    public function clear(): self
    {
        $this->items = new ArrayCollection();

        return $this;
    }

    public function produce(string $label, ?string $urlName = null, array $urlParams = [], ?string $icon = null): Breadcrumb
    {
        $path = null;
        if ($urlName) {
            $path = (!empty($urlParams)) ? $this->router->generate($urlName, $urlParams) : $this->router->generate($urlName);
        }

        return new Breadcrumb($this->translator->trans($label), $path, $icon);
    }

    public function add(string $label, ?string $urlName = null, array $urlParams = [], ?string $icon = null): void
    {
        $breadcrumb = $this->produce($label, $urlName, $urlParams, $icon);
        $this->items->add($breadcrumb);
    }

    public function getAll(): Collection
    {
        if (!$this->items->isEmpty()) {
            $last = $this->items->last();
            $last->setIsLast(true);
            $key = $this->items->indexOf($last);
            $this->items->set($key, $last);
        }

        return $this->items;
    }
}
