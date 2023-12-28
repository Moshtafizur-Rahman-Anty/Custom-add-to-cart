<?php
/**
 * Custom_Add_to_Cart_Text_Plugin class
 * 
 * This class defines the main functionality of the WooCommerce plugin
 * for customizing the Add to Cart button text.
 */
class Custom_Add_to_Cart_Text_Plugin {

    /**
     * Constructor method to initialize actions and filters.
     */
    public function __construct(
        // Add WordPress admin menu item for the plugin settings
        add_action('admin_menu', array($this, 'add_menu'));

        // Register settings and fields
        add_action('admin_init', array($this, 'register_settings'));

        // Hook to change the Add to Cart button text on single product page
        add_filter('woocommerce_product_single_add_to_cart_text', array($this, 'change_single_add_to_cart_text'));

        // Hook to change the Add to Cart button text on shop page
        add_filter('woocommerce_product_add_to_cart_text', array($this, 'change_shop_add_to_cart_text'));
    }

    /**
     * Adds the plugin settings page to the WordPress admin menu.
     */
    public function add_menu() {
        add_options_page(
            'Custom Add to Cart Text',
            'Custom Add to Cart Text',
            'manage_options',
            'custom_add_to_cart_text',
            array($this, 'render_settings_page')
        );
    }

    /**
     * Registers the plugin settings and fields.
     */
    public function register_settings() {
        register_setting(
            'custom_add_to_cart_text_settings',
            'custom_add_to_cart_text',
            'sanitize_text_field'
        );

        add_settings_section(
            'custom_add_to_cart_text_section',
            'Custom Add to Cart Text',
            array($this, 'render_settings_section'),
            'custom_add_to_cart_text_settings'
        );

        add_settings_field(
            'custom_add_to_cart_text_field',
            'Enter Custom Text',
            array($this, 'render_settings_field'),
            'custom_add_to_cart_text_settings',
            'custom_add_to_cart_text_section'
        );
    }

    /**
     * Renders the settings page in the WordPress admin.
     */
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h2>Custom Add to Cart Text</h2>
            <form method="post" action="options.php">
                <?php
                settings_fields('custom_add_to_cart_text_settings');
                do_settings_sections('custom_add_to_cart_text_settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Renders the settings section on the settings page.
     */
    public function render_settings_section() {
        echo '<p>Enter the custom text for the Add to Cart button.</p>';
    }

    /**
     * Renders the settings field on the settings page.
     */
    public function render_settings_field() {
        $value = get_option('custom_add_to_cart_text');
        echo '<input type="text" name="custom_add_to_cart_text" value="' . esc_attr($value) . '" />';
    }

    /**
     * Changes the Add to Cart button text on the single product page.
     *
     * @param string $text Default button text.
     * @return string Modified button text.
     */
    public function change_single_add_to_cart_text($text) {
        $custom_text = get_option('custom_add_to_cart_text');
        return !empty($custom_text) ? $custom_text : $text;
    }

    /**
     * Changes the Add to Cart button text on the shop page.
     *
     * @param string $text Default button text.
     * @return string Modified button text.
     */
    public function change_shop_add_to_cart_text($text) {
        $custom_text = get_option('custom_add_to_cart_text');
        return !empty($custom_text) ? $custom_text : $text;
    }
}
