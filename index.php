<?php
require_once(__DIR__ . '/../../config.php');
require_login();
$PAGE->set_context(context_system::instance());
$PAGE->set_url(new moodle_url('/local/showbadges/index.php'));
$PAGE->set_title(get_string('pluginname', 'local_showbadges'));
$PAGE->set_heading(get_string('pluginname', 'local_showbadges'));

echo $OUTPUT->header();
// Content generating code goes here

echo $OUTPUT->footer();
