<?php

// =============================================================================
// Settings
// =============================================================================

// Paths

$theme_path 	= get_template_directory();
$framework_path = $theme_path . '/framework';

// =============================================================================
// Framework Functions
// =============================================================================

require_once( $framework_path . '/functions/helpers.php' );
require_once( $framework_path . '/inc/kirki/kirki.php' );

add_filter( 'kirki/config', 'getbowtied_kirki_update_url' );
function getbowtied_kirki_update_url( $config ) {

    $config['url_path'] = get_template_directory_uri() . '/framework/inc/kirki/';
    return $config;
}

// =============================================================================
// Theme Functions
// =============================================================================

// Body Classes
require_once( $theme_path . '/functions/body-classes.php' );

// Icons
require_once( $theme_path . '/inc/icons/class-icons.php' );

// Theme Setup
require_once( $theme_path . '/functions/helpers.php' );
require_once( $theme_path . '/functions/theme-setup.php' );

// Enqueue Styles & Scripts
require_once( $theme_path . '/functions/enqueue-default-fonts.php' );
require_once( $theme_path . '/functions/enqueue-google-fonts.php' );
require_once( $theme_path . '/functions/enqueue-styles.php' );
require_once( $theme_path . '/functions/enqueue-scripts.php' );

// Customiser
require_once( $theme_path . '/inc/customiser/customiser-backend.php' );
require_once( $theme_path . '/inc/customiser/customiser.php' );
require_once( $theme_path . '/inc/customiser/gutenberg.php' );

// WP
require_once( $theme_path . '/functions/wp/actions.php' );
require_once( $theme_path . '/functions/wp/filters.php' );
require_once( $theme_path . '/functions/wp/post-meta.php' );
require_once( $theme_path . '/functions/wp/post-footer.php' );
require_once( $theme_path . '/functions/wp/post-navigation-single.php' );
require_once( $theme_path . '/functions/wp/post-navigation-archive.php' );
require_once( $theme_path . '/functions/wp/comments.php' );
require_once( $theme_path . '/functions/wp/archive-title.php' );

// WC
require_once( $theme_path . '/functions/wc/actions.php' );
require_once( $theme_path . '/functions/wc/filters.php' );
require_once( $theme_path . '/functions/wc/add-to-cart-fragments.php' );
require_once( $theme_path . '/functions/wc/remove-tabs-titles.php' );
require_once( $theme_path . '/functions/wc/quick-view.php' );
require_once( $theme_path . '/functions/wc/custom-sale-label.php' );
require_once( $theme_path . '/functions/wc/search.php' );

// VC
require_once( $theme_path . '/functions/vc/init.php' );
require_once( $theme_path . '/functions/vc/filters.php' );

// Widgets Areas
require_once( $theme_path . '/inc/widgets/widgets-areas.php' );

// Meta Boxes
require_once( $theme_path . '/inc/metaboxes/page.php' );
require_once( $theme_path . '/inc/metaboxes/post.php' );


// =============================================================================
// Theme Welcome Page
// =============================================================================

require_once( $theme_path . '/inc/tgm/class-tgm-plugin-activation.php' );
require_once( $theme_path . '/inc/tgm/plugins.php' );
require_once( $theme_path . '/inc/admin/wizard/class-gbt-helpers.php' );
require_once( $theme_path . '/inc/admin/wizard/class-gbt-install-wizard.php' );
require_once( $theme_path . '/inc/demo/ocdi-setup.php');

if (!function_exists('getbowtied_migrate_tools')) {
add_action('admin_init', 'getbowtied_migrate_tools');
function getbowtied_migrate_tools() {
	if (isset($_GET['getbowtied_migrate_tools'])) {
		if (class_exists('GetBowtied_Tools')) {
			deactivate_plugins( 'getbowtied-tools/getbowtied-tools.php' );

			if (!class_exists('Envato_Market') || !class_exists('OCDI_Plugin') || !class_exists('WooCommerce') || !defined('WPB_VC_VERSION')) {
				wp_redirect(admin_url('themes.php?page=tgmpa-install-plugins'));
			} else {
				wp_redirect(admin_url('admin.php?page=envato-market'));
			}
		}
	}
}
}

/**
 * On theme activation redirect to splash page
 */
global $pagenow;

if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

	wp_redirect(admin_url("themes.php?page=gbt-setup")); // Your admin page URL

}

/**
 * HookMeUp admin notification
 */
add_action( 'admin_notices', 'mc_hookmeup_notification' );
if( !function_exists('mc_hookmeup_notification') ) {
	function mc_hookmeup_notification() {
		?>

		<?php if ( !get_option('dismissed-hookmeup-notice', FALSE ) && !class_exists('HookMeUp') ) : ?>
			<div class="notice-warning settings-error notice is-dismissible hookmeup_notice">
				<p>
					<strong>
						<span>This theme recommends the following plugin: <em><a href="https://wordpress.org/plugins/hookmeup/" target="_blank">HookMeUp – Additional Content for WooCommerce</a></em>.</span>
					</strong>
				</p>
			</div>
		<?php endif;
	}
}

if ( ! function_exists( 'gbt_dismiss_dashboard_notice' ) ) {
	function gbt_dismiss_dashboard_notice() {
		if( $_POST['notice'] == 'hookmeup' ) {
			update_option('dismissed-hookmeup-notice', TRUE );
		}
	}
	add_action( 'wp_ajax_gbt_dismiss_dashboard_notice', 'gbt_dismiss_dashboard_notice' );
}
