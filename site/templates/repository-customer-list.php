<?php
	$customers = $page->children();
	$module_repo = $modules->get('GitHubRepositories');
	$page->title = "{$page->parent->repocode} Customers";
	$page->body = $config->twig->render('repositories/customers/customers-table.twig', ['page' => $page, 'customers' => $customers, 'module_repo' => $module_repo]);
	$config->scripts->append(get_hashedtemplatefileurl('scripts/pages/repository.js'));
	include __DIR__ . "/basic-page.php";
