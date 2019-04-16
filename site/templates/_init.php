<?php
	use Dplus\Base\StringerBell;
	use Dplus\Content\HTMLWriter;

	/**
	 * Initialization file for template files
	 *
	 * This file is automatically included as a result of $config->prependTemplateFile
	 * option specified in your /site/config.php.
	 *
	 * You can initialize anything you want to here. In the case of this beginner profile,
	 * we are using it just to include another file with shared functions.
	 *
	 */

	include_once("./_func.php"); // include our shared functions
	include_once("./_dbfunc.php"); // include our shared functions

	$page->stringerbell = new StringerBell();
	$page->htmlwriter = new HTMLWriter();

	$config->styles->append(get_hashedtemplatefileurl('styles/bootstrap.min.css'));
	$config->styles->append(get_hashedtemplatefileurl('styles/libs/font-awesome.min.css'));
	$config->styles->append('//www.fuelcdn.com/fuelux/3.13.0/css/fuelux.min.css');
	$config->styles->append(get_hashedtemplatefileurl('styles/styles.css'));

	$config->scripts->append(get_hashedtemplatefileurl('scripts/libs/libraries.js'));
	$config->scripts->append(get_hashedtemplatefileurl('scripts/libs/jquery.js'));
	$config->scripts->append(get_hashedtemplatefileurl('scripts/libs/popper.js'));
	$config->scripts->append(get_hashedtemplatefileurl('scripts/libs/bootstrap.min.js'));
	$config->scripts->append(get_hashedtemplatefileurl('scripts/libs/bootstrap-notify.min.js'));
	$config->scripts->append('//www.fuelcdn.com/fuelux/3.13.0/js/fuelux.min.js');
	$config->scripts->append(get_hashedtemplatefileurl('scripts/scripts.js'));
	$config->scripts->append(get_hashedtemplatefileurl('scripts/main.js'));

	$appconfig = $pages->get('/config/');

	if ($page->template != 'login' && !$user->isLoggedin()) {
		$session->redirect($pages->get('template=login')->url);
	}

	$page->fullURL = new \Purl\Url($page->httpUrl);
	$page->fullURL->path = '';

	if (!empty($config->filename) && $config->filename != '/') {
		$page->fullURL->join($config->filename);
	}

	if ($input->get->modal) {
		$config->modal = true;
	}

	if ($input->get->json) {
		$config->json = true;
	}

	$loader = new Twig_Loader_Filesystem($config->paths->templates.'twig/');
	$config->twig = new Twig_Environment($loader, [
	    'cache' => $config->paths->templates.'twig/cache/',
	    'auto_reload' => true
	]);
