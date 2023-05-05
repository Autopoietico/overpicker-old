<?php

namespace App\Controllers;
use Laminas\Diactoros\Response\HtmlResponse;

class BaseController {

    public function __construct(){
        
        $loader = new \Twig\Loader\FilesystemLoader('../views');

        $this->templateEngine = new \Twig\Environment($loader,[
            'debug' => true,
            'cache' => false
        ]);
    }

    public function renderHTML($filename, $data = []){

        return new HtmlResponse($this->templateEngine->render($filename, $data));
    }
}