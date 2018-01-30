<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.linkedin.com/in/piotr-jacek-gumulka/
 * @since      1.0.0
 *
 * @package    Students
 * @subpackage Students/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Students
 * @subpackage Students/admin
 * @author     Piotr Jacek Gumulka <pjgumulka@gmail.com>
 */
class Students_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Students_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Students_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/students-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Students_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Students_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/students-admin.js', array( 'jquery' ), $this->version, false );

	}
	public function add_options_page() {
		//Top level settings page
		$this->plugin_screen_hook_suffix = add_menu_page(
			__( 'Students Comments', 'students' ),
			__( 'Students Comments', 'students' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page_main' ),
			'dashicons-id',
			8
		);

}
public function display_options_page_main(){
	include_once 'partials/students-admin-display.php';
};
	public function ajax_update_player_field(){
		global $wpdb;
		$sid= $_POST['student_id'];
		$field= $_POST['field'];
		$value= $_POST['value'];
		$wpdb->update("{$wpdb->prefix}students", array($field => $value), array('stuId' => $sid));
		echo 'Im gunna update student ('.$sid.') field '.$field.' to value '.$value;
		wp_die();
	}
public function ajax_approve(){
	global $wpdb;
	$sid= $_POST['student_id'];
	$wpdb->update("{$wpdb->prefix}students", array('isApproved' => 1), array('stuId' => $sid));
	echo 'Ajax Approve Player Id= '.$sid;
	wp_die();
}
public function ajax_reject(){
	global $wpdb;
	$sid= $_POST['student_id'];
	$wpdb->delete("{$wpdb->prefix}students", array('stuId' => $sid));
	echo 'Ajax Remove Player Id= '.$sid;
	wp_die();
}
}
