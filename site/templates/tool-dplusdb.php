<?php
	$databases = array(
		'dplusdata' => $modules->get('DplusDatabase'),
		'dpluso' => $modules->get('DplusOnlineDatabase'),
	);
	$page->body =  $config->twig->render('tools/database/page.twig', ['databases' => $databases]);
	$page->js   =  $config->twig->render('tools/database/js.twig');
	include __DIR__ . "/basic-page.php";
