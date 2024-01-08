<?php
require_once(__DIR__ . '/../../config.php');
require_login();
$PAGE->set_context(context_system::instance());
$PAGE->set_url(new moodle_url('/local/showbadges/index.php'));
$PAGE->set_title(get_string('pluginname', 'local_showbadges'));
$PAGE->set_heading(get_string('pluginname', 'local_showbadges'));

// Include the CSS and JS
$PAGE->requires->css('/local/showbadges/styles.css');
$PAGE->requires->js('/local/showbadges/scripts.js');

echo $OUTPUT->header();

// Fetch badges and recent achievements data for displaying
$userid = $USER->id;
$badges = local_showbadges_get_badges_and_achievements($userid);
$recentAchievements = local_showbadges_fetch_recent_achievements($userid);

// Render the dashboard using the Mustache template
echo $OUTPUT->render_from_template('local_showbadges/dashboard', [
    'badges' => array_map(function($badge) {
        return $badge; // INPUT_REQUIRED {Map additional fields as necessary to match the front-end requirements.}
    }, $badges),
    'recentAchievements' => array_map(function($achievement) use ($userid) {
        $achievement->dateearned = userdate($achievement->dateearned, get_string('strftimedatefullshort', 'core_langconfig'), 99, false, true);
        return $achievement;
    }, $recentAchievements)
]);

echo $OUTPUT->footer();
?>