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

// Add the HTML and link to our custom CSS with lazy loading for images
echo '<link rel="stylesheet" type="text/css" href="' . $CFG->wwwroot . '/local/showbadges/styles.css">';
echo '<div id="user-badge-container" class="user-badge-container">';
foreach ($all_badges as $badge) {
    $earned_class = isset($user_badge_ids[$badge->id]) ? 'earned-badge' : 'unearned-badge';
    echo '<div class="user-badge ' . $earned_class . '" data-badgeid="'.$badge->id.'" data-dateissued="'.($badge->dateissued ?? '0').'">'
        . '<div class="user-badge-image"><img src="'.$badge->imageurl.'" alt="'.s($badge->name).'" loading="lazy"></div>'
        . '<div class="user-badge-name">'.s($badge->name).'</div>'
        . '<div class="user-badge-description">'.s($badge->description).'</div>'
        . '</div>';
}
echo '</div>';

echo $OUTPUT->footer();
