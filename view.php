<?php
require_once('../../config.php');
require_once('lib.php');

$id = required_param('id', PARAM_INT);

$cm = get_coursemodule_from_id('quranmemorizationactivity', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$quranmemorizationactivity = $DB->get_record('quranmemorizationactivity', array('id' => $cm->instance), '*', MUST_EXIST);

require_login($course, true, $cm);

$context = context_module::instance($cm->id);

$PAGE->set_url('/mod/quranmemorizationactivity/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($quranmemorizationactivity->name));
$PAGE->set_heading(format_string($course->fullname));

echo $OUTPUT->header();

if ($quranmemorizationactivity->intro) {
    echo $OUTPUT->box(format_module_intro('quranmemorizationactivity', $quranmemorizationactivity, $cm->id), 'generalbox mod_introbox', 'quranmemorizationactivityintro');
}

echo $OUTPUT->heading('Quran Memorization Tracker');

echo $OUTPUT->footer();
