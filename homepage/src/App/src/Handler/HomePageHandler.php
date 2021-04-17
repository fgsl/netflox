<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\LaminasView\LaminasViewRenderer;
use Mezzio\Plates\PlatesRenderer;
use Mezzio\Router;
use Mezzio\Template\TemplateRendererInterface;
use Mezzio\Twig\TwigRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomePageHandler implements RequestHandlerInterface
{
    /** @var string */
    private $containerName;

    /** @var Router\RouterInterface */
    private $router;

    /** @var null|TemplateRendererInterface */
    private $template;

    public function __construct(
        string $containerName,
        Router\RouterInterface $router,
        ?TemplateRendererInterface $template = null
    ) {
        $this->containerName = $containerName;
        $this->router        = $router;
        $this->template      = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $filmes = file_get_contents('http://localhost:8009/filmes',false);
        } catch (\Exception $e) {
            $filmes = 'Não conseguiu acessar o serviço de catálogo de filmes';
        }
        try {    
            $video = file_get_contents('http://localhost:8008/video',false);
        } catch (\Exception $e) {    
            $video = 'Não conseguiu acessar o serviço de reprodução de vídeos';
        }
        try { 
            $conta = file_get_contents('http://localhost:8010/conta',false);
       } catch (\Exception $e) {
            $conta = 'Não conseguiu acessar o serviço de conta do usuário'; 
       }
    
        $data = [
            'filmes' => $filmes,
            'video' => $video,
            'conta' => $conta
        ];
        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}
