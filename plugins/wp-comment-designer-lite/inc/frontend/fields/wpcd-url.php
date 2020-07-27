<?php defined('ABSPATH') or die("No script kiddies please!");

if (isset($value['show_on_form']) && $value['show_on_form'] == "enable") {
        $fields[$key] = '<div class="wpcd-title-value-div wpcd-' . $value['field_type'] . '">
				    					<div class="wpcd-title-div">	
											<label>' . $label . '</label>
										</div>
										<div class="wpcd-value-div">
											<input id="wpcd-demo-url" type="' . $value['field_type'] . '" name="url" value="' . esc_attr($commenter['comment_author_url']) . '" placeholder="' . $placeholder . '" '.$style.'/>
										</div>
									</div>';
}