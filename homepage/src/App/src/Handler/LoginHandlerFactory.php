<?php

declare(strict_types=1);

namespace App\Handler;

use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function get_class;
use Mezzio\Helper\UrlHelper;
use Laminas\Db\Adapter\AdapterInterface;

class LoginHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $router   = $container->get(RouterInterface::class);
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;
        $urlHelper = $container->get(UrlHelper::class);
        $dbAdapter = $container->get(AdapterInterface::class);
        
        return new LoginHandler($router, $template, $urlHelper, $dbAdapter);
    }
}
