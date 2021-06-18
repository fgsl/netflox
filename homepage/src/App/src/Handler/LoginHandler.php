<?php

declare(strict_types=1);

namespace App\Handler;

use App\Auth\DbTableAdapter;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Session\Container;
use Mezzio\Router;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginHandler implements RequestHandlerInterface
{
    /** @var Router\RouterInterface */
    private $router;

    /** @var null|TemplateRendererInterface */
    private $template;
    
    /** @var UrlHelper **/
    private $helper;
    
    /** @var AdapterInterface **/
    private $dbAdapter;

    public function __construct(
        Router\RouterInterface $router,
        TemplateRendererInterface $template = null,
        UrlHelper $helper,
        AdapterInterface $dbAdapter
    ) {
        $this->router        = $router;
        $this->template      = $template;
        $this->helper        = $helper;
        $this->dbAdapter     = $dbAdapter;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $url = $_SERVER['REQUEST_URI'];
        $tokens = explode('/',$url);
        if (end($tokens) == 'login'){
            $inputs = $request->getParsedBody();
            $usuario = $inputs['usuario'];
            $senha = $inputs['senha'];
            $authAdapter = new DbTableAdapter($this->dbAdapter);
            $authAdapter->setIdentityColumn('nome')
            ->setCredentialColumn('senha')
            ->setTableName('usuarios')
            ->setIdentity($usuario)
            ->setCredential($senha);            
            try {
                $result = $authAdapter->authenticate($authAdapter);
                $session = new Container();
                $session->identity = $result->getIdentity();
            } catch (\Exception $e) {
                error_log($e->getMessage());
            }
            $data = [];            
            if ($result->isValid()){
                $uri = $this->helper->generate('menu');
                return new RedirectResponse($uri);
            }            
        }        
        
        $data = [
            'loginAction' => $this->helper->generate('login')
        ];
        return new HtmlResponse($this->template->render('app::login', $data));
    }
}
