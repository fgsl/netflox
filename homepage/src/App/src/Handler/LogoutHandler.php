<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Session\SessionManager;
use Mezzio\Router;
use Mezzio\Helper\UrlHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LogoutHandler implements RequestHandlerInterface
{
    /** @var Router\RouterInterface */
    private $router;

    /** @var UrlHelper **/
    private $helper;
    
    /** @var AdapterInterface **/
    private $dbAdapter;

    public function __construct(
        Router\RouterInterface $router,
        UrlHelper $helper
    ) {
        $this->router        = $router;
        $this->helper        = $helper;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $sessionManager = new SessionManager();
        $sessionManager->destroy();
        $uri = $this->helper->generate('home');
        return new RedirectResponse($uri);
     }
}
