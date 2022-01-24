<?php
declare(strict_types = 1);

namespace app;

require_once 'core/Controller.php';
require_once 'helpers/TwitterApi.php';
require_once 'helpers/Formatter.php';

use core\Controller;
use GuzzleHttp\Exception\GuzzleException;
use helpers\Formatter;
use helpers\TwitterApi;
use Latte\Engine;

class PostController extends Controller {
    /**
     * @var \Latte\Engine
     */
    private Engine $latte;

    public function __construct()
    {
        $this->latte = new Engine();
        $this->latte->setTempDirectory(getenv('PROJECT_ROOT') . '/views/latte/tmp');
    }


    /**
     * @param array|null
     */
    function list(?array $params = null) {
        $params['postCount'] = ($params) ? $params['postCount'] : getenv('DEFAULT_POST_COUNT');

        $viewData = [];
        $twitterApi = new TwitterApi();
        $formatter = new Formatter();
        try {
            $posts = $twitterApi->getTweetsIncludingPilulka((int)$params['postCount']);
            $posts = $formatter->formatPostsForPostList($posts);
            $viewData['postCount'] = $params['postCount'];
            $viewData['posts'] = $posts;
        } catch (GuzzleException | \JsonException $e) {
            $viewData['errors'] = $e->getMessage();
        }

        $this->latte->render(getenv('PROJECT_ROOT') . '/views/latte/posts.latte', $viewData);
    }
}
