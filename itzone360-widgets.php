<?php
/**
 * Plugin Name: ITzone360 Widgets
 * Plugin URI: https://itzone360.net/plugin/
 * Description: A collection of lightweight and customizable Elementor widgets.
 * Version: 1.0.0
 * Author: ITzone360
 * Author URI: https://itzone360.net
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: itzone360-widgets
 * Domain Path: /languages
 * Requires at least: 6.5
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin constants.
 */
define( 'ITZONE360_WIDGETS_VERSION', '1.0.0' );
define( 'ITZONE360_WIDGETS_PATH', plugin_dir_path( __FILE__ ) );
define( 'ITZONE360_WIDGETS_URL', plugin_dir_url( __FILE__ ) );

/**
 * Check if Elementor is loaded.
 *
 * @return bool
 */
function itzone360_widgets_check_dependencies() {
	return did_action( 'elementor/loaded' );
}

/**
 * Show admin notice if Elementor is missing.
 */
add_action(
	'admin_notices',
	function () {

		if ( itzone360_widgets_check_dependencies() ) {
			return;
		}

		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		?>
		<div class="notice notice-error is-dismissible">
			<p>
				<strong><?php esc_html_e( 'ITzone360 Widgets', 'itzone360-widgets' ); ?></strong>
				<?php esc_html_e( 'requires Elementor to be installed and activated.', 'itzone360-widgets' ); ?>
				<a href="<?php echo esc_url( 'https://wordpress.org/plugins/elementor/' ); ?>" target="_blank">
					<?php esc_html_e( 'Install Elementor', 'itzone360-widgets' ); ?>
				</a>
			</p>
		</div>
		<?php
	}
);

/**
 * Initialize plugin.
 */
add_action(
	'plugins_loaded',
	function () {

		if ( ! itzone360_widgets_check_dependencies() ) {
			return;
		}

		new ITzone360_Widgets();
	}
);

/**
 * Main plugin class.
 */
final class ITzone360_Widgets {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
		add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'enqueue_styles' ) );
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_scripts' ) );
	}

	/**
	 * Register Elementor widgets.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {

		require_once ITZONE360_WIDGETS_PATH . 'widgets/info-card-widget.php';
		require_once ITZONE360_WIDGETS_PATH . 'widgets/cta-button-widget.php';
		require_once ITZONE360_WIDGETS_PATH . 'widgets/feature-box-widget.php';
		require_once ITZONE360_WIDGETS_PATH . 'widgets/counter-widget.php';
		require_once ITZONE360_WIDGETS_PATH . 'widgets/team-member-widget.php';

		$widgets_manager->register( new Itzone360_Info_Card_Widget() );
		$widgets_manager->register( new ITzone360_CTA_Button_Widget() );
		$widgets_manager->register( new Itzone360_Feature_Box_Widget() );
		$widgets_manager->register( new Itzone360_Counter_Widget() );
		$widgets_manager->register( new Itzone360_Team_Member_Widget() );
	}

	/**
	 * Register frontend scripts (registered here, enqueued per-widget via get_script_depends()).
	 */
	public function register_scripts() {

		wp_register_script(
			'itzone360-counter',
			ITZONE360_WIDGETS_URL . 'assets/js/counter.js',
			array(),
			ITZONE360_WIDGETS_VERSION,
			true
		);
	}

	/**
	 * Enqueue frontend styles.
	 */
	public function enqueue_styles() {

		wp_enqueue_style(
			'itzone360-widgets',
			ITZONE360_WIDGETS_URL . 'assets/css/widgets.css',
			array(),
			ITZONE360_WIDGETS_VERSION
		);
	}
}