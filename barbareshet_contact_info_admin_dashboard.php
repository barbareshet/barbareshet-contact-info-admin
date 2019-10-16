<?php

/*
Plugin Name: barbareshet contact info widget
Plugin URI: https://github.com/barbareshet/barbareshet-contact-info-admin/archive/1.0.zip
Description: Adds the developer's contact info to admin dashboard in order to simplify the process of contacting me
Version: 1.0
Author: Ido Barnea
Author Email: barbareshet@gmail.com
Author URI: https://www.barbareshet.co.il
Text Domain: iws_dciadw
Domain Path: /languages
License:

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA




*/
if (!defined('ABSPATH')) {
    exit;
}
class barbareshet_contact_info_admin_dashboard{
        function __construct(){

            add_action( 'wp_dashboard_setup',
                array( &$this, 'wp_dashboard_setup' ) );

            add_action('admin_init',
                array( &$this, 'settings_api_init') );
        }

        //dashboard function
    function wp_dashboard_setup(){
        wp_add_dashboard_widget( 'dev_dashboard_widget',
            __('Developer Contact Info', 'iws_dciadw'),
            array( &$this, 'dashboard_widget_output' ) );
    }

    function dashboard_widget_output(){

        printf( esc_html__( 'The Site %1$s, was developed by %2$s Contact me by mail: %3$s or via my website: %4$s', 'iws_dciadw' ),
	        get_bloginfo('name'),
	        '<strong>Ido Barnea - Barbareshet</strong><br>',
	        'barbareshet@gmail.com<br>',
	        '<a href="https://www.barbareshet.co.il/contact/" rel="nofollow" target="_blank">Ido Barnea</a>'
        );
    }

    /**
     * Settings functions
     */
    function settings_api_init() {

        add_settings_section('dev_setting_section',
            'Dev Settings Section ',
            array( &$this, 'dev_settings_section_callback' ),
            'general');

        add_settings_field('dev_setting_name',
            'Dev Setting Name',
            array( &$this, 'dev_settings_callback' ),
            'general',
            'dev_setting_section');

        register_setting('general','dev_setting_name');
    }

    function dev_settings_section_callback() {
        echo '<p>This is the introduction to the settings section.</p>';
    }

    function dev_settings_callback() {
        echo '<input name="dev_setting_name" id="dev_setting_name" type="checkbox" value="1" class="code" ' . checked( 1, get_option('dev_setting_name'), false ) . ' /> Dev setting details';
    }
}//end of class
new barbareshet_contact_info_admin_dashboard();