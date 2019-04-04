<?php
	include('./_head-blank.php');

    if($user->isLoggedin()) {
        // user is already logged in, so they don't need to be here
        $session->redirect("/dev/");
    }

    if ($input->requestMethod('POST')) {
        $username = $input->post->text('username');
        $password = $input->post->text('password');
    }

    // check for login before outputting markup
    if ($username && $password) {

        $user = $sanitizer->username($username);
        $pass = $password;

        if ($session->login($user, $pass)) {
            // login successful
            $session->redirect("/dev/");
        } else {
            $session->redirect("/dev/login/");
        }
    }

	$errormsg = get_loginerrormsg(session_id());
	$date = date('Y');

	$config->twig->display('login.twig', ['page' => $page, 'user' => $user, 'pages' => $pages, 'errormsg' => $errormsg, 'date' => $date]);

	include('./_foot-blank.php'); ?>
