<?php

namespace App\Controller;

use App\Service\LinkService;

class LinkController
{
    private LinkService $linkService;

    public function __construct()
    {
        $this->linkService = LinkService::init();
    }

    public function createLink(): void
    {
        $url = $_GET['url'];

        if (!$url) {
            $this->response(['message' => 'Invalid URL'], 400);
        }

        $link = $this->linkService->create($url);
        if (!$link) {
            $this->response(['message' => 'Link could not be created'], 500);
        }

        $this->response(['link' => $_SERVER['HTTP_HOST'] . '/' . $link], 200);
    }

    private function response($data, $status): void
    {
        http_response_code($status);
        echo json_encode($data);
    }
}