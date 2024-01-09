<?php
defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => 'local_showbadges\\task\\update_badge_progress',
        'blocking' => 0,
        'minute' => '0',
        'hour' => '2',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    ),
);