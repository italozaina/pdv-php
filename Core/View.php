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
            if (\App\Config::SHOW_ERRORS) {
                $twig = new \Twig\Environment($loader,['debug' => true]);
                $twig->addExtension(new \Twig\Extension\DebugExtension());
                $assetFunction = new \Twig\TwigFunction('asset', function ($path) {
                    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
                    return $protocol.'://'.$_SERVER['HTTP_HOST'].'/'.$path;
                });
                $twig->addFunction($assetFunction);

            } else {
                $twig = new \Twig\Environment($loader);
            }
            $twig->addGlobal('session', $_SESSION);
        }

        echo $twig->render($template, $args);
    }
}