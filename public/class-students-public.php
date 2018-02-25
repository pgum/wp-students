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
	private $plugin_name;
	private $version;
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/students-public.css', array(), $this->version, 'all' );
	}
	public function enqueue_scripts() {
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
    $html='';
    if(isset($_GET['suc']) && $_GET['suc'] == 0) $html.= $this->renderStudentNotSubmittedNotice();
    $html.= '<h3 class="students-register">Registration Form</h3>';
    $html.= '<p>Please fill out form below. All fields marked with <span class="students-required">*</span> are required for your form to be submitted.</p>';
    $html.= '<p>If it was your another trip, just make sure to fill in your name and year of birth as in firt trip!</p>';
    $html.='<form class="students-register-form" action="'.get_admin_url().'admin-post.php" method="post" enctype="multipart/form-data">
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

        <div class="students-form-label"><label for="students-player-birth">Year of Birth <span class="students-required">*</span></label></div>
        <div class="students-form-input"><input name="students-player-birth" type="text" value="'.$prev_birth.'" placeholder="eg. 1980"></div>

        <div class="students-form-label"><label for="students-player-duration">Your Trip Duration</label></div>
        <div class="students-form-input"><input name="students-player-duration" type="text" value="'.$prev_duration.'" placeholder="eg. 1 month, 20 years..."></div>
      </fieldset>
      <fieldset>
        <div class="students-form-submit">
          <input type="submit" name="submit" class="button" value="Register your trip!">
        </div>
      </fieldset>
    </form>';
    return $html;
}
private function renderStudent($studentData){
	$html='<tr class="students-row" id="students-id-'.$studentData->stuId.'">';
	$html.='<td class="students-photo-cell"><img class="students-photo" src="'.wp_get_attachment_url($studentData->stuPhoto).'"></td>';
	$html.='<td><h5 class="students-name">'.$studentData->stuName.'</h5>';
	$html.='<div class="students-card">KGS: '.$studentData->stuKgs.'<br/>
																		 Country: '.$studentData->stuCountry.'<br/>
																		 Year of Birth: '.$studentData->stuBirth.'<br/>
																		 Rank: '.$studentData->stuRank.'<br/>
																		 Trip Duration: '.$studentData->stuTripDuration.'<br/>
																		 Text:<br/>'.$studentData->stuText.'<br/>';
  foreach($studentData->anotherTrip as $at)
  	$html.='<hr><div class="students-card">Rank: '.$at->stuRank.'<br/>
                                           Trip Duration: '.$at->stuTripDuration.'<br/>
                                           Text:<br/>'.$at->stuText.'<br/>';
	$html.='</tr>';
	return $html;
}
private function renderStudentsTableHeader(){
	return '<thead><tr><th>Photo</th><th>Player Data</th></tr></thead>';
}
private function getStudents($current){
	global $wpdb;
  $firstTrips= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}students WHERE isApproved= 1 AND prevStuId= 0 AND isCurrent= $current", OBJECT_K);
  foreach($firstTrips as $ft)
    $ft->anotherTrip= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}students WHERE isApproved= 1 AND prevStuId = {$ft->stuId}");
  print_r($firstTrips); //ver1.5 debug
  return $firstTrips;
}
private function renderStudentsTable($current){
	$students= $this->getStudents($current);
	$html.='<table class="students-table" x-current="'.$current.'">';
	$this->renderStudentsTableHeader();
	foreach($students as $student){

    $html.= $this->renderStudent($student);
  }
	$html.='</table>';
	return $html;
}
public function renderCurrentStudents(){
  $html='';
  if(isset($_GET['suc']))
    if($_GET['suc'] == 1) $html= $this->renderStudentSubmittedNotice();
	$html.='<h3 class="students-header" x-current="1">Current Students in Korea</h3>';
	return $html.$this->renderStudentsTable(1);
}
public function renderFormerStudents(){
	$html.='<h3 class="students-header" x-current="0">Former BIBA Students</h3>';
	return $html.$this->renderStudentsTable(0);
}
public function post_register_data(){
		// These files need to be included as dependencies when on the front end.
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );

	//$validation_result= $this->validate_post_register($_POST);
	//$data = $this->sanitizeUserData($_POST);
	//print_r(array('data'=> $_POST,"files"=>$_FILES['students-player-photo']['name']));
			//exit;
	$validation_result=array('suc'=> 1);
	$data=$_POST;

	$uploadedImage= media_handle_upload('students-player-photo', 0);
	if ( is_wp_error($uploadedImage)){ $uploadedImage=''; }
	//if($validation_result['suc'] == 1){
		global $wpdb;
    $prevStuId= $wpdb->get_var("SELECT stuId FROM {$wpdb->prefix}students WHERE stuName LIKE '".$data['students-player-name']."' AND stuBirth LIKE '".$data['students-player-birth']."' AND prevStuId= 0");
    $prevStuId= $prevStuId == NULL ? '0' : $prevStuId;
    $dataToInsert= array(	'stuId' => '',
													'stuName' => $data['students-player-name'],
													'stuPhoto' => $uploadedImage,
													'stuText' => $data['students-player-about'],
													'stuBirth' => $data['students-player-birth'],
													'stuTripDuration' => $data['students-player-duration'],
													'stuKgs' => $data['students-player-kgs-account'],
													'stuRank' => $data['students-player-rank'],
													'stuCountry' => $data['students-player-country'],
													'stuGossip' => '',
                          'prevStuId' => $prevStuId,
													'isCurrent' => $data['students-player-state'],
													'isApproved' => 0);
		$wpdb->insert("{$wpdb->prefix}students", $dataToInsert);
	//}
	$page = ($validation_result['suc'] == 1) ? '/students' : 'register-your-stay';
	wp_safe_redirect(add_query_arg( $validation_result, home_url($page)));
	exit;
}
}
