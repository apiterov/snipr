<?php

namespace App\Controller;

use App\Service\TwigService;
use App\Traits\HasResponse;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController
{
    use HasResponse;

    private TwigService $twig;

    public function __construct()
    {
        $this->twig = TwigService::init();
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function index(): void
    {
        $this->twig->render('home.twig');
    }
}