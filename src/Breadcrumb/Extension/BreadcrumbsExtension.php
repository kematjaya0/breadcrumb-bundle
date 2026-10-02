<?php

namespace Kematjaya\Breadcrumb\Extension;

use Kematjaya\Breadcrumb\Helper\BreadcrumbHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class BreadcrumbsExtension extends AbstractExtension
{
    private string $name = 'breadcrumbs';

    public function __construct(private readonly BreadcrumbHelper $helper) {}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('kmj_breadcrumb', $this->render(...), ['is_safe' => ['html']]),
        ];
    }

    public function render(): string
    {
        return $this->helper->render();
    }

    public function getName(): string
    {
        return $this->name;
    }
}
