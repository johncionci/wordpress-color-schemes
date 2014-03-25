<?php
/**
 * Plugin Name: WordPress Color Scheme
 * Plugin URI: https://github.com/johncionci/
 * Description: Provides an easy way for users to update an entire sites color scheme.
 * Version: 0.1
 * Author: John Cionci
 * Author URI: https://github.com/johncionci/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright 2012-2014 John Cionci
 *
 * GNU General Public License, Free Software Foundation <http://creativecommons.org/licenses/GPL/2.0/>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 */

class Color_Scheme_Customize {

 /**
	* This hooks into 'customize_register' (available as of WP 3.4) and allows
	* you to add new sections and controls to the Theme Customize screen.
	*
	* @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	* @link http://codex.wordpress.org/Theme_Customization_API
	*/


	/**
	 * Register the Theme Customizer settings and controls
	 * @uses add_section, add_setting, add_control
	 * @param  [type] $wp_customize [description]
	 * @author John Cionci
	 * @return void
	 */
	public static function color_scheme_register ( $wp_customize ) {

			$wp_customize->add_section( 'color_scheme_section', array(
					'title' => __( 'Color Scheme' ),
					'priority' => 24,
					'capability' => 'edit_theme_options',
					'description' => __( 'Provides an easy way for users to update an entire sites color scheme.' ),
			));

			$wp_customize->add_setting( 'color_scheme_setting', array(
				'default'        => '',
				'capability'     => 'edit_theme_options',
				'type'           => 'option',
			));

			$wp_customize->add_control( 'color_scheme_control', array(
					'label'      => __( 'Color Scheme Options' ),
					'section'    => 'color_scheme_section',
					'settings'   => 'color_scheme_setting',
					'type'       => 'radio',
					'choices'    => array(
						'dark'  => 'Dark',
						'light' => 'Light',
						'blue'  => 'Blue',
					),
			));

	} // function color_scheme_register

	/**
	 * Output the chosen Color Scheme CSS setting.
	 * @uses wp_enqueue_style
	 * @author John Cionci
	 * @return void
	 */
	public static function color_scheme_css_output() {
		wp_enqueue_style( 'color-scheme-theme-css', plugins_url( '/color-schemes/'.get_option( 'color_scheme_setting' ).'.css', __FILE__ ) , NULL , 1.0 , 'screen' );
	} // function color_scheme_css_output

	/**
	 * Outputs alterations to the Theme Customizer layout
	 * @uses wp_enqueue_style, wp_enqueue_script
	 * @author John Cionci
	 * @return void
	 */
	public static function color_scheme_plugin_output() {
		wp_enqueue_style( 'color-scheme-plugin', plugins_url( '/css/color-scheme-plugin.css', __FILE__ ) , NULL , 1.0 , 'screen' );
		wp_enqueue_script( 'color-scheme-plugin', plugins_url( '/js/color-scheme-plugin.js', __FILE__ ) , array( 'jquery' ), 1.0, true );
	} // function color_scheme_plugin_output

} // end class Color_Scheme_Customize

// Output custom CSS
add_action( 'wp_head' , array( 'Color_Scheme_Customize' , 'color_scheme_css_output' ) );

// Output custom Customizer CSS
add_action( 'customize_controls_enqueue_scripts' , array( 'Color_Scheme_Customize' , 'color_scheme_plugin_output' ) );

// Setup the Theme Customizer settings and controls
add_action( 'customize_register' , array( 'Color_Scheme_Customize' , 'color_scheme_register' ) );