<?php defined('ABSPATH') or die("No script kiddies please!");
if (isset($value['required']) && $value['required'] == "enable") {
    $required=__('(Required)','wp-comment-designer-lite');
} else{
    $required ="";
}

if (isset($value['element_type']) && $value['element_type'] == "default") {
        $fields[$key] = '<div class="wpcd-title-value-div wpcd-' . $value['field_type'] . '">
        <div class="wpcd-title-div">	
        <label>' . $label . '</label>
        </div>
        <div class="wpcd-value-div">
        <textarea name="comment" id="comment" cols="45" rows="8" class="textarea-comment" placeholder="'.$placeholder.'" '.$style.'></textarea>
        </div>
        </div>';
}