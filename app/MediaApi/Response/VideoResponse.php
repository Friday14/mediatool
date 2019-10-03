<?php namespace App\MediaApi\Response;

abstract class VideoResponse
{
    abstract public function getId(): string;

    abstract public function getName(): string;

    abstract public function getThumbnail(): string;

    abstract public function getUrl(): string;

    abstract public function getAuthor(): AuthorResponse;

    abstract public function html(): string;

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'thumbnail' => $this->getThumbnail(),
            'url' => $this->getUrl(),
            'author' => $this->getAuthor()->toArray(),
            'html' => $this->html()
        ];
    }
}
