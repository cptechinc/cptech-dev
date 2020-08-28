<?php
$filter = new Twig_Filter('values', function ($array) {
	return array_values($array);
});
$config->twig->addFilter($filter);
