<?php

namespace App\Service;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

final class TwigService
{
    private static ?self $instance = null;
    private Environment $twig;

    private function __construct()
    {
        $loader = new FilesystemLoader('views');
        $this->twig = new Environment($loader);
    }

    public static function init(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
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