<?php
    $repository = $page->parent;

	$github = $modules->get('GitHubConnector');
	$github->import_commits($repository);

    $customers = $repository->child('name=customers')->children();

    include($config->paths->templates."/twig/repositories/commits/functions.php");

    $page->body = $config->twig->render('repositories/commits/commits-table.twig', ['commits' => $page->find('sort=-date'), 'customers' => $customers]);
    $config->scripts->append(get_hashedtemplatefileurl('scripts/pages/repository.js'));
    include __DIR__ . "/basic-page.php";
