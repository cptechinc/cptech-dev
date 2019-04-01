<?php
	$requestmethod  = strtolower($input->requestMethod());

	if ($input->requestMethod('POST')) {
		$response = array(
			'error' => false,
			'message' => '',
			'commit' => $page->name
		);
		$page->of(false);
		$action = $input->$requestmethod->text('action');

		switch ($action) {
			case 'save-note':
				$page->note = trim($input->$requestmethod->text('note'));
				$response['message'] = "Your note for $page->name has been saved";
				break;
			case 'save-customer':
				$custID = $input->$requestmethod->text('custID');
				$committed = $input->$requestmethod->text('comitted');
				$customer = $page->parent("template=repository")->child('template=repository-customer-list')->child("name=$custID");

				if (strtoupper($committed) == 'Y') {
					$page->commit_customers->add($customer);
					$response['message'] = "$customer->title has been added to the list of this commit's ($page->name) customer list";
				} else {
					$page->commit_customers->remove($customer);
					$response['message'] = "$customer->title has been removed from the list of this commit's ($page->name) customer list";
				}
				break;
		}
		$saved = $page->save();
		$response['error'] = !$saved;

		if ($response['error']) {
			$response['message'] = "Error adding changes to commit $page->name";
		}
		include __DIR__ . "/_json.php";
	} else {
		$page->title = "Commit $page->shortsha";
		$commit = $page;
		$repository = $commit->parent('template=repository'); // Goes up 2 levels
		$customers = $repository->child('name=customers')->children();

		// Set up GitHub client, Get Github Repo and Commit
		$github = new GitHubClient();
		$github->setCredentials($config->github_login, $config->github_login_password);

		// Instance of GitHubFullCommit
		$github_commit = $github->repos->commits->getSingleCommit($repository->owner, $repository->name, $commit->name);

		include($config->paths->templates."/twig/repositories/commits/functions.php");
		$page->body =  $config->twig->render('repositories/commits/commit-card.twig', ['user' => $user, 'repository' => $repository, 'commit' => $commit, 'customers' => $customers,  'github_commit' => $github_commit]);
		$config->scripts->append(get_hashedtemplatefileurl('scripts/pages/commit.js'));
		include __DIR__ . "/basic-page.php";
	}
