<?php namespace App\Controllers;

use App\MediaApi\EmbedApiFactory;
use App\MediaApi\Exceptions\NotFoundFactoryException;
use App\MediaApi\Rutube\Rutube;
use App\MediaApi\YouTube\YouTube;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController
{
    public function index(string $service, Request $request)
    {
        try {
            $video = $request->get('video');
            $factory = $this->getApiFactory($service);
            $video = $factory->getVideoInfo($video);
            $response = json_encode($video->toArray());

            return new Response($response, Response::HTTP_OK, [
                'content-type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]);
        } catch (\Exception $e) {
            $response = json_encode(['error' => 'Some kind of error has occurred']);

            return new Response($response, Response::HTTP_BAD_REQUEST);
        }
    }


    protected function getApiFactory(string $service): EmbedApiFactory
    {
        $factories = [
            'youtube' => YouTube::class,
//          TODO  'rutube' => Rutube::class
        ];
        if (!isset($factories[$service])) {
            throw new NotFoundFactoryException();
        }

        return new $factories[$service];
    }
}
