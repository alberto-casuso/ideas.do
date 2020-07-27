<?php
$args_pages = array(
    'before'           => '<div class="qodef-single-links-pages"><div class="qodef-single-links-pages-inner">',
    'after'            => '</div></div>',
    'link_before'      => '<span>'. esc_html__('Post Page Link: ', 'coney'),
    'link_after'       => '</span>',
    'pagelink'         => '%'
);

wp_link_pages($args_pages);