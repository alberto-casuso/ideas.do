<?php get_header(); ?>
<?php
$qodef_sidebar_layout  = coney_qodef_sidebar_layout();
$qodef_sidebar_classes = coney_qodef_sidebar_columns_class();

?>
<?php coney_qodef_get_title(); ?>
    <div class="qodef-container">
		<?php do_action( 'coney_qodef_after_container_open' ); ?>
        <div class="qodef-container-inner clearfix">
            <div class="qodef-container">
				<?php do_action( 'coney_qodef_after_container_open' ); ?>
                <div class="qodef-container-inner">
                    <div class="qodef-columns-wrapper <?php echo esc_attr( $qodef_sidebar_classes ); ?>">
                        <div class="qodef-columns-inner">
                            <div class="qodef-column-content qodef-column-content1">
                                <div class="qodef-search-page-holder">
                                    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="qodef-search-page-form" method="get">
                                        <div class="qodef-form-holder">
                                            <div class="qodef-column-left">
                                                <input type="text" name="s" class="qodef-search-field" autocomplete="off" value="" placeholder="<?php esc_attr_e( 'Busca nuevamente…', 'coney' ); ?>"/>
                                            </div>
                                            <div class="qodef-column-right">
                                                <button type="submit" class="qodef-search-submit">
                                                    <span class="icon_search"></span></button>
                                            </div>
                                        </div>
                                        <div class="qodef-search-label">
											<?php esc_html_e( "¿No encontraste lo que buscas? Prueba buscar otra palabra", "coney" ); ?>
                                        </div>
                                    </form>
									<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                            <div class="qodef-post-content">
												<?php if ( has_post_thumbnail() ) { ?>
                                                    <div class="qodef-post-image">
                                                        <a itemprop="url" href="<?php the_permalink(); ?>"
                                                                title="<?php the_title_attribute(); ?>">
															<?php the_post_thumbnail( 'thumbnail' ); ?>
                                                        </a>
                                                    </div>
												<?php } ?>
                                                <div class="qodef-post-title-area <?php if ( ! has_post_thumbnail() ) {
													echo esc_attr( 'qodef-no-thumbnail' );
												} ?>">
                                                    <div class="qodef-post-title-area-inner">
                                                        <h3 itemprop="name" class="entry-title">
                                                            <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                        </h3>
														<?php
														$qodef_my_excerpt = get_the_excerpt();
														if ( $qodef_my_excerpt != '' ) { ?>
                                                            <p itemprop="description" class="qodef-post-excerpt"><?php echo esc_html( $qodef_my_excerpt ); ?></p>
														<?php }
														?>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
									<?php endwhile; ?>
									<?php else: ?>
                                        <p class="qodef-blog-no-posts"><?php esc_html_e( 'No se encontraron resultados.', 'coney' ); ?></p>
									<?php endif; ?>
									<?php
									if ( get_query_var( 'paged' ) ) {
										$qodef_paged = get_query_var( 'paged' );
									} elseif ( get_query_var( 'page' ) ) {
										$qodef_paged = get_query_var( 'page' );
									} else {
										$qodef_paged = 1;
									}

									$qodef_params['max_num_pages'] = coney_qodef_get_max_number_of_pages();
									$qodef_params['paged']         = $qodef_paged;
									coney_qodef_get_module_template_part( 'templates/parts/pagination/standard', 'blog', '', $qodef_params );
									?>
                                </div>
								<?php do_action( 'coney_qodef_page_after_content' ); ?>
                            </div>
							<?php if ( $qodef_sidebar_layout !== 'no-sidebar' ) { ?>
                                <div class="qodef-column-content qodef-column-content2">
									<?php get_sidebar(); ?>
                                </div>
							<?php } ?>
                        </div>
                    </div>
					<?php do_action( 'coney_qodef_before_container_close' ); ?>
                </div>
            </div>
        </div>
		<?php do_action( 'coney_qodef_before_container_close' ); ?>
    </div>
<?php get_footer(); ?>