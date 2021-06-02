<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Router;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Mezzio\Helper\UrlHelper;

class LoginHandler implements RequestHandlerInterface
{
    /** @var Router\RouterInterface */
    private $router;

    /** @var null|TemplateRendererInterface */
    private $template;
    
    /** @var UrlHelper **/
    private $helper;

    public function __construct(
        Router\RouterInterface $router,
        TemplateRendererInterface $template = null,
        UrlHelper $helper
    ) {
        $this->router        = $router;
        $this->template      = $template;
        $this->helper        = $helper;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $url = $_SERVER['REQUEST_URI'];
        $tokens = explode('/',$url);
        if (end($tokens) == 'login'){
            $inputs = $request->getParsedBody();
            $usuario = $inputs['usuario'];
            $senha = $inputs['senha'];
        }
        
        $data = [
            'loginAction' => $this->helper->generate('home',['action' => 'login'])
        ];
        return new HtmlResponse($this->template->render('app::login', $data));
    }
}
