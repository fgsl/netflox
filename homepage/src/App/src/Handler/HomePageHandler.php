<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Router;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomePageHandler implements RequestHandlerInterface
{
    /** @var Router\RouterInterface */
    private $router;

    /** @var null|TemplateRendererInterface */
    private $template;
    
    /** @var array **/
    private $services = [];

    public function __construct(
        Router\RouterInterface $router,
        TemplateRendererInterface $template = null,
        array $services
    ) {
        $this->router        = $router;
        $this->template      = $template;
        $this->services      = $services;
        error_log(__METHOD__);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [
            'services' => $this->services
        ];
        error_log(__METHOD__);
        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}
