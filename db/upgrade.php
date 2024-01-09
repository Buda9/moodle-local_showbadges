<?php

defined('MOODLE_INTERNAL') || die();

/**
 * xmldb_local_showbadges_upgrade
 *
 * @param int $oldversion The old version of the plugin
 * @return bool
 */
function xmldb_local_showbadges_upgrade($oldversion) {
    global $DB;
    $dbman = $DB->get_manager(); // loads database manager

    if ($oldversion < 2023030100) {
        // Define table local_showbadges_progress to be updated
        $table = new xmldb_table('local_showbadges_progress');

        // Define field completiondate to be added to local_showbadges_progress
        $field = new xmldb_field('completiondate', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'userid');

        // Conditionally launch add field completiondate
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define index courseid (not unique) to be added to local_showbadges_progress
        $index = new xmldb_index('courseid', XMLDB_INDEX_NOTUNIQUE, ['courseid']);

        // Conditionally launch add index courseid
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        // Upgrade savepoint reached
        upgrade_mod_savepoint(true, 2023030100, 'local_showbadges');
    }

    return true;
}

?>