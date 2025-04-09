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
            $this->response(['message' => 'Invalid URL'], 400);
        }

        $link = $this->linkService->create($url);
        if (!$link) {
            $this->response(['message' => 'Link could not be created'], 500);
        }

        $this->response(['link' => $link], 200);
    }
}