<?php include('./_head.php'); ?>
	<main role="main">
		<div class="jumbotron bg-dark text-light">
			<div class="container">
				<h1 class="display-3"><?= $page->get('pagetitle|headline|title') ; ?></h1>
			</div>
		</div>
		<div class="container page">
			<div class="list-group">
				<?php foreach ($page->children('template!=sitemap|login|logout, name!=about') as $child) : ?>
					<a href="<?= $child->url; ?>" class="list-group-item list-group-item-action"><?= $child->title; ?></a>
				<?php endforeach; ?>
			</div>
		</div>
	</main>
<?php include('./_foot.php'); // include footer markup ?>
