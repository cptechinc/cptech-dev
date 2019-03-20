<?php
	$commits = $page->parent('template=repository')->child('template=repository-commits');
	$page->title = $page->repocode;
	$page->body = $config->twig->render('repositories/customers/customer-page.twig', ['customer' => $page, 'commits' => $commits]);
	$config->scripts->append(get_hashedtemplatefileurl('scripts/pages/repository.js'));

	include __DIR__ . "/basic-page.php";
