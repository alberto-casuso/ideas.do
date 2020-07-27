<li class="qodef-bl-item clearfix">
	<div class="qodef-bli-inner">
        <div class="qodef-bli-content-holder">
            <?php coney_qodef_get_module_template_part('templates/parts/image', 'blog', '', $params); ?>

            <div class="qodef-bli-content">
                <div class="qodef-bli-info">
                    <?php
                    if ($post_info_date == 'yes') {
                        coney_qodef_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params);
                    }
                    if ($post_info_category == 'yes') {
                        coney_qodef_get_module_template_part('templates/parts/post-info/category', 'blog', '', $params);
                    }
                    if ($post_info_author == 'yes') {
                        coney_qodef_get_module_template_part('templates/parts/post-info/author', 'blog', '', $params);
                    }
                    if ($post_info_comments == 'yes') {
                        coney_qodef_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $params);
                    }
                    if ($post_info_like == 'yes') {
                        coney_qodef_get_module_template_part('templates/parts/post-info/like', 'blog', '', $params);
                    }
                    ?>
                </div>
                <?php coney_qodef_get_module_template_part('templates/parts/title', 'blog', '', $params); ?>
                <?php if($post_excerpt_section == 'yes') { ?>
                <div class="qodef-bli-excerpt">
                    <?php if ($post_info_excerpt == 'yes') {
                        coney_qodef_get_module_template_part('templates/parts/excerpt', 'blog', '', $params);
                    } ?>
                    <div class="qodef-bli-info-bottom clearfix">
                        <?php if ($post_info_read_more == 'yes') {
                            coney_qodef_get_module_template_part('templates/parts/post-info/read-more', 'blog', 'bl', $params);
                        } ?>
                        <?php if ($post_info_share == 'yes') {
                            coney_qodef_get_module_template_part('templates/parts/post-info/share', 'blog', '', $params);
                        } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
	</div>
</li>