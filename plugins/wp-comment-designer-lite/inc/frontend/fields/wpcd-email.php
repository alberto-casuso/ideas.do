<?php defined('ABSPATH') or die("No script kiddies please!");

$fields[$key] = '<div class="wpcd-title-value-div wpcd-' . $value['field_type'] . '">
				    					<div class="wpcd-title-div">	
											<label>' . $label . '</label>
										</div>
										<div class="wpcd-value-div">
											<input type="' . $value['field_type'] . '" name="email" value="" placeholder="' . $placeholder . '" id="email" '.$style.'/>
										</div>
									</div>';