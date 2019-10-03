<?php namespace App\MediaApi\Rutube;

use App\MediaApi\EmbedApiFactory;
use App\MediaApi\Exceptions\PayloadMissingException;
use App\MediaApi\Response\AuthorResponse;
use App\MediaApi\Response\VideoResponse;

class Rutube implements EmbedApiFactory
{
    protected const ENDPOINT = 'http://rutube.ru/api/video/';

    /**
     * Get data from oEmbed api with video information
     *
     * @param string $videoUri
     * @return VideoResponse
     * @throws PayloadMissingException
     */
    public function getVideoInfo(string $videoUri): VideoResponse
    {
        // TODO parse video_id and request to ENDPOINT http://rutube.ru/api/video/{VIDEO_ID}. Then parse xml response
    }

    /**
     * Get information about the author of the video from url
     *
     * @param string $videoUri
     * @return AuthorResponse
     * @throws PayloadMissingException
     */
    public function getAuthor(string $videoUri): AuthorResponse
    {
        // TODO parse video_id and request to ENDPOINT http://rutube.ru/api/video/{VIDEO_ID}. Then parse xml response
    }
}
