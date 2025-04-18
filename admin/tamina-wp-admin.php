<?php

if ( !class_exists( 'Tamina_WP_Admin' ) ) {

    class Tamina_WP_Admin
    {
        /**
         * Static property to hold our singleton instance
         *
         */
        static $instance = false;

        function __construct() {
            add_action( 'admin_init', [ $this, 'admin_init' ] );
            add_action( 'admin_menu', [ $this, 'admin_menu' ] );
        }

        /**
         * If an instance exists, this returns it.  If not, it creates one and
         * retuns it.
         *
         * @return Tamina_WP_Admin
         */

        public static function getInstance() {
            if ( !self::$instance )
                self::$instance = new self;
            return self::$instance;
        }

        function admin_menu() {
            add_options_page(
                'Tamina Settings',
                'Tamina',
                'manage_options',
                'tamina-wp',
                [ $this, 'render_settings_page' ]
            );
        }

        function render_settings_page() {
            ?>
            <div id="tamina_settings_id"></div>
            <?php
        }

        function admin_init() {

            // register_setting(
            //     'tamina_wp_settings',
            //     'tamina_wp_settings');

            // add_settings_section(
            //     'section_general',
            //     'Section General',
            //     'tamina_section_one_text',
            //     'tamina-wp'
            // );

            // add_settings_field(
            //     'tamina_url',
            //     'URL',
            //     'nelio_render_url',
            //     'tamina-wp',
            //     'section_general'
            // );

            // add_settings_field(
            //     'tamina_mode',
            //     'Mode',
            //     'nelio_render_mode',
            //     'tamina-wp',
            //     'section_general'
            // );

            // add_settings_field(
            //     'tamina_width',
            //     'Width',
            //     'nelio_render_width',
            //     'tamina-wp',
            //     'section_general'
            // );

            // add_settings_field(
            //     'tamina_height',
            //     'Height',
            //     'nelio_render_height',
            //     'tamina-wp',
            //     'section_general'
            // );

            // register_setting( 
            //     'general', 
            //     'tamina_url', 
            //     array(
            //         'type' => 'string', 
            //         'description' => __( 'Your one and only URL. This is mandatory.', 'tamina-wp' ), 
            //         'show_in_rest' => true ) 
            // );

            // register_setting( 
            //     'general',
            //     'tamina_mode',
            //     array(
            //         'type' => 'string', 
            //         'description' => __( "This plugin can be displayed in different modes. Valid modes are 'popup' , 'iframe'.", 'tamina-wp' ), 
            //         'show_in_rest' => true ) 
            // );

            // register_setting( 
            //     'general',
            //     'tamina_width',
            //     array(
            //         'type' => 'string', 
            //         'description' => __( "The width of the frame in iframe mode.", 'tamina-wp' ), 
            //         'show_in_rest' => true ) 
            // );

            // register_setting( 
            //     'general',
            //     'tamina_height',
            //     array(
            //         'type' => 'string', 
            //         'description' => __( "The height of the frame in iframe mode.", 'tamina-wp' ), 
            //         'show_in_rest' => true ) 
            // );
        }
    }
}

// Instantiate our class
$Tamina_WP_Admin = Tamina_WP_Admin::getInstance();

?>