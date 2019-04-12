<?php
    $session->logout();
    $session->redirect($pages->get('template=login')->url);
