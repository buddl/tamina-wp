<?php
/*
Plugin Name: Tamina
Plugin URI:  https://tamina.cc/
Description: Embed Tamina into your wordpress website
Version:     1.0
Author:      Tamina
License:     GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: tamina-wp
Domain Path: /languages
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/includes/tamina-widget.php';

if ( is_admin() ) {
    // we are in admin mode
    require_once __DIR__ . '/admin/tamina-wp-admin.php';
}

if ( !class_exists( 'Tamina_WP' ) ) {

    class Tamina_WP
    {
        /**
         * Static property to hold our singleton instance
         *
         */
        static $instance = false;

        function __construct() {
            add_action( 'init', [ $this, 'init' ] );
        }

        /**
         * If an instance exists, this returns it.  If not, it creates one and
         * retuns it.
         *
         * @return Tamina_WP
         */

        public static function getInstance() {
            if ( !self::$instance )
                self::$instance = new self;
            return self::$instance;
        }

        function init() {
            wp_enqueue_script( 'tamina-script-remote', 'https://tamina.cc/api/js', array( 'jquery' ), '', true );
            add_filter('script_loader_tag', [ $this, 'script_filter' ] , 10, 2);
        }

        function script_filter($tag, $handle) {
            # add script handles to the array below
            $scripts_to_defer = array('tamina-script-remote');
        
            foreach($scripts_to_defer as $defer_script) {
                if ($defer_script === $handle) {

                    $rep = " async defer onload='initTamina()' src";
                    return str_replace(" src", $rep, $tag);
                }
            }
            return $tag;
        }
    }
}

// Instantiate our class
$Tamina_WP = Tamina_WP::getInstance();
?>