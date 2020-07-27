<?php

if(!function_exists('coney_qodef_get_video_button_html')) {
    /**
     * Calls button shortcode with given parameters and returns it's output
     * @param $params
     *
     * @return mixed|string
     */
    function coney_qodef_get_video_button_html($params) {
        $video_button_html = coney_qodef_execute_shortcode('qodef_video_button', $params);
        $video_button_html = str_replace("\n", '', $video_button_html);
        return $video_button_html;
    }
}