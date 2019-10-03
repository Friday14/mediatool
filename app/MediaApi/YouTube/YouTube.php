<?php namespace App\MediaApi\YouTube;

use App\MediaApi\EmbedApiFactory;
use App\MediaApi\Exceptions\PayloadMissingException;
use App\MediaApi\Response\AuthorResponse;
use App\MediaApi\Response\VideoResponse;

class YouTube implements EmbedApiFactory
{
    protected const ENDPOINT = 'http://www.youtube.com/oembed';

    /**
     * Get data from oEmbed api with video information
     *
     * @param string $videoUri
     * @return VideoResponse
     * @throws PayloadMissingException
     */
    public function getVideoInfo(string $videoUri): VideoResponse
    {
        [
            'author_name' => $authorName,
            'author_url' => $authorUrl,
            'title' => $title,
            'html' => $html,
            'thumbnail_url' => $thumbnail
        ] = $this->request($videoUri);

        if (!isset($authorName, $authorUrl, $title, $thumbnail)) {
            throw new PayloadMissingException('Payload missing for url: ' . $videoUri);
        }

        return new Video(
            new Author($authorName, $authorUrl),
            $title,
            $thumbnail,
            $videoUri,
            $html ?? ''
        );
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
        ['author_name' => $name, 'author_url' => $url] = $this->request($videoUri);
        if (!isset($name, $url)) {
            throw new PayloadMissingException('Payload missing for url: ' . $videoUri);
        }

        return new Author($name, $url);
    }

    /**
     * @param string $url
     * @return array
     */
    protected function request(string $url): array
    {
        $params = http_build_query([
            'url' => $url,
            'format' => 'json'
        ]);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::ENDPOINT . '?' . $params);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $payload = json_decode($response, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \Exception('Unable to parse response body into JSON: ' . json_last_error());
        }

        return $payload;
    }
}
