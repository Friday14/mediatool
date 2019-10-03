<?php namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function __invoke()
    {
        $view = file_get_contents(__DIR__ . '/../../public/dist/bundle.html');
        return new Response($view, Response::HTTP_OK, ['content-type' => 'text/html']);
    }
}
