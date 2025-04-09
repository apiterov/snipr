<?php

namespace App\Controller;

use App\Service\LinkService;
use App\Traits\HasResponse;
use JetBrains\PhpStorm\NoReturn;

class LinkController
{
    use HasResponse;
    private LinkService $linkService;

    public function __construct()
    {
        $this->linkService = LinkService::init();
    }

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
}