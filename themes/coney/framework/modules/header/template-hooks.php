<?php

//top header bar
add_action('coney_qodef_before_page_header', 'coney_qodef_get_header_top');

//mobile header
add_action('coney_qodef_after_page_header', 'coney_qodef_get_mobile_header');