<?php

namespace App\Traits;

use App\Service\TwigService;
use JetBrains\PhpStorm\NoReturn;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

trait HasResponse
{
    #[NoReturn] private function responseJson($data, $status): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[NoReturn] private function responseHtml($page, $status, $data = []): void
    {
        http_response_code($status);
        header('Content-Type: text/html; charset=utf-8');
        new TwigService()
            ->render($page, $data);
        exit;
    }

    #[NoReturn] private function responseRedirect($page): void
    {
        http_response_code(308);
        header('Location: ' . $page);
        exit;
    }
}