<?php

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    global $CFG, $USER, $DB;

    $moderator = get_admin();
    $site = get_site();

    $settings = new admin_settingpage('local_forgotpassword', get_string('pluginname', 'local_forgotpassword'));
    $ADMIN->add('localplugins', $settings);

    $settings->add(new admin_setting_configcheckbox(
        'local_forgotpassword/enabled', 
        get_string('enabled', 'local_forgotpassword'),
        get_string('enabled_desc', 'local_forgotpassword'),
        0
    ));
}