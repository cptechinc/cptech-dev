<?php
    $commitspage = $page;
    $repository = $commitspage->parent;

    $github = new GitHubClient();
    $github->setCredentials($config->github_login, $config->github_login_password);
    $github->setPage(1);
    
    // Returns array<GitHubCommit>
    $commits = $github->repos->commits->listCommitsOnRepository($repository->owner, $repository->name, 'master');
    $customers = $repository->child('name=customers')->children();

    import_commits($commitspage, $commits);

    $commitpages = $page->children('sort=-date');

    include($config->paths->templates."/twig/repositories/commits/functions.php");

    $page->body = $config->twig->render('repositories/commits/commits-table.twig', ['commits' => $commitpages, 'customers' => $customers]);
    $config->scripts->append(get_hashedtemplatefileurl('scripts/pages/repository.js'));
    include __DIR__ . "/basic-page.php";
