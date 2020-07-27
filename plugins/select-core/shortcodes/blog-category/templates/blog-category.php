<div class="qodef-blog-category-holder">
	<div class="qodef-blog-category-image">
		<?php if(!empty($category_link)) { ?>
	        <a href="<?php echo esc_url($category_link)?>" target="_blank" class="qodef-blog-category-image-link">
	            <?php echo wp_get_attachment_image($category_image, 'full'); ?>
	            <div class="qodef-blog-category-overlay">
		            <div class="qodef-blog-category-name-holder">
			           	<span class="qodef-blog-category-name">
			           		<?php echo esc_attr($category_name); ?>
			           	</span>
			        </div>
			    </div>
	        </a>
	    <?php } ?>
	</div>
</div>