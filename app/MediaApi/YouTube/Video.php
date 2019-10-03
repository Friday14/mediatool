<?php namespace App\MediaApi\YouTube;

use App\MediaApi\Response\{VideoResponse, AuthorResponse};

class Video extends VideoResponse
{
    protected $name;
    protected $thumbnail;
    protected $author;
    protected $url;
    protected $html;

    public function __construct(AuthorResponse $author, string $name, string $thumbnail, string $url, string $html)
    {
        $this->author = $author;
        $this->name = $name;
        $this->thumbnail = $thumbnail;
        $this->url = $url;
        $this->html = $html;
    }

    public function getId(): string
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/';
        preg_match($pattern, $this->url, $matches, PREG_OFFSET_CAPTURE);

        return $matches[1][0] ?? '';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getAuthor(): AuthorResponse
    {
        return $this->author;
    }

    public function html(): string
    {
        return $this->html;
    }
}
