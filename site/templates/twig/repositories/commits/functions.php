<?php
    $function = new Twig_Function('days_commit_text', function ($days, $date) {
        if ((date("G", strtotime($date))) < 12) {
            $timeofday = "AM";
        } else {
            $timeofday = "PM";
        }

        if ($days == 0) {
            return "Committed today at ". date("g:i", strtotime($date)) . " $timeofday";
        } elseif ($days == 1) {
            return "Committed $days day ago";
        } elseif ($days > 1 && $days < 7) {
            return "Committed $days days ago";
        } elseif ($days == 7) {
            return "Committed a week ago";
        } else {
            return "Committed ". date("M j, Y", strtotime($date));
        }
    });
    $config->twig->addFunction($function);
