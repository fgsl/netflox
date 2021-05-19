<?php

declare(strict_types=1);

namespace App\Handler;

use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Fgsl\Microserviceframework\Response\JsonResponseCors;

class ContaHandler implements RequestHandlerInterface
{
    /** @var null|TemplateRendererInterface */
    private $template;

    /** @var UrlHelper */
    private $helper;

    public function __construct(
        TemplateRendererInterface $template = null, UrlHelper
$helper
    ) {
        $this->template      = $template;
        $this->helper = $helper;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $action = $request->getAttribute('action');
        $privacidadeLink = 'http://'.$_SERVER['HTTP_HOST'].$this->helper->generate('conta',['action' => 'privacidade']);
        $pagamentoLink = 'http://'.$_SERVER['HTTP_HOST'].$this->helper->generate('conta',['action' => 'pagamentos']);
        $preferenciasLink = 'http://'.$_SERVER['HTTP_HOST'].$this->helper->generate('conta',['action' => 'preferencias']);
        $sairLink = 'http://'.$_SERVER['HTTP_HOST'].$this->helper->generate('conta',['action' => 'sair']);
        $contaLink = 'http://'.$_SERVER['HTTP_HOST'].$this->helper->generate('homepage');

        if (empty($action)){
            return new JsonResponseCors($this->template->render('app::conta', [
            'privacidadeLink'   => $privacidadeLink,
            'pagamentoLink'     => $pagamentoLink,
            'preferenciasLink'  => $preferenciasLink,
            'sairLink'          => $sairLink,
            'layout'            => false]));        
        }
        return new JsonResponseCors($this->template->render('app::' . $action, ['contaLink' => $contaLink,'layout' => false]));
    }
}