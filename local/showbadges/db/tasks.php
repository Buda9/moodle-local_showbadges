<?php
defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => 'local_showbadges\\task\\update_badge_achievements',
        'blocking'  => 0,
        'minute'    => '*/5',
        'hour'      => '*',
        'day'       => '*',
        'dayofweek' => '*',
        'month'     => '*'
    ),
);