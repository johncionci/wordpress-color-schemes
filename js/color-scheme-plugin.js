/*
 * @file Color Scheme Plugin JS
 * Since we can't access the Customizer code directly, we iterate over each Color Scheme input
 * then add the value of the name attribute as a class to the parent "label"
 * so we can add background images of the color schemes via CSS.
 * --------------------------------------------------------------------------------- */
jQuery(document).ready(function() {
	jQuery('#customize-control-color_scheme_control input').each( function() {
		var attrValue = jQuery(this).attr('value');
		jQuery(this).parent().addClass(attrValue);
	});
});