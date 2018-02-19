<?php
/*
 * Create a field for the panel
 */
function ea_create_panel_field($type, $name, $label, $value, $columns = 2, $echo = false) {
	$options_group = get_option( EA_SKIPLINKS_ID );
	$current_value = (isset($options_group[$name])) ? $options_group[$name] : '';

	$output     = '<div class="ea-field-group column-'. $columns .'">';

	$output    .= ' <label for="ea-field-'.$name.'">'.$label.'</label>';

	if($type == 'select') {
		$output .= '<select name="'.EA_SKIPLINKS_ID.'['.$name.']" id="ea-field-'.$name.'">';
		foreach ($value as $key => $option_label) {
			$output .= '<option value="'.$key.'" '.selected($current_value, $key, false).'>'.$option_label.'</option>';
		}
		$output .= '</select>';
	} elseif ($type == 'color') {
		$output .= '<input type="color" name="'.EA_SKIPLINKS_ID.'['.$name.']" id="ea-field-'.$name.'" class="color" value="'.$current_value.'">';
	} elseif($type == 'number') {
		$output .= '<input type="number" name="'.EA_SKIPLINKS_ID.'['.$name.']" id="ea-field-'.$name.'" class="number" value="'.$current_value.'">';
	} else {
		$output .= '<input type="text" name="'.EA_SKIPLINKS_ID.'['.$name.']" id="ea-field-'.$name.'" value="'.$current_value.'">';
	}

	$output    .= '</div>';

	if($echo == false)
		return $output;
	elseif ($echo == true)
		echo $output;
}

/*
 * Create a field for the meta
 */
function ea_create_meta_field($post, $type, $name, $label, $value, $columns = 2, $echo = false) {
	$options_group = get_option( 'everaccess_skiplinks' );
	$option_name = substr($name, 4);
	$current_value = ( $options_group[$option_name] ) ? $options_group[$option_name] : '';
	$current_value = ( get_post_meta($post->ID, $name, true) ) ? get_post_meta($post->ID, $name, true) : $current_value;

	$output     = '<div class="ea-field-group column-'. $columns .'">';

	$output    .= ' <label for="ea-field-'.$name.'">'.$label.'</label>';

	if($type == 'select') {
		$output .= '<select name="everaccess_skiplinks['.$name.']" id="ea-field-'.$name.'">';
		foreach ($value as $key => $option_label) {
			$output .= '<option value="'.$key.'" '.selected($current_value, $key, false).'>'.$option_label.'</option>';
		}
		$output .= '</select>';
	} elseif ($type == 'color') {
		$output .= '<input type="color" name="everaccess_skiplinks['.$name.']" id="ea-field-'.$name.'" class="color" value="'.$current_value.'">';
	} elseif($type == 'number') {
		$output .= '<input type="number" name="everaccess_skiplinks['.$name.']" id="ea-field-'.$name.'" class="number" value="'.$current_value.'">';
	} else {
		$output .= '<input type="text" name="'.$name.'" id="ea-field-'.$name.'" value="'.$current_value.'">';
	}

	$output    .= '</div>';

	if($echo == false)
		return $output;
	elseif ($echo == true)
		echo $output;
}