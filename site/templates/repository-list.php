<?php 
	$projects = $page;
	$github = new GitHubClient();
	$github->setCredentials($config->github_login, $config->github_login_password);
	$repository_list = $page->children();
	$github_repos = $github->repos->listOrganizationRepositories($projects->owner);
	
	foreach ($github_repos as $github_repo) {
		$reponame = $github_repo->getName();
		
		if (!$page->numChildren("template=repository,name=$reponame,include=all")) {
			$p = new Page();
			$p->template = 'repository';
			$p->parent = $page;
			$p->name = $github_repo->getName();
			$p->status(Page::statusUnpublished);
		} else {
			$p = $page->child("template=repository,name=$reponame,include=all");
			$p->of(false);
		}
		
		$p->owner = $projects->owner;
		$p->title = ucwords(str_replace('-', ' ', $github_repo->getName()));
		$p->summary = $github_repo->getDescription();
		$p->save();
		$p->of(true);
	}
	
	$page->body = $config->twig->render('repositories/repositories-list.twig', ['repos' => $repository_list]); 
	include __DIR__ . "/basic-page.php";
