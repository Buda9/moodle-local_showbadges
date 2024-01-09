<?php

defined('MOODLE_INTERNAL') || die();

function xmldb_local_showbadges_install() {
    global $DB;

    // Define table local_showbadges_progress to be created
    $table = new xmldb_table('local_showbadges_progress');

    // Adding fields to table local_showbadges_progress
    $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
    $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
    $table->add_field('badgeid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
    $table->add_field('progress', XMLDB_TYPE_INTEGER, '3', null, XMLDB_NOTNULL, null, '0');
    $table->add_field('lastupdated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

    // Adding keys to table local_showbadges_progress
    $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
    $table->add_key('userid', XMLDB_KEY_FOREIGN_UNIQUE, array('userid'), 'mdl_user', array('id'));
    $table->add_key('badgeid', XMLDB_KEY_FOREIGN_UNIQUE, array('badgeid'), 'mdl_badge', array('id'));

    // Conditionally launch create table for local_showbadges_progress
    $dbman = $DB->get_manager();
    if (!$dbman->table_exists($table)) {
        $dbman->create_table($table);
    }

    return true;
}
?>