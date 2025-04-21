<?php

namespace App\Service;

use App\Contract\TwigServiceInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class TwigService implements TwigServiceInterface
{
    private Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('views');
        $this->twig = new Environment($loader);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function render(string $page, array $params = []): void
    {
        echo $this->twig->render($page, $params);
    }
}