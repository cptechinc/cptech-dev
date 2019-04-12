<?php
	include('./_head-blank.php');

    if ($input->requestMethod('POST')) {
        $username = $input->post->text('username');
        $password = $input->post->text('password');

		$user = $sanitizer->username($username);

        if ($session->login($user, $password)) {
            // login successful
            $session->redirect($pages->get('template=home')->url);
        } else {
			$errormsg = 'Incorrect username and password. Please try again.';
            $session->redirect($pages->get('template=login')->url);
        }
    }

	$config->twig->display('login.twig', ['page' => $page, 'user' => $user, 'pages' => $pages, 'errormsg' => $errormsg]);

	include('./_foot-blank.php'); ?>
