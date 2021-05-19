<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Fgsl\Microserviceframework\Response\JsonResponseCors;

class FilmesHandler implements RequestHandlerInterface
{
    /** @var null|TemplateRendererInterface */
    private $template;

    public function __construct(TemplateRendererInterface $template = null
    ) {
        $this->template      = $template;
    }

    public function handle(ServerRequestInterface $request):ResponseInterface
    {
       $data = [];
       return new JsonResponseCors($this->template->render('app::filmes', ['layout' => false]));
    }
}
