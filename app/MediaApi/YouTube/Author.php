<?php namespace App\MediaApi\YouTube;

use App\MediaApi\Response\AuthorResponse;

class Author extends AuthorResponse
{
    protected $name;
    protected $url;

    public function __construct(string $name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    function getName(): string
    {
        return $this->name;
    }

    function getUrl(): string
    {
        return $this->url;
    }
}
