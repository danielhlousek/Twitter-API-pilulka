<?php
declare(strict_types = 1);

namespace app;

require_once 'core/Controller.php';

use core\Controller;
use GuzzleHttp\Exception\GuzzleException;
use helpers\TwitterApi;

class ApiController extends Controller {

    /**
     * @param array|null
     */
    function list(?array $params = null) {
        $params['postCount'] = ($params) ? $params['postCount'] : getenv('DEFAULT_POST_COUNT');
        $twitterApi = new TwitterApi();
        try {
            $posts = $twitterApi->getTweetsIncludingPilulka((int)$params['postCount']);
            header('Content-Type: application/json; charset=utf-8');
            $this->addModelAttribute('posts', json_encode($posts));
        } catch (GuzzleException | \JsonException $e) {
            $this->addModelAttribute('errors', $e->getMessage());
        }

        $this->render('apiPosts', 'json');
    }
}
