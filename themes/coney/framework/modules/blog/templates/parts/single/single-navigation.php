<?php
$blog_single_navigation                = coney_qodef_options()->getOptionValue( 'blog_single_navigation' ) === 'no' ? false : true;
$blog_navigation_through_same_category = coney_qodef_options()->getOptionValue( 'blog_navigation_through_same_category' ) === 'no' ? false : true;
?>
<?php if ( $blog_single_navigation ) { ?>
    <div class="qodef-blog-single-navigation">
        <div class="qodef-blog-single-navigation-inner clearfix">
			<?php
			/* Single navigation section - SETTING PARAMS */
			$post_navigation = array(
				'prev' => array(
					'mark'  => '<span class="qodef-blog-single-nav-mark ion-ios-arrow-thin-left"></span>',
					'label' => '<span class="qodef-blog-single-nav-label">' . esc_html__( 'previous', 'coney' ) . '</span>'
				),
				'next' => array(
					'mark'  => '<span class="qodef-blog-single-nav-mark ion-ios-arrow-thin-right"></span>',
					'label' => '<span class="qodef-blog-single-nav-label">' . esc_html__( 'next', 'coney' ) . '</span>'
				)
			);

			if ( get_previous_post() !== "" ) {
				if ( $blog_navigation_through_same_category ) {
					if ( get_previous_post( true ) !== "" ) {
						$post_navigation['prev']['post'] = get_previous_post( true );
					}
				} else {
					if ( get_previous_post() != "" ) {
						$post_navigation['prev']['post'] = get_previous_post();
					}
				}
			}
			if ( get_next_post() != "" ) {
				if ( $blog_navigation_through_same_category ) {
					if ( get_next_post( true ) !== "" ) {
						$post_navigation['next']['post'] = get_next_post( true );
					}
				} else {
					if ( get_next_post() !== "" ) {
						$post_navigation['next']['post'] = get_next_post();
					}
				}
			}

			/* Single navigation section - RENDERING */
			if ( isset( $post_navigation['prev']['post'] ) || isset( $post_navigation['next']['post'] ) ) {
				foreach ( array( 'prev', 'next' ) as $nav_type ) {
					if ( isset( $post_navigation[ $nav_type ]['post'] ) ) { ?>
                        <a itemprop="url" class="qodef-blog-single-<?php print esc_attr( $nav_type ); ?>" href="<?php echo esc_url( get_permalink( $post_navigation[ $nav_type ]['post']->ID ) ); ?>">
							<?php print coney_qodef_get_module_part( $post_navigation[ $nav_type ]['mark'] ); ?>
							<?php print coney_qodef_get_module_part( $post_navigation[ $nav_type ]['label'] ); ?>
                        </a>
					<?php }
				}
			}
			?>
        </div>
    </div>
<?php } ?>