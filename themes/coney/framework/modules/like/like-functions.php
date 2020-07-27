<?php

if ( ! function_exists('coney_qodef_like') ) {
	/**
	 * Returns ConeyQodefLike instance
	 *
	 * @return ConeyQodefLike
	 */
	function coney_qodef_like() {
		return ConeyQodefLike::get_instance();
	}
}

function coney_qodef_get_like() {

	echo wp_kses(coney_qodef_like()->add_like(), array(
        'span'  => array(
            'class'       => true,
            'aria-hidden' => true,
            'style'       => true,
            'id'          => true
        ),
        'i'     => array(
            'class' => true,
            'style' => true,
            'id'    => true
        ),
        'a'     => array(
            'href'         => true,
            'class'        => true,
            'id'           => true,
            'title'        => true,
            'style'        => true,
            'data-post-id' => true
        ),
        'input' => array(
            'type'  => true,
            'name'  => true,
            'id'    => true,
            'value' => true
        )
	));
}

if ( ! function_exists('coney_qodef_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function coney_qodef_like_latest_posts() {
		return coney_qodef_like()->add_like();
	}
}

if ( ! function_exists('coney_qodef_like_portfolio_list') ) {
	/**
	 * Add like to portfolio project
	 *
	 * @param $portfolio_project_id
	 * @return string
	 */
	function coney_qodef_like_portfolio_list($portfolio_project_id) {
		return coney_qodef_like()->add_like_portfolio_list($portfolio_project_id);
	}
}