<?php
declare(strict_types = 1);

namespace helpers;

use stdClass;

class Formatter {

    /**
     * @param stdClass $posts
     * @return array
     */
    public function formatPostsForPostList(stdClass $posts): array
    {
        $formattedPosts = [];
        foreach($posts->data as $data) {
            $formattedPosts['post'][$data->id]['data'] = $data;
            $formattedPosts['post'][$data->id]['user'] = $this->getAuthorById($posts->includes->users, $data->author_id);
        }
        $formattedPosts['resultCount'] = $posts->meta->result_count;

        return $formattedPosts;
    }

    /**
     * @param array $users
     * @param string $authorId
     * @return stdClass|null
     */
    private function getAuthorById(array $users, string $authorId): ?stdClass
    {
        foreach ($users as $user) {
            if ($authorId === $user->id) {
                return $user;
            }
        }

        return null;
    }
}
