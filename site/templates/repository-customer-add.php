<?php
    $page->body = $config->twig->render('repositories/customers/customer-add.twig', ['customer' => $page, 'commits' => $commits]);
    $config->scripts->append(get_hashedtemplatefileurl('scripts/pages/repository.js'));

    include __DIR__ . "/basic-page.php";
