<?php
    $owner = 'cptechinc';
    $repo = 'soft-dpluso';

    $client = new GitHubClient();
    $client->setCredentials('pauldro', 'w2aww/or');
    $client->setPage();
    $commits = $client->repos->commits->listCommitsOnRepository($owner, $repo);

    include($config->paths->templates."/twig/repositories/commits/functions.php");

    ?>
<?php include('./_head.php'); ?>
	<main role="main">
		<div class="jumbotron bg-dark text-light">
			<div class="container">
				<h1 class="display-3"><?= $page->get('pagetitle|headline|title') ; ?></h1>
			</div>
		</div>
		<div class="container page">
			<table class="table table-striped">
                <?php foreach ($commits as $commit) : ?>
                    <tr>
                        <td><?= $commit->getSha(); ?></td>
                    </tr>
                <?php endforeach; ?>

            </table>
		</div>
	</main>
<?php include('./_foot.php'); // include footer markup ?>
