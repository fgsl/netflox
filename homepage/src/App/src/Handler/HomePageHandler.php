<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Router;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Session\Container;
use Mezzio\Helper\UrlHelper;
use Laminas\Diactoros\Response\RedirectResponse;

class HomePageHandler implements RequestHandlerInterface
{
    /** @var Router\RouterInterface */
    private $router;

    /** @var null|TemplateRendererInterface */
    private $template;
    
    /** @var array **/
    private $services = [];
    
    /** @var UrlHelper **/
    private $urlHelper;

    public function __construct(
        Router\RouterInterface $router,
        TemplateRendererInterface $template = null,
        array $services,
        UrlHelper $urlHelper
    ) {
        $this->router        = $router;
        $this->template      = $template;
        $this->services      = $services;
        $this->urlHelper     = $urlHelper;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $session = new Container();
        error_log(print_r($_SESSION,true));
        if (!isset($session->identity))
        {
            $uri = $this->urlHelper->generate('home'); 
            return new RedirectResponse($uri);
        }
        $data = [
            'services' => $this->services
        ];
        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}
