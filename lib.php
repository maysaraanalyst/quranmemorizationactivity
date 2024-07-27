<?php
defined('MOODLE_INTERNAL') || die();

function quranmemorizationactivity_add_instance($quranmemorizationactivity) {
    global $DB;

    $quranmemorizationactivity->timecreated = time();
    $quranmemorizationactivity->timemodified = time();

    return $DB->insert_record('quranmemorizationactivity', $quranmemorizationactivity);
}

function quranmemorizationactivity_update_instance($quranmemorizationactivity) {
    global $DB;

    $quranmemorizationactivity->timemodified = time();
    $quranmemorizationactivity->id = $quranmemorizationactivity->instance;

    return $DB->update_record('quranmemorizationactivity', $quranmemorizationactivity);
}

function quranmemorizationactivity_delete_instance($id) {
    global $DB;

    if (!$quranmemorizationactivity = $DB->get_record('quranmemorizationactivity', array('id' => $id))) {
        return false;
    }

    $DB->delete_records('quranmemorizationactivity', array('id' => $quranmemorizationactivity->id));
    $DB->delete_records('quranmemorizationactivity_memorization', array('activityid' => $quranmemorizationactivity->id));

    return true;
}

function quranmemorizationactivity_user_complete($course, $user, $mod, $quranmemorizationactivity) {
    global $DB, $OUTPUT;

    $memorization = $DB->get_records('quranmemorizationactivity_memorization', array('activityid' => $quranmemorizationactivity->id, 'userid' => $user->id));

    if ($memorization) {
        foreach ($memorization as $mem) {
            echo $OUTPUT->box(format_string("Surah: {$mem->surah}, Ayah: {$mem->ayah}, Status: {$mem->status}"));
        }
    } else {
        echo $OUTPUT->box(get_string('norecords', 'mod_quranmemorizationactivity'));
    }
}
