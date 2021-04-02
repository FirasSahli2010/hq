<?php

if(!class_exists('SahelCoreDashboard')){

	class SahelCoreDashboard {

		private static $instance;

		private $sub_pages = array();
		private $validation_url = 'https://api.qodeinteractive.com/purchase-code-validation.php';
		public	$licence_field = 'sahel_purchase_info';
		public	$import_field = 'sahel_import_params';

		public static function get_instance() {
			if (self::$instance === null) {
				return new self();
			}

			return self::$instance;
		}

		function __construct() {

			add_action('admin_menu', array(&$this, 'register_sub_pages'));
			add_action('wp_enqueue_scripts', array(&$this, 'enqueue_styles'));
			add_action('admin_menu', array(&$this, 'dashboard_add_page'));
			add_action('admin_init', array(&$this, 'page_welcome_redirect'));
			add_action( 'sahel_elated_action_core_on_activate', array(&$this, 'set_redirect') );

		}

		public function set_sub_pages( SahelCoreSubPage $sub_page ) {
			$this->sub_pages[$sub_page->get_base()]  = $sub_page;
		}

		function get_sub_pages(){
			return $this->sub_pages;
		}


		function dashboard_add_page() {

			if (sahel_core_theme_installed()) {

				$page = add_menu_page(
					esc_html__('Sahel Dashboard', 'sahel-core'),
					esc_html__('Sahel Dashboard', 'sahel-core'),
					'administrator',
					'sahel_core_dashboard',
					array(&$this, 'sahel_core_dashboard_template'),
					SAHEL_CORE_URL_PATH . '/core-dashboard/assets/img/admin-logo-icon.png',
					3
				);

				add_action( 'load-' . $page, array(&$this, 'load_admin_css') );
			}

			foreach ($this->get_sub_pages() as $sub_page => $sub_page_value) {

				$sub_page_instance = add_submenu_page(
					'sahel_core_dashboard',
					$sub_page_value->get_title(), // The value used to populate the browser's title bar when the menu page is active
					$sub_page_value->get_title(),                                                        // The text of the menu in the administrator's sidebar
					'administrator',                                                      // What roles are able to access the menu
					$sub_page,                                            // The ID used to bind submenu items to this menu
					array( $sub_page_value, 'render' )
				);

				add_action( 'load-' . $sub_page_instance, array(&$this, 'load_admin_css') );
			}
		}

		function sahel_core_dashboard_template() {

			$params = array();
			$params['system_info'] = SahelCoreSystemInfoPage::get_instance()->get_system_info();
			$params['info'] = $this->purchased_code_info();
			$params['is_activated'] = !empty($this->get_purchased_code()) ? true : false;


			echo sahel_core_get_module_template_part('core-dashboard', 'core-dashboard', '', $params);
		}


		function load_admin_css(){
			add_action( 'admin_enqueue_scripts', array(&$this, 'enqueue_styles') );
			add_action( 'admin_enqueue_scripts', array(&$this, 'enqueue_scripts') );
		}

		function enqueue_styles(){
			wp_enqueue_style( 'sahel-core-dashboard-style', plugins_url( SAHEL_CORE_REL_PATH . '/core-dashboard/assets/css/core-dashboard.min.css' ));
		}

		function enqueue_scripts(){
			wp_enqueue_script( 'select2', ELATED_FRAMEWORK_ROOT . '/admin/assets/js/select2.min.js', array(), false, true );
			wp_enqueue_script( 'sahel-core-dashboard-script', plugins_url( SAHEL_CORE_REL_PATH . '/core-dashboard/assets/js/modules/core-dashboard.js' ), array(), false, true );
			$global_variables = apply_filters( 'sahel_core_dashboard_filter_js_global_variables', array() );

			wp_localize_script( 'sahel-core-dashboard-script', 'eltdfCoreDashboardGlobalVars', array(
				'vars' => $global_variables
			) );
		}

		public function register_sub_pages() {

			$sub_pages = apply_filters( 'sahel_core_filter_add_sub_page', $icons = array() );

			if ( ! empty( $sub_pages ) ) {
				foreach ( $sub_pages as $sub_page ) {
					$this->set_sub_pages( new $sub_page() );
				}
			}
		}

		function set_redirect() {
			if ( ! is_network_admin() ) {
				set_transient( '_sahel_core_welcome_page_redirect', 1, 30 );
			}
		}

		function page_welcome_redirect() {
			$redirect = get_transient( '_sahel_core_welcome_page_redirect' );
			delete_transient( '_sahel_core_welcome_page_redirect' );
			if ( $redirect ) {
				wp_safe_redirect( add_query_arg( array( 'page' => 'eltdf_fn_themename_theme_dashboard' ), esc_url( admin_url( 'admin.php' ) ) ) );
			}
		}


		function purchase_code_registration(){

			if ( empty( $_POST ) || ! isset( $_POST ) ) {
				return esc_html__( 'All fields are empty', 'sahel-core' );
			} else {
				switch ($_POST['options']['action']):
					case 'register':
						$this->register_purchase_code($_POST['options']['post']);
						break;
					case 'deregister':
						$this->deregister_purchase_code();
						break;
				endswitch;
			}

			wp_die();


		}

		function register_purchase_code() {
			$data        = array();
			$data_string = $_POST['options']['post'];
			parse_str( $data_string, $data );

			if ( empty( $data['purchase_code'] ) || empty( $data['email'] ) ) {
				sahel_core_ajax_status( 'error', esc_html__( 'Purchase Code and Email are empty', 'sahel-core' ), array(
					'purchase_code' => false,
					'email'         => false
				) );
			} elseif ( empty( $data['purchase_code'] ) ) {
				sahel_core_ajax_status( 'error', esc_html__( 'Purchase Code is empty', 'sahel-core' ), array( 'purchase_code' => false ) );
			} elseif ( empty( $data['email'] ) ) {
				sahel_core_ajax_status( 'error', esc_html__( 'Email is empty', 'sahel-core' ), array( 'email' => false ) );
			}

			$url = add_query_arg( array(
				'purchase_code' => $data['purchase_code'],
				'email'         => $data['email'],
				'profile'       => ELATED_PROFILE_SLUG . '-themes',
				'demo_url'      => esc_url( get_site_url() ),
				'action'        => 'register'
			), $this->validation_url );

			$json = $this->api_connection( $url );

			if ( isset( $json['success'] ) && $json['success'] ) {

				update_option( $this->licence_field, $json['data']['validation'] );
				update_option( $this->import_field, $json['data']['import'] );
				sahel_core_ajax_status( 'success', $this->response_codes( $json['response_code'] ) );

			} elseif ( isset( $json['message'] ) && ! $json['success'] && ( isset( $json['data']['error'] ) && $json['data']['error'] == 404 ) ) {

				sahel_core_ajax_status( 'error', $this->response_codes( $json['response_code'] ), array( 'purchase_code' => false ) );

			} elseif ( isset( $json['message'] ) && ! $json['success'] && ( isset( $json['data']['error'] ) && $json['data']['error'] == 'used' ) ) {

				sahel_core_ajax_status( 'error', $this->response_codes( $json['response_code'] ), array( 'already_used' => true ) );

			} elseif ( isset( $json['message'] ) && ! $json['success'] ) {

				sahel_core_ajax_status( 'error', $this->response_codes( $json['response_code'] ) );
			}
		}

		function deregister_purchase_code(){

			$code = $this->get_purchased_code();

			$url  = add_query_arg( array(
				'purchase_code' => $code,
				'action'        => 'deregister',
				'profile'       => ELATED_PROFILE_SLUG . '-themes',
			), $this->validation_url );
			$json = $this->api_connection( $url );

			if ( $json['success'] ) {
				delete_option( $this->licence_field );
				delete_option( $this->import_field );
				sahel_core_ajax_status( 'success', $this->response_codes( $json['response_code'] ) );
			} else {
				sahel_core_ajax_status( 'error', $this->response_codes( $json['response_code'] ) );
			}


		}

		function check_purchase_code($demo){

			$code = $this->get_purchased_code();

			$url = add_query_arg( array(
				'purchase_code' => $code,
				'action'        => 'check',
				'profile'       => ELATED_PROFILE_SLUG . '-themes',
				'demo'          => $demo
			), $this->validation_url );

			$json = $this->api_connection($url);

			if($json['success']){
				return true;
			} else {
				return false;
			}
		}

		function get_purchased_code_data() {

			return get_option($this->licence_field);
		}

		function purchased_code_info() {
			$info = $this->get_purchased_code_data();
			if($info && !empty($info)){
				return $info;
			} else {
				return false;
			}
		}

		function get_purchased_code() {
			$info = $this->purchased_code_info();
			if(is_array($info) && isset($info['purchase_code'])){
				return $info['purchase_code'];
			}

			return '';
		}
		function get_import_params() {
			$params = get_option($this->import_field);
			if(is_array($params) && count($params) > 0){
				return $params;
			}
			return false;
		}

		function api_connection($url){

			$response = wp_remote_get(
				$url,
				array(
					'user-agent' => 'WordPress/' . get_bloginfo( 'version' ) . '; ' . esc_url(home_url( '/' )),
					'timeout' => 30
				)
			);

			if ( is_wp_error( $response ) ) {
				return $response;
			}

			if ( '200' != wp_remote_retrieve_response_code( $response ) ) {
				return new WP_Error( 'bad_request', esc_html__('Bad request', 'sahel-core' ));
			}

			$json = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( empty( $json ) || ! is_array( $json ) ) {
				return new WP_Error( 'invalid_response',  esc_html__('Invalid Response', 'sahel-core' ) );
			}

			return $json;
		}

		function response_codes( $code ) {

			$message = '';

			switch ( $code ):

				case 200:
					$message = esc_html__( 'Failed to validate code due to an error', 'sahel-core' );
					break;
				case 400:
					$message = esc_html__( 'Parameter or argument in the request was invalid', 'sahel-core' );
					break;
				case 401:
					$message = esc_html__( 'The authorization header is missing. Verify that your code is correct.', 'sahel-core' );
					break;
				case 403:
					$message = esc_html__( 'Personal token is incorrect or does not have the required permission(s)', 'sahel-core' );
					break;
				case 404:
					$message = esc_html__( 'The purchase code is invalid', 'sahel-core' );
					break;
				case 601:
					$message = esc_html__( 'You successfully activated theme', 'sahel-core' );
					break;
				case 602:
					$message = esc_html__( 'Code is valid', 'sahel-core' );
					break;
				case 603:
					$message = esc_html__( 'You successfully added demo', 'sahel-core' );
					break;
				case 604:
					$message = esc_html__( 'You successfully deregister theme', 'sahel-core' );
					break;
				case 650:
					$message = esc_html__( 'Code is already registered for other domain', 'sahel-core' );
					break;
				case 651:
					$message = esc_html__( 'Error occurred during activation', 'sahel-core' );
					break;
				case 652:
					$message = esc_html__( 'Code is invalid', 'sahel-core' );
					break;
				case 653:
					$message = esc_html__( 'Error occurred during adding', 'sahel-core' );
					break;
				case 654:
					$message = esc_html__( 'Error occurred during deactivation', 'sahel-core' );
					break;
			endswitch;


			return $message;
		}

	}

	SahelCoreDashboard::get_instance();
}