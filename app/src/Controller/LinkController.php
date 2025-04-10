<?php

namespace App\Controller;

use App\Contract\LinkServiceInterface;
use App\Service\DatabaseService;
use App\Service\LinkService;
use App\Traits\HasResponse;
use JetBrains\PhpStorm\NoReturn;

class LinkController
{
    use HasResponse;

    public function __construct(
        private readonly LinkServiceInterface $linkService
    ) {}

    #[NoReturn] public function createLink(): void
    {
        $url = $_GET['url'] ?? null;
        if (!$url) {
            $this->responseJson(['message' => 'Invalid URL'], 400);
        }

        $link = $this->linkService->create($url);
        if (!$link) {
            $this->responseJson(['message' => 'Link could not be created'], 500);
        }

        $this->responseJson(['link' => $link], 200);
    }

    #[NoReturn] public function getLink(): void
    {
        $code = trim($_SERVER['REQUEST_URI'], '/');
        if (!$code) {
            $this->responseJson(['message' => 'Invalid URL'], 400);
        }

        $url = $this->linkService->getOriginalUrl($code);
        $this->responseRedirect($url);
    }
}