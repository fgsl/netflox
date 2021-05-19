<?php

declare(strict_types=1);

namespace App\Handler;

use Fgsl\Microserviceframework\Response\JsonResponseCors;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VideoHandler implements RequestHandlerInterface
{
    /** @var null|TemplateRendererInterface */
    private $template;

    public function __construct(TemplateRendererInterface $template = null
    ) {
        $this->template      = $template;
    }

    public function handle(ServerRequestInterface $request):ResponseInterface
    {
       return new JsonResponseCors($this->template->render('app::video', ['layout' => false]));
    }
}
