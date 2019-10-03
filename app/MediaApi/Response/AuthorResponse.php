<?php namespace App\MediaApi\Response;

abstract class AuthorResponse
{
    abstract function getName(): string;

    abstract function getUrl(): string;

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'url' => $this->getUrl()
        ];
    }
}
