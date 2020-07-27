<?php

if(!function_exists('coney_qodef_get_vc_version')) {
	/**
	 * Return Visual Composer version string
	 *
	 * @return bool|string
	 */
	function coney_qodef_get_vc_version() {
		if(coney_qodef_visual_composer_installed()) {
			return WPB_VC_VERSION;
		}

		return false;
	}
}