<?php
require_once('../../config.php');

$id = required_param('id', PARAM_INT);

$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);

require_login($course);

$context = context_course::instance($course->id);

$PAGE->set_url('/mod/quranmemorizationactivity/index.php', array('id' => $id));
$PAGE->set_title(get_string('modulenameplural', 'mod_quranmemorizationactivity'));
$PAGE->set_heading(format_string($course->fullname));

echo $OUTPUT->header();

if (!$quranmemorizationactivities = get_all_instances_in_course('quranmemorizationactivity', $course)) {
    notice(get_string('noinstances', 'mod_quranmemorizationactivity'), new moodle_url('/course/view.php', array('id' => $course->id)));
}

$table = new html_table();
$table->head = array(get_string('name'), get_string('intro', 'mod_quranmemorizationactivity'));
foreach ($quranmemorizationactivities as $quranmemorizationactivity) {
    $link = html_writer::link(new moodle_url('/mod/quranmemorizationactivity/view.php', array('id' => $quranmemorizationactivity->coursemodule)), format_string($quranmemorizationactivity->name, true));
    $table->data[] = array($link, format_text($quranmemorizationactivity->intro, $quranmemorizationactivity->introformat));
}

echo html_writer::table($table);

echo $OUTPUT->footer();
