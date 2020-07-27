<?php
if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <div class="qodef-container">
            <div class="qodef-container-inner clearfix">
                <div class="qodef-portfolio-single-holder <?php echo esc_attr($holder_classes); ?>">
                    <?php if(post_password_required()) {
                        echo get_the_password_form();
                    } else {
                        do_action('coney_qodef_portfolio_page_before_content');
                    
                        coney_qodef_get_module_template_part('templates/single/layout-collections/'.$item_layout, 'portfolio', '', $params);
                    
                        do_action('coney_qodef_portfolio_page_after_content');
                    
                        coney_qodef_get_module_template_part('templates/single/parts/navigation', 'portfolio', $item_layout);
                    
                        coney_qodef_get_module_template_part('templates/single/parts/comments', 'portfolio');
                    } ?>
                </div>
            </div>
        </div>
    <?php endwhile;
endif;