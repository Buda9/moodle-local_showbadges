<?php
require_once(__DIR__ . '/../../config.php');
require_once('./classes/badge_fetcher.php');
require_login();
$PAGE->set_context(context_system::instance());
$PAGE->set_url(new moodle_url('/local/showbadges/index.php'));
$PAGE->set_title(get_string('pluginname', 'local_showbadges'));
$PAGE->set_heading(get_string('pluginname', 'local_showbadges'));

// Fetch all badges and user's badges
$all_badges = local_showbadges\badge_fetcher::fetch_all_badges();
$user_badges = local_showbadges\badge_fetcher::fetch_user_badges($USER->id);

$user_badge_ids = [];
foreach ($user_badges as $badge) {
    $user_badge_ids[$badge->badgeid] = true;
}

echo $OUTPUT->header();

// Add the HTML and link to our custom CSS
// [OLD CODE] Output of $OUTPUT->header()
echo '<link rel="stylesheet" type="text/css" href="' . $CFG->wwwroot . '/local/showbadges/styles.css">';
echo '<div id="badge-container" class="badge-container">';
foreach ($all_badges as $badge) {
    $earned_class = isset($user_badge_ids[$badge->id]) ? 'earned-badge' : 'unearned-badge';
    echo '<div class="badge ' . $earned_class . '" data-badgeid="'.$badge->id.'">'
        . '<div class="badge-image"><img src="'.$badge->imageurl.'" alt="'.s($badge->name).'"></div>'
        . '<div class="badge-name">'.s($badge->name).'</div>'
        . '<div class="badge-description">'.s($badge->description).'</div>'
      . '</div>';
}
echo '</div>';

// Add the script link for future interactivity
// [OLD CODE] Output of $OUTPUT->footer()
echo '<script src="' . $CFG->wwwroot . '/local/showbadges/scripts.js"></script>';
echo $OUTPUT->footer();
?>