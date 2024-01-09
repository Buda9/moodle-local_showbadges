<?php

namespace local_showbadges\task;

defined('MOODLE_INTERNAL') || die();

class update_badge_progress extends \core\task\scheduled_task {

    public function get_name() {
        return get_string('update_badge_progress_task', 'local_showbadges');
    }

    public function execute() {
        global $DB;

        $badge_progress_data = $this->get_badge_progress_data();
        foreach ($badge_progress_data as $progress) {
            // INPUT_REQUIRED Implement the logic to calculate and update badge progress.
            // Example placeholder line below:
            $progress->progress = $this->calculate_new_progress($progress);
            $progress->lastupdated = time();

            $DB->update_record('local_showbadges_progress', $progress);
        }

        mtrace("Badge progress data updated.");
    }

    private function get_badge_progress_data() {
        global $DB;
        // INPUT_REQUIRED Provide the actual SQL or function calls to fetch the badge progress data.
        return $DB->get_records('local_showbadges_progress');
    }

    private function calculate_new_progress($progress) {
        global $DB;
    
        // Fetch badge criteria. This would be your own implementation
        // For example, you might have a function get_badge_criteria($badgeid) that returns the criteria
        $criteria = $this->get_badge_criteria($progress->badgeid);
    
        // Fetch user's achievements towards this badge
        // This is another function you would implement based on your application logic
        $userAchievements = $this->get_user_achievements($progress->userid, $progress->badgeid);
    
        // Calculate progress
        $totalCriteria = count($criteria);
        $completedCriteria = count(array_intersect($criteria, $userAchievements));
    
        // Calculate progress as a percentage
        $progressPercentage = ($totalCriteria > 0) ? ($completedCriteria / $totalCriteria) * 100 : 0;
    
        return $progressPercentage;
    }

    private function get_badge_criteria($badgeid) {
        global $DB;
    
        // Assuming you have a table or a way to define what constitutes completion criteria for each badge.
        // This is a placeholder and needs to be adjusted to match your database schema and logic.
        $criteria = $DB->get_records('badge_criteria', array('badgeid' => $badgeid));
    
        // Convert the database records to a usable array of criteria.
        $criteriaList = [];
        foreach ($criteria as $criterion) {
            // Here, 'criterion_detail' is a hypothetical column that describes a single criterion.
            // You need to replace it with the actual column name or logic.
            $criteriaList[] = $criterion->criterion_detail;
        }
    
        return $criteriaList;
    }

    private function get_user_achievements($userid, $badgeid) {
        global $DB;
    
        // Assuming you track user achievements towards badges in some way.
        // This is a placeholder and needs to be adjusted to match your database schema and logic.
        $achievements = $DB->get_records('user_badge_achievements', array('userid' => $userid, 'badgeid' => $badgeid));
    
        // Convert the database records to a usable array of achievements.
        $achievementList = [];
        foreach ($achievements as $achievement) {
            // Here, 'achievement_detail' is a hypothetical column that describes a single achievement.
            // You need to replace it with the actual column name or logic.
            $achievementList[] = $achievement->achievement_detail;
        }
    
        return $achievementList;
    }
}