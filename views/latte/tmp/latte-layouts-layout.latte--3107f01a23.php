<?php

use Latte\Runtime as LR;

/** source: /var/www/html/views/latte/layouts/layout.latte */
final class Template3107f01a23 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['content' => 'blockContent'],
	];


	public function main(): array
	{
		extract($this->params);
		echo '<!doctype html>
<html lang="en">
<head>
    <script type="text/javascript" src="/style/bootstrap/dist/js/bootstrap.min.js"></script>
    <link href="/style/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/style/style.css" rel="stylesheet">
    <title>Twiiter api for pilulka</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container">
        <div>
';
		if (isset($errors)) /* line 15 */ {
			echo '                ';
			echo LR\Filters::escapeHtmlText($errors) /* line 16 */;
			echo "\n";
		}
		echo '            <?php echo (isset($errors) ? $errors : null) ?>
        </div>
        ';
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('content', get_defined_vars()) /* line 20 */;
		echo '
    </div>
    <footer>
        <div class="text-dark">
            Daniel Hloušek
        </div>
    </footer>
</body>
';
		return get_defined_vars();
	}


	/** {block content} on line 20 */
	public function blockContent(array $ʟ_args): void
	{
		
	}

}
