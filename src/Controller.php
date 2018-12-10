<?php
/**
 * Created by PhpStorm.
 * User: xdsym
 * Date: 03/12/2018
 * Time: 12:46
 */

namespace Framework;


class Controller
{
    private $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../app/Views');
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => __DIR__ . '/../storage/cache/views',
        ));
    }

    public function view(string $viewFile, array $params = [])
    {

        echo $this->twig->render($viewFile, $params);
    }
}
