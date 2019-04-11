<?php
	include($config->paths->templates."/twig/repositories/commits/functions.php");
	$repository = $page->parent;

	$github = $modules->get('GitHubConnector');
	$github->import_commits($repository);
	$customers = $repository->child('name=customers')->children();
	$selector = '';

	$fields_toinputs = array(
		'date' => array(
			array(
				'input'     => 'date',
				'field'     => 'date',
				'valuetype' => 'array',
				'delimiter' => '|',
				'operator'  => '>=|<='
			),
			array(
				'input'     => 'after',
				'field'     => 'date',
				'valuetype' => 'single',
				'operator'  => '>'
			),
			array(
				'input'     => 'before',
				'field'     => 'date',
				'valuetype' => 'single',
				'operator'  => '<'
			)
		),
	);

	if ($input->get->after || $input->get->before) {
		$field_date = $fields->get('date');
		$dateformat = "$field_date->dateInputFormat $field_date->timeInputFormat";

		if ($input->get->after) {
			$sha = $input->get->text('after');

			if ($page->hasChildren("name=$sha")) {
				$aftercommit = $page->get("name=$sha");
				$input->get->after = date($dateformat, $aftercommit->getUnformatted('date'));
			} else {
				$input->get->after = '';
			}
		}

		if ($input->get->before) {
			$sha = $input->get->text('before');

			if ($page->hasChildren("name=$sha")) {
				$beforecommit = $page->get("name=$sha");
				$input->get->before = date($dateformat, $aftercommit->getUnformatted('date'));
			} else {
				$input->get->before = '';
			}
		}
	}

	if ($input->get->text('afterdate') || $input->get->text('beforedate')) {
		if ($input->get->text('afterdate')) {
			$afterdate = $input->get->text('afterdate');
			$input->get->after = date('m/d/Y', strtotime($afterdate));
		} else {
			$input->get->after = '';
		}

		if ($input->get->text('beforedate')) {
			$beforedate = $input->get->text('beforedate');
			$input->get->before = date('m/d/Y', strtotime($beforedate));
		} else {
			$input->get->before = '';
		}
	}

	$selector .= ",".$modules->get('SelectorsFilter')->build_selectorstring($input, 'repository-commit', $fields_toinputs);


	$commits = $page->children($selector);
	$selectors = $commits->getSelectors();

	if ($selectors->is_filtering('repository-commit')) {
		$page->title = "Commits with " . $selectors->describe('repository-commit');
	}


	$page->body = $config->twig->render('repositories/commits/commits-table.twig', ['page' => $page, 'input' => $input, 'commits' => $commits, 'customers' => $customers, 'firstcommit' => $aftercommit, 'lastcommit' => $beforecommit]);
	$config->scripts->append(get_hashedtemplatefileurl('scripts/pages/repository.js'));
	include __DIR__ . "/basic-page.php";
