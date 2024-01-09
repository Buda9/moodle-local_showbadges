<?php

namespace local_showbadges;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/badgeslib.php');
require_once($CFG->libdir . '/filelib.php');

class badge_fetcher {

    public static function fetch_all_badges() {
        global $DB;

        $sql = "SELECT id, name, description FROM {badge}";
        $badges = $DB->get_records_sql($sql);

        foreach ($badges as $badge) {
            $badge->imageurl = self::get_badge_image_url($badge->id);
        }

        return $badges;
    }

    public static function fetch_user_badges($userid) {
        global $DB;

        $sql = "SELECT b.id, b.name, b.description, ub.dateissued, ub.badgeid 
                FROM {badge_issued} ub 
                JOIN {badge} b ON ub.badgeid = b.id 
                WHERE ub.userid = :userid";

        $params = ['userid' => $userid];
        $user_badges = $DB->get_records_sql($sql, $params);

        foreach ($user_badges as $badge) {
            $badge->imageurl = self::get_badge_image_url($badge->badgeid);
        }

        return $user_badges;
    }

    public static function fetch_user_badge_progress($userid) {
        global $DB;

        $sql = "SELECT p.badgeid, p.progress, p.lastupdated, b.name, b.description
                FROM {local_showbadges_progress} p 
                JOIN {badge} b ON p.badgeid = b.id 
                WHERE p.userid = :userid";

        $params = ['userid' => $userid];
        $progress_data = $DB->get_records_sql($sql, $params);

        foreach ($progress_data as $progress) {
            $progress->imageurl = self::get_badge_image_url($progress->badgeid);
        }

        return $progress_data;
    }

    private static function get_badge_image_url($badgeid) {
        global $CFG, $DB;

        $fs = get_file_storage();

        $badge = new \badge($badgeid);
        $contextid = ($badge->type == BADGE_TYPE_COURSE) ? \context_course::instance($badge->courseid)->id : \context_system::instance()->id;

        $files = $fs->get_area_files($contextid, 'badges', 'badgeimage', $badgeid);
        foreach ($files as $file) {
            if ($file->is_valid_image()) {
                $filename = $file->get_filename();

                // Uklonite ekstenziju '.png' samo ako postoji
                $fileinfo = pathinfo($filename);
                if (strtolower($fileinfo['extension']) == 'png') {
                    $filename = $fileinfo['filename'];
                }

                return \moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), 
                                                        $file->get_filearea(), $file->get_itemid(), 
                                                        $file->get_filepath(), $filename)->out();
            }
        }

        return $CFG->wwwroot . '/path/to/default/image.png';
    }

    public static function fetch_recent_badges($userid, $limit = 5) {
        global $DB;

        $sql = "SELECT bi.badgeid, b.name, b.description, bi.dateissued
                FROM {badge_issued} bi
                INNER JOIN {badge} b ON bi.badgeid = b.id
                WHERE bi.userid = :userid
                ORDER BY bi.dateissued DESC";

        $params = ['userid' => $userid];
        $recent_badges = $DB->get_records_sql($sql, $params, 0, $limit);

        foreach ($recent_badges as $badge) {
            $badge->imageurl = self::get_badge_image_url($badge->badgeid);
        }

        return $recent_badges;
    }
}

?>