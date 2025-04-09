<?php

namespace App\Controller;

use App\Traits\HasResponse;
use JetBrains\PhpStorm\NoReturn;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController
{
    use HasResponse;

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[NoReturn] public function index(): void
    {
        $this->responseHtml(
            page: 'home.twig',
            status: 200
        );
    }
}