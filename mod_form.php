<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_quranmemorizationactivity_mod_form extends moodleform_mod {
    public function definition() {
        $mform = $this->_form;

        // General settings
        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->addElement('text', 'name', get_string('quranmemorizationactivityname', 'mod_quranmemorizationactivity'), array('size' => '64'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
        $this->standard_intro_elements();

        // Add standard elements
        $this->standard_coursemodule_elements();

        // Add standard buttons
        $this->add_action_buttons();
    }
}
