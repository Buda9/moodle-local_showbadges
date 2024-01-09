<?php

namespace local_showbadges;

defined('MOODLE_INTERNAL') || die();

class dashboard_fetcher {
    public static function fetch_user_progress($userid) {
        $badge_progress = badge_fetcher::fetch_user_badge_progress($userid);
        $recent_badges = badge_fetcher::fetch_recent_badges($userid);

        return [
            'progress' => $badge_progress,
            'recent_badges' => $recent_badges
        ];
    }

    public static function fetch_recent_badges($userid, $limit = 5) {
        global $DB;
    
        $sql = "SELECT bi.badgeid, b.name, b.description, bi.dateissued
                FROM {badge_issued} bi
                INNER JOIN {badge} b ON bi.badgeid = b.id
                WHERE bi.userid = :userid
                ORDER BY bi.dateissued DESC
                LIMIT :limit";

        $params = ['userid' => $userid, 'limit' => $limit];
        $recent_badges = $DB->get_records_sql($sql, $params);

        foreach ($recent_badges as $badge) {
            $badge->imageurl = badge_fetcher::get_badge_image_url($badge->badgeid);
        }

        return $recent_badges;
    }
}
