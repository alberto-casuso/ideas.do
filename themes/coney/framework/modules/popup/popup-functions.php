<?php
if ( ! function_exists('coney_qodef_get_popup') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function coney_qodef_get_popup() {

        if ( coney_qodef_active_widget( false, false, 'qode_popup_opener' ) ) {
            if(coney_qodef_options()->getOptionValue('enable_popup') == 'yes') {
                coney_qodef_load_popup_template();
            }

        }
    }

}

if ( ! function_exists('coney_qodef_load_popup_template') ) {
    /**
     * Loads HTML template with parameters
     */
    function coney_qodef_load_popup_template() {
        $parameters = array();
        $parameters['title'] = coney_qodef_options()->getOptionValue('popup_title');
        $parameters['subtitle'] = coney_qodef_options()->getOptionValue('popup_subtitle');
        $parameters['contact_form'] = coney_qodef_options()->getOptionValue('popup_contact_form');
        $parameters['contact_form_style'] = coney_qodef_options()->getOptionValue('popup_contact_form_style');
        coney_qodef_get_module_template_part( 'templates/popup', 'popup', '', $parameters );
    }

}