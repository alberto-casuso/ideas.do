<?php defined('ABSPATH') or die("No script kiddies please!");

if (isset($value['required']) && $value['required'] == "enable") {
	$required=__('(Required)','wp-comment-designer-lite');
} else{
	$required ="";
}

if (isset($value['element_type']) && $value['element_type'] == "default") {
    if (isset($value['show_on_form']) && $value['show_on_form'] == "enable") {
            $fields[$key] = '<div class="wpcd-title-value-div wpcd-' . $value['field_type'] . '">
					    		<div class="wpcd-title-div">	
									<label>' . $label . '</label>
								</div>
								<div class="wpcd-value-div">
									<input type="' . $value['field_type'] . '" name="author" value="" placeholder="' . $placeholder . '" id="author" '.$style.'/>
								</div>
							</div>';
    }
}