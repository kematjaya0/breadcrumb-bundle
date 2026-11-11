<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\ContainerBuilder;

return static function (ContainerBuilder $container): void {
    $container->loadFromExtension('framework', [
        'secret' => 'secret',
        'test' => true,
        'http_method_override' => false,
        'handle_all_throwables' => true,
        'php_errors' => ['log' => true],
        'router' => ['resource' => null],
        'translator' => [],
    ]);
};
