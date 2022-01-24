<?php

use Latte\Runtime as LR;

/** source: /var/www/html/views/latte/posts.latte */
final class Template2786da8de0 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['content' => 'blockContent'],
	];


	public function main(): array
	{
		extract($this->params);
		echo "\n";
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('content', get_defined_vars()) /* line 3 */;
		echo "\n";
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['key' => '7', 'post' => '7'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		$this->parentName = 'layouts/layout.latte';
		
	}


	/** {block content} on line 3 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <h1>Last ';
		echo LR\Filters::escapeHtmlText($postCount) /* line 4 */;
		echo ' twitter posts including pilulka</h1>
    <h2 class="result-count">Found ';
		echo LR\Filters::escapeHtmlText($posts['resultCount']) /* line 5 */;
		echo ' tweets in last 7 days.</h2>
    <div class="posts">
';
		$iterations = 0;
		foreach ($posts['post'] as $key => $post) /* line 7 */ {
			echo '            <div class="card">
                <div class="author-username card-header">
                    ';
			echo LR\Filters::escapeHtmlText($post['user']?->username) /* line 10 */;
			echo '
                </div>
                <div class="post-text card-body">
                    ';
			echo LR\Filters::escapeHtmlText($post['data']?->text) /* line 13 */;
			echo '
                </div>
                <div class="metrics card-footer">
                    <span class="retweeted">
                        Retweeted:
                        ';
			echo LR\Filters::escapeHtmlText($post['data']?->public_metrics->retweet_count) /* line 18 */;
			echo '
                    </span>
                    <span class="retweeted">
                        Likes:
                        ';
			echo LR\Filters::escapeHtmlText($post['data']?->public_metrics->like_count) /* line 22 */;
			echo '
                    </span>
                </div>
            </div>
            </br>
';
			$iterations++;
		}
		echo '    </div>
';
	}

}
