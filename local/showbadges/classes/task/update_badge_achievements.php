<?php
namespace local_showbadges\task;

class update_badge_achievements extends \core\task\scheduled_task {      
    
    public function get_name() {
        return get_string('updatebadgeachievements', 'local_showbadges');
    }
     
    public function execute() {
        global $DB;
        $sql = "SELECT bup.id, bup.userid, bup.badgeid
                FROM {local_showbadges_progress} bup
                JOIN {badge} b
                ON bup.badgeid = b.id
                WHERE bup.progress < 100";

        $badgeProgressRecords = $DB->get_records_sql($sql);
        foreach ($badgeProgressRecords as $record) {
            // INPUT_REQUIRED {Place logic here to check badge achievement criteria and update progress to 100 if met}
            $record->progress = 100;
            $record->dateearned = time();
            $DB->update_record('local_showbadges_progress', $record);
        }
    }
}
