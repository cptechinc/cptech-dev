<?php
	$projects = $page;
	$repository_list = $page->children();
	$github = $modules->get('GitHubAPI');
	$github_repos = $github->repos->list_repos_user($projects->owner);

	foreach ($github_repos as $github_repo) {
		$reponame = $github_repo['name'];

		if (!$page->numChildren("template=repository,name=$reponame,include=all")) {
			$p = new Page();
			$p->template = 'repository';
			$p->parent = $page;
			$p->name = $github_repo['name'];
			$p->status(Page::statusUnpublished);
		} else {
			$p = $page->child("template=repository,name=$reponame,include=all");
			$p->of(false);
		}

		$p->owner = $projects->owner;
		$p->title = ucwords(str_replace('-', ' ', $github_repo['name']));
		$p->summary = $github_repo['description'];
		$p->save();
		$p->of(true);
	}

	$page->body = $config->twig->render('repositories/repositories-list.twig', ['repos' => $repository_list]);
	include __DIR__ . "/basic-page.php";
