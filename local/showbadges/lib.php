<?php
// lib.php
defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/recent_achievements.php');

/**
 * Retrieves all the badges available on the Moodle site.
 * 
 * @return array Array of badges with their details.
 */
function local_showbadges_fetch_all_badges() {
    global $DB;

    $badges = $DB->get_records('badge');
    return $badges;
}

/**
 * Retrieves the badges earned by a specific user.
 * 
 * @param int $userid The ID of the user.
 * @return array Array of badges earned by the user with relevant data.
 */
function local_showbadges_fetch_user_badges($userid) {
    global $DB;

    $sql = "SELECT bg.*, bup.progress, bup.dateearned, bup.dateissued
            FROM {badge} bg
            LEFT JOIN {local_showbadges_progress} bup ON bg.id = bup.badgeid
            WHERE bup.userid = :userid";

    $params = ['userid' => $userid];
    $userBadges = $DB->get_records_sql($sql, $params);
    return $userBadges;
}

/**
 * Helper function to get a structured list of all badges along with a specific user's achievements.
 * 
 * @param int $userid The ID of the user.
 * @return array Structured list of badges with user achievement data.
 */
function local_showbadges_get_badges_and_achievements($userid) {
    $allBadges = local_showbadges_fetch_all_badges();
    $userBadges = local_showbadges_fetch_user_badges($userid);

    foreach ($allBadges as $badge) {
        // Mark if the badge has been earned by the user
        $badge->earned = isset($userBadges[$badge->id]);
        if ($badge->earned) {
            $badge->userprogress = $userBadges[$badge->id]->progress;
            $badge->dateearned = $userBadges[$badge->id]->dateearned;
        } else {
            $badge->userprogress = 0;
            $badge->dateearned = null;
        }
    }

    return $allBadges;
}

