<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?= strip_tags(html_entity_decode($page->get('pagetitle|headline|title'))); ?></title>
		<link rel="shortcut icon" href="<?php //echo $config->urls->files."images/ddplus.ico"; ?>">
		<meta name="description" content="<?= $page->summary; ?>" />
		<?php foreach($config->styles->unique() as $css) : ?>
			<link rel="stylesheet" type="text/css" href="<?= $css; ?>" />
		<?php endforeach; ?>
	</head>
	<body>
