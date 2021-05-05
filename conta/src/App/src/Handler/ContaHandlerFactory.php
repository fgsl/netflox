<?php

declare(strict_types=1);

namespace App\Handler;

use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ContaHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $template = $container->get(TemplateRendererInterface::class);
       $urlHelper = $container->get(UrlHelper::class);
	   return new ContaHandler($template, $urlHelper);
    }
}
