<div class="qodef-price-table">
	<div class="qodef-pt-inner" <?php echo coney_qodef_get_inline_style($holder_styles); ?>>
		<ul>
			<li class="qodef-pt-title-holder">
				<span class="qodef-pt-title" <?php echo coney_qodef_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></span>
			</li>
			<li class="qodef-pt-prices">
				<sup class="qodef-pt-value" <?php echo coney_qodef_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></sup>
				<span class="qodef-pt-price" <?php echo coney_qodef_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
				<h6 class="qodef-pt-mark" <?php echo coney_qodef_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></h6>
			</li>
			<li class="qodef-pt-content">
				<?php echo do_shortcode($content); ?>
			</li>
			<?php 
			if(!empty($button_text)) { ?>
				<li class="qodef-pt-button">
					<?php echo coney_qodef_get_button_html(array(
						'link' => $link,
						'text' => $button_text,
						'type' => $button_type,
                        'size' => 'large'
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>