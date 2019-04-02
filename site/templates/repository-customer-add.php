<?php
    $module_repo = $modules->get('GitHubRepositories');

    $customers = $page->siblings('template=repository-customer');

    if ($input->requestMethod('POST')) {
        $custtitle = $input->post->text('custtitle');
        $custrepo = $input->post->text('custrepo');
        $custcode = $input->post->text('custcode');
        $custnote = $input->post->text('custnote');

        $does_exist = $customers->find("repo=$custrepo")->count;

        if ($does_exist) {
            $success = false;
        } else {
            $success = $module_repo->add_customer($custtitle, $custrepo, $custcode, $custnote);
        }
    }

    $inputpost = $input->requestMethod('POST');

    $page->body = $config->twig->render('repositories/customers/customer-add.twig', ['page' => $page, 'customer' => $page, 'commits' => $commits, 'inputpost' => $inputpost, 'success' => $success, 'custtitle' => $custtitle]);
    $config->scripts->append(get_hashedtemplatefileurl('scripts/pages/repository.js'));

    include __DIR__ . "/basic-page.php";
