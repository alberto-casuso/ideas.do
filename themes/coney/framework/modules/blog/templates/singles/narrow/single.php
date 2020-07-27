<?php

coney_qodef_get_single_post_format_html($blog_single_type);

coney_qodef_get_module_template_part('templates/parts/single/author-info', 'blog');

coney_qodef_get_module_template_part('templates/parts/single/single-navigation', 'blog');

coney_qodef_get_module_template_part('templates/parts/single/related-posts', 'blog', $related_posts_layout, $single_info_params);

coney_qodef_get_module_template_part('templates/parts/single/comments', 'blog');