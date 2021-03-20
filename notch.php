<?php
/**
 * Plugin Name: Notch Addons
 * Plugin URI: https://example.com
 * Description: Top notch elementor pro addons for free
 * Version: 1.0.0
 * Author: rakibwordpress
 * Author URI: https://johndoe.me
 * Text Domain: notch-addons
 */

 if( ! defined( 'ABSPATH' ) ) exit();

 /**
 * Elementor Extension main CLass
 * @since 1.0.0
 */
final class Notch_Addons {

    // Plugin version
    const VERSION = '1.0.0';

    // Minimum Elementor Version
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    // Minimum PHP Version
    const MINIMUM_PHP_VERSION = '7.0';

    // Instance
    private static $_instance = null;

    /**
    * SIngletone Instance Method
    * @since 1.0.0
    */
    public static function instance() {
        if( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
    * Construct Method
    * @since 1.0.0
    */
    public function __construct() {
        // Call Constants Method
        $this->define_constants();
        add_action( 'wp_enqueue_scripts', [ $this, 'scripts_styles' ] );
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    /**
    * Define Plugin Constants
    * @since 1.0.0
    */
    public function define_constants() {
        define( 'NOTCH_ADDONS_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
        define( 'NOTCH_ADDONS_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
    }

    /**
    * Load Scripts & Styles
    * @since 1.0.0
    */
    public function scripts_styles() {
        // wp_register_style( 'myew-owl-carousel', NOTCH_ADDONS_URL . 'assets/vendor/owl-carousel/css/owl.carousel.min.css', [], rand(), 'all' );
        // wp_register_style( 'myew-owl-carousel-theme', NOTCH_ADDONS_URL . 'assets/vendor/owl-carousel/css/owl.theme.default.min.css', [], rand(), 'all' );
        // wp_register_script( 'myew-owl-carousel', NOTCH_ADDONS_URL . 'assets/vendor/owl-carousel/js/owl.carousel.min.js', [ 'jquery' ], rand(), true );

        wp_register_style( 'notch-style', NOTCH_ADDONS_URL . 'assets/css/notch-main.css', [], rand(), 'all' );
        // wp_register_script( 'myew-script', NOTCH_ADDONS_URL . 'assets/dist/js/public.min.js', [ 'jquery' ], rand(), true );

        // wp_enqueue_style( 'myew-owl-carousel' );
        // wp_enqueue_style( 'myew-owl-carousel-theme' );
        // wp_enqueue_script( 'myew-owl-carousel' );
        wp_enqueue_style( 'notch-style' );
        // wp_enqueue_script( 'myew-script' );
    }

    /**
    * Load Text Domain
    * @since 1.0.0
    */
    public function i18n() {
       load_plugin_textdomain( 'notch-addons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }

    /**
    * Initialize the plugin
    * @since 1.0.0
    */
    public function init() {
        // Check if the ELementor installed and activated
        if( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }

        if( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        if( ! version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        add_action( 'elementor/init', [ $this, 'init_category' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
    }

    /**
    * Init Widgets
    * @since 1.0.0
    */
    public function init_widgets() {
        // require_once NOTCH_ADDONS_PATH . '/widgets/preview-card.php';
        // require_once NOTCH_ADDONS_PATH . '/widgets/pricing-table.php';
        // require_once NOTCH_ADDONS_PATH . '/widgets/logo-carousel.php';
        require_once NOTCH_ADDONS_PATH . '/widgets/notch-hotspot.php';
        require_once NOTCH_ADDONS_PATH . '/widgets/notch-timeline.php';
    }

    /**
    * Init Category Section
    * @since 1.0.0
    */
    public function init_category() {
        Elementor\Plugin::instance()->elements_manager->add_category(
            'notch-category',
            [
                'title' => 'Notch Addons'
            ],
        );
    }

    /**
    * Admin Notice
    * Warning when the site doesn't have Elementor installed or activated
    * @since 1.0.0
    */
    public function admin_notice_missing_main_plugin() {
        if( isset( $_GET[ 'activate' ] ) ) unset( $_GET[ 'activate' ] );
        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated', 'notch-addons' ),
            '<strong>'.esc_html__( 'Notch Addons', 'notch-addons' ).'</strong>',
            '<strong>'.esc_html__( 'Elementor', 'notch-addons' ).'</strong>'
        );

        printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Admin Notice
    * Warning when the site doesn't have a minimum required Elementor version.
    * @since 1.0.0
    */
    public function admin_notice_minimum_elementor_version() {
        if( isset( $_GET[ 'activate' ] ) ) unset( $_GET[ 'activate' ] );
        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater', 'notch-addons' ),
            '<strong>'.esc_html__( 'Notch Addons', 'notch-addons' ).'</strong>',
            '<strong>'.esc_html__( 'Elementor', 'notch-addons' ).'</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Admin Notice
    * Warning when the site doesn't have a minimum required PHP version.
    * @since 1.0.0
    */
    public function admin_notice_minimum_php_version() {
        if( isset( $_GET[ 'activate' ] ) ) unset( $_GET[ 'activate' ] );
        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater', 'notch-addons' ),
            '<strong>'.esc_html__( 'Notch Addons', 'notch-addons' ).'</strong>',
            '<strong>'.esc_html__( 'PHP', 'notch-addons' ).'</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message );
    }

}

Notch_Addons::instance();