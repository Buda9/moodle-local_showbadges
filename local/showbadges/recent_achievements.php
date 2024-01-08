<?php
// recent_achievements.php
defined('MOODLE_INTERNAL') || die();

// This function fetches recent achievements
function local_showbadges_fetch_recent_achievements($userid) {
    global $DB;

    $sql = "SELECT b.id, b.name, b.description
              FROM {badge} b
              JOIN {badge_issued} bi ON bi.badgeid = b.id
             WHERE bi.userid = :userid
             ORDER BY bi.dateissued DESC";

    try {
        $badges = $DB->get_records_sql($sql, ['userid' => $userid]);
    } catch (dml_exception $e) {
        // Handle database retrieval error
        error_log('Error fetching recent achievements: ' . $e->getMessage());
        return false;
    }

    return array_values($badges);
}
