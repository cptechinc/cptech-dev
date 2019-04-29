<?php
    $github = $modules->get('GitHubConnector')->get_client();
	$repo = $pages->get('/projects/soft-dpluso/');
	$labels = $github->issues->labels->listAllLabelsForThisRepository($repo->owner, $repo->name);

	foreach ($labels as $label) {
		echo $label->getName() . " # " . $label->getColor() . "<br>";
	}
