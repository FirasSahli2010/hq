<?php
if ( ! function_exists( 'sahel_core_dashboard_load_files' ) ) {
	function sahel_core_dashboard_load_files() {
		require_once SAHEL_CORE_ABS_PATH . '/core-dashboard/core-dashboard.php';
		require_once SAHEL_CORE_ABS_PATH . '/core-dashboard/rest/include.php';
		require_once SAHEL_CORE_ABS_PATH . '/core-dashboard/registration-rest.php';
		require_once SAHEL_CORE_ABS_PATH . '/core-dashboard/sub-pages/sub-page.php';

		foreach (glob(SAHEL_CORE_ABS_PATH . '/core-dashboard/sub-pages/*/load.php') as $subpages) {
			include_once $subpages;
		}
	}

	add_action('after_setup_theme', 'sahel_core_dashboard_load_files');
}