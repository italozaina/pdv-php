<?php

namespace Core;

class View
{
    /**
     * Renderizar uma arquivo da view
     *
     * @param string $view  O arquivo da view
     * @param array $args  Um array de associação de dados para exibir na view (opcional)
     *
     * @return void
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/App/View/$view";  // relativo ao diretorio Core

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file não encontrado");
        }
    }

    /**
     * Renderizar um template usando Twig
     *
     * @param string $template  O arquivo de template Twig
     * @param array $args   Um array de associação de dados para exibir na view (opcional)
     *
     * @return void
     */
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/App/View');
            $twig = new \Twig\Environment($loader);
        }

        echo $twig->render($template, $args);
    }
}