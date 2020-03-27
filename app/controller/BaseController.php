<?php

namespace controller;

class BaseController
{

    protected $twig;
    protected $data = array();

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/view');
        $this->twig = new \Twig\Environment($loader, [
            // 'cache' => '/path/to/compilation_cache',
        ]);
    }
    public function assign($var, $value = null)
    {
        if (is_array($var)) {
            $this->data = array_merge($this->data, $var);
        } else {
            $this->data[$var] = $value;
        }
    }
    public function display($template)
    {

        echo $this->twig->render($template . '.html', $this->data);
    }
    function success($url, $msg)
    {
        echo "<script>";
        echo "alert('{$msg}');";
        echo "location.href='{$url}'";
        echo "</script>";
    }
    function error($url, $msg)
    {
        echo "<script>";
        echo "alert('error:{$msg}');";
        echo "location.href='{$url}'";
        echo "</script>";
    }
}
