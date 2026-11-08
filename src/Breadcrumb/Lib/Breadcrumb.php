<?php

namespace Kematjaya\Breadcrumb\Lib;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class Breadcrumb
{
    private bool $isLast = false;

    public function __construct(
        private readonly string $label,
        private readonly ?string $url = null,
        private ?string $icon = null,
    ) {
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIsLast(bool $isLast = false): self
    {
        $this->isLast = $isLast;

        return $this;
    }

    public function isLast(): bool
    {
        return $this->isLast;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
}
