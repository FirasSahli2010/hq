<?php do_action( 'sahel_elated_get_footer_template' );

global $sahel_eltdf_toolbar;

if ( isset ( $sahel_eltdf_toolbar ) ) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    if (file_exists ( get_home_path() . 'toolbar/toolbar.php' ) ) {
        include(get_home_path() . 'toolbar/toolbar.php');
    }
}