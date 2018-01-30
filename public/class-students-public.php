<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.linkedin.com/in/piotr-jacek-gumulka/
 * @since      1.0.0
 *
 * @package    Students
 * @subpackage Students/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Students
 * @subpackage Students/public
 * @author     Piotr Jacek Gumulka <pjgumulka@gmail.com>
 */
class Students_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/students-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/students-public.js', array( 'jquery' ), $this->version, false );

	}
	public function renderStudentNotSubmittedNotice($msg=NULL){
		$html='<div class="students-notice"><div>';
		$html.='<h3 class="students-nok">Your submission had errors!</h3>';
		$html.='<p>Please try again, and remember to fill required fields!</p>';
		$html.='<p>'.$msg.'</p>';
		$html.='</div></div>';
		return $html;
	}
	public function renderStudentSubmittedNotice(){
		$html='<div class="students-notice"><div>';
		$html.='<h3 class="students-ok">Your submission is saved and waiting for approval!</h3>';
		$html.='<p>After approval your data will be visible in students list!</p>';
		$html.='</div></div>';
		return $html;
	}

  public function renderRegisterForm(){
    $prev_state   =isset($_GET['prev-state'])  ? $_GET['prev-state']    : "0";
    $prev_name    =isset($_GET['prev-name'])   ? $_GET['prev-name']    : "";
    $prev_about   =isset($_GET['prev-about'])  ? $_GET['prev-about']     : "";
    $prev_kgs     =isset($_GET['prev-kgs'])   ? $_GET['prev-kgs']    : "";
    $prev_rank    =isset($_GET['prev-rank'])   ? $_GET['prev-rank']    : "";
    $prev_country =isset($_GET['prev-country'])? $_GET['prev-country'] : "";
    $prev_birth     =isset($_GET['prev-birth'])? $_GET['prev-birth'] : "";
    $prev_duration=isset($_GET['prev-duration'])? $_GET['prev-duration'] : "";
		if($_GET['suc'] == 1) $html.= $this->renderStudentSubmittedNotice();
		if($_GET['suc'] == 0) $html.= $this->renderStudentNotSubmittedNotice();
    $html.= '<h3 class="students-register">Registration Form</h3>';
    $html.= '<p>Please fill out form below. All fields marked with <span class="students-required">*</span> are required for your form to be submitted.</p>';
    $html.='<form class="students-register-form" action="'.get_admin_url().'admin-post.php" method="post">
      <input type="hidden" name="action" value="students_register" />
      <fieldset>
        <div class="students-form-label"><label for="students-player-state">Are you current students or former?<span class="students-required">*</span></label></div>
        <div class="students-form-input"><select name="students-player-state">
				<option value="1" '.($prev_state == 1 ? 'selected' : '').'>Current</option>
				<option value="0" '.($prev_state == 0 ? 'selected' : '').'>Former</option></select></div>

        <div class="students-form-label"><label for="students-player-name">Player Name<span class="students-required">*</span></label></div>
        <div class="students-form-input"><input name="students-player-name" type="text" value="'.$prev_name.'" placeholder="Your name will be visible in Students list"></div>

        <div class="students-form-label"><label for="students-player-photo">Photo to use<span class="students-required">*</span></label></div>
        <div class="students-form-input"><input name="students-player-photo" type="file" value=""></div>

        <div class="students-form-label"><label for="students-player-kgs-account">KGS Account</label></div>
        <div class="students-form-input"><input name="students-player-kgs-account" type="text" value="'.$prev_kgs.'" placeholder="Your KGS account"></div>

        <div class="students-form-label"><label for="students-player-about">About Yourself</label></div>
        <div class="students-form-input"><textarea name="students-player-about">'.$prev_about.'</textarea></div>

        <div class="students-form-label"><label for="students-player-rank">Your Rank</label></div>
        <div class="students-form-input"><input name="students-player-rank" type="text" value="'.$prev_rank.'" placeholder="eg. 11k, 2d, 5p..."></div>

        <div class="students-form-label"><label for="students-player-country">Country <span class="students-required">*</span></label></div>
        <div class="students-form-input"><input name="students-player-country" type="text" value="'.$prev_country.'" placeholder="What country are you from"></div>

        <div class="students-form-label"><label for="students-player-birth">Country <span class="students-required">*</span></label></div>
        <div class="students-form-input"><input name="students-player-birth" type="text" value="'.$prev_birth.'" placeholder="eg. 1980"></div>

        <div class="students-form-label"><label for="students-player-duration">Your Trip Duration</label></div>
        <div class="students-form-input"><input name="students-player-duration" type="text" value="'.$prev_duration.'" placeholder="eg. 1 month, 20 years..."></div>
      </fieldset>
      <fieldset>
        <div class="students-form-submit">
          <input type="submit" name="submit" class="button" value="Register for On-Line Teaching!">
        </div>
      </fieldset>
    </form>';
    return $html;
}
private function renderStudent($studentData){
	$html.='<tr class="students-row" id="students-id-'.$studentData->stuId.'">';
	$html.='<td class="students-photo-cell"><img class="students-photo" src="'.$studentData->stuPhoto.'"></td>';
	$html.='<td><h2 class="students-name">'.$studentData->stuName.'</h2>';
	$html.='<div class="students-card">KGS: '.$studentData->stuKgs.'<br/>
																		 Country: '.$studentData->stuCountry.'<br/>
																		 Year of Birth: '.$studentData->stuBirth.'<br/>
																		 Rank: '.$studentData->stuRank.'<br/>
																		 Trip Duration: '.$studentData->stuTripDuration.'<br/>
																		 Gossip: <span class="students-gossip">'.$studentData->stuGossip.'</span></div></td>';
	$html.='</tr>';
	return $html;
}
private function renderStudentsTableHeader(){
	return '<thead><tr><th>Photo</th><th>Player Data</th></tr></thead>';
}
private function getStudents($current){
	global $wpdb;
	return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}students WHERE isApproved = 1 AND isCurrent = $current");
}
private function renderStudentsTable($current){
	$students= $this->getStudents($current);
	$html.='<table class="students-table" x-current="'.$current.'">';
	$this->renderStudentsTableHeader();
	foreach($students as $student)
		$html.= $this->renderStudent($student);
	$html.='</table>';
	return $html;
}
public function renderCurrentStudents(){
	$html.='<h3 class="students-header" x-current="1">Current Students in Korea</h3>';
	return $this->renderStudentsTable(1);
}
public function renderFormerStudents(){
	$html.='<h3 class="students-header" x-current="0">Former BIBA Students</h3>';
	return $this->renderStudentsTable(0);
}
public function post_register_data(){
	//$validation_result= $this->validate_post_register($_POST);
	//$data = $this->sanitizeUserData($_POST);
	$validation_result=array('suc'=> 1);
	$data=$_POST;
	//if($validation_result['suc'] == 1){
		global $wpdb;
		$dataToInsert= array(	'stuId' => '',
													'stuName' => $data['students-player-name'],
													'stuPhoto' => '', //TODO: how to download binary file and save on wordpress and retrieve from DB...
													'stuText' => $data['students-player-about'],
													'stuBirth' => $data['students-player-birth'],
													'stuTripDuration' => $data['students-player-duration'],
													'stuKgs' => $data['students-player-kgs-account'],
													'stuRank' => $data['students-player-rank'],
													'stuCountry' => $data['students-player-country'],
													'stuGossip' => '',
													'isCurrent' => $data['students-player-state'],
													'isApproved' => 0);
		$wpdb->insert("{$wpdb->prefix}students", $dataToInsert);
	//}
	wp_safe_redirect(add_query_arg( $validation_result, home_url('/students'))); //TODO: proper home url
	exit;
}
}
