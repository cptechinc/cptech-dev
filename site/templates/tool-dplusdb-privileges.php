<?php


	$databases = array(
		'dplusdata' => $modules->get('DplusDatabase'),
		'dpluso' => $modules->get('DplusOnlineDatabase'),
	);

	if ($input->get->tables) {
		$tables = $input->get->array('tables');
		$userid = $input->get->text('user');
		$db     = $input->get->text('db');
		$dbtype = $input->get->text('dbtype');
		//$page->body =  $config->twig->render('tools/database/privileges/form.twig', ['page'=> $page, 'databases' => $databases, 'tables' => $tables, 'user' => $userid, 'db' => $db ]);
		$page->body =  $config->twig->render('tools/database/privileges/grant-results.twig', ['page'=> $page, 'databases' => $databases, 'tables' => $tables, 'user' => $userid, 'db' => $db, 'dbtype' => $dbtype]);
	} else {

	}

	if ($config->ajax) {
		echo $page->body;
	} else {
		include __DIR__ . "/basic-page.php";
	}
