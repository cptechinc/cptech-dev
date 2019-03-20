<?php
	$page->title = $page->repocode;
	$repository = $page;

	$github = $modules->get('GitHubConnector');
	$github->import_commits($repository);
	include($config->paths->templates."/twig/repositories/commits/functions.php");
	$page->body = $config->twig->render('repositories/repository-page.twig', ['repository' => $page, 'children' => $page->children()]);

	$config->scripts->append(get_hashedtemplatefileurl('scripts/pages/repository.js'));
	include __DIR__ . "/basic-page.php";
