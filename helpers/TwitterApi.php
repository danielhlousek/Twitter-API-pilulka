<?php
declare(strict_types = 1);

namespace helpers;

use Noweh\TwitterApi\Client;

class TwitterApi {

    private const MAX_ALLOWED_POST_COUNT = 100;
    private const MIN_ALLOWED_POST_COUNT = 10;

    /**
     * @var array
     */
    private array $settings = [];

    /**
     * @var \Noweh\TwitterApi\Client
     */
    private Client $client;

    public function __construct()
    {
        $this->settings['account_id'] = getenv('TWITTER_ACCOUNT_ID');
        $this->settings['consumer_key'] = getenv('TWITTER_CONSUMER_KEY');
        $this->settings['consumer_secret'] = getenv('TWITTER_CONSUMER_SECRET');
        $this->settings['bearer_token'] = getenv('TWITTER_BEARER_TOKEN');
        $this->settings['access_token'] = getenv('TWITTER_ACCESS_TOKEN');
        $this->settings['access_token_secret'] = getenv('TWITTER_ACCESS_TOKEN_SECRET');

        $this->client = new Client($this->settings);

    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @param int $postCount
     * @return mixed
     */
    public function getTweetsIncludingPilulka(int $postCount): mixed
    {
        if ($postCount > self::MAX_ALLOWED_POST_COUNT) {
            $postCount = self::MAX_ALLOWED_POST_COUNT;
        } else if ($postCount < self::MIN_ALLOWED_POST_COUNT) {
            $postCount = self::MIN_ALLOWED_POST_COUNT;
        }

        return $this->client->tweetSearch()
            ->showMetrics()
            ->onlyWithMedias()
            ->addFilterOnKeywordOrPhrase([
                'pilulka',
                'pilulka.cz',
                'pilulkacz'
            ], Client::OPERATORS['OR'])
            ->showUserDetails()
            ->addMaxResults($postCount)
            ->performRequest();
    }
}
