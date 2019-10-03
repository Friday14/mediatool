<?php namespace App\MediaApi;

use App\MediaApi\Response\AuthorResponse;
use App\MediaApi\Response\VideoResponse;

interface EmbedApiFactory
{
    /**
     * @param string $videoUri
     * @return VideoResponse
     */
    public function getVideoInfo(string $videoUri): VideoResponse;

    /**
     * @param string $videoUri
     * @return AuthorResponse
     */
    public function getAuthor(string $videoUri): AuthorResponse;
}
