<?php
/**
 * Plugin Name: WooCommerce Auto Update Cart on Quantity Change
 * Description: Automatically adds/removes products to/from the cart when the quantity changes without clicking the Add to Cart button.
 * Author:      Mugniul Afif
 * Plugin URI:  https://mugniulafif.com/services/
 * Author URI:  https://mugniulafif.com/
 * Version:     1.0.0
 * License:     GPL-2.0+
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

final class WC_Auto_Update_Cart{
    const version = '1.0';
    
    /**
     * Class Constructor
     */
    private function __construct(){

        $this -> define_constants();
        register_activation_hook( __FILE__, [$this,'activate'] );
        add_action( 'plugins_loaded', [$this,'init_plugin']);
    }


    /**
     * Define the required constants
     *
     * @return void
     */

     public function define_constants(){
        define('WCAU_VERSION', self::version);
        define('WCAU_FILE', __FILE__);
        define('WCAU_PATH', __DIR__);
        define('WCAU_URL', plugins_url ('', __FILE__));
        define('WCAU_ASSETS', WCAU_URL.'/assets');

    }
    /**
     * Intializes a singleton instance
     *
     * @return \WC_Auto_Update_Cart
     */

     public static function init(){
        static $instance = false;

        if (!$instance) {
            $instance= new self();
        }

        return $instance;
    }
    /**
     * Version Controll Upon Activation
     *
     * @return void
     */
    public function activate(){
        $installer = new WC\AU\Installer();
        $installer -> add_version();
    }

    function init_plugin(){
        new WC\AU\Frontend();
    }

}


/**
 * Intializes The Plugin
 *
 * @return \WC_Auto_Update_Cart
 */
function wc_auto_update_cart(){
    return WC_Auto_Update_Cart::init();
}

//kick-off plugin
wc_auto_update_cart();
