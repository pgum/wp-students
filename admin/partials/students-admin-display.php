<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.linkedin.com/in/piotr-jacek-gumulka/
 * @since      1.0.0
 *
 * @package    Students
 * @subpackage Students/admin/partials
 */
  global $wpdb;
  $studentsToApprove= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}students WHERE isApproved = 0")
  $html='<h3><span class="dashicons dashicons-flag"></span>Students Entries to Approve</h3>';
  $html.='<table class="students-table-to-approve">
          <thead><th>#</th><th>Player Photo</th><th>Player Details</th><th>Approve</th><th>Reject</th></thead><tbody>';
  $i=1;
  foreach($studentsToApprove as $student){
    $html.='<tr class="students-row" id="students-id-'.$studentData->stuId.'">';
    $html.='<td>'.$i.'</td>';
    $html.='<td class="students-photo-cell"><img class="students-photo" src="'.$studentData->stuPhoto.'"></td>';
    $html.='<td><h2 class="students-name">'.$studentData->stuName.'</h2>';
    $html.='<div class="students-card">KGS: '.$studentData->stuKgs.'<br/>
                                      Country: '.$studentData->stuCountry.'<br/>
                                      Year of Birth: '.$studentData->stuBirth.'<br/>
                                      Rank: '.$studentData->stuRank.'<br/>
                                      Trip Duration: '.$studentData->stuTripDuration.'<br/>
                                      Gossip: <span class="students-gossip">'.$studentData->stuGossip.'</span></div></td>';
    $html.='<td>'.'<a href="#" class="button secondary students-approve-result" x-student-id="'.$student->stuId.'">Approve Game</a>'.'</td>';
    $html.='<td>'.'<a href="#" class="button button-red students-remove-result" x-student-id="'.$student->stuId.'">Reject Game</a>'.'</td>';
    $html.='</tr>';
    $i++;
  }
  $html.='</tbody></table>';
  echo $html;

  $students= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}students WHERE isApproved = 1")
  $html='<h3><span class="dashicons dashicons-flag"></span>Students Entries For Edit</h3>';
  $html.='<table class="students-table-editable">
          <thead><th>#</th><th>Player Photo</th><th>Students Details</th></thead><tbody>';
  $i=1;
  foreach($studentsToApprove as $studentData){
    $html.='<tr class="students-row" id="students-id-'.$studentData->stuId.'">';
    $html.='<td>'.$i.'</td>';
    $html.='<td class="students-photo-cell"><img class="students-photo" src="'.$studentData->stuPhoto.'"></td>';
    $html.='<td><h2 class="students-name-editable">'.$studentData->stuName.'</h2>';
    $html.='<div class="students-card-editable">
              isCurrent: <span class="students-editable" x-field="isCurrent" x-student-id="'.$studentData->stuId.'">'.$studentData->isCurrent.'</span><br/>
              KGS: <span class="students-editable" x-field="stuKgs" x-student-id="'.$studentData->stuId.'">'.$studentData->stuKgs.'</span><br/>
              Country: <span class="students-editable" x-field="stuCountry" x-student-id="'.$studentData->stuId.'">'.$studentData->stuCountry.'</span><br/>
              Year of Birth: <span class="students-editable" x-field="stuBirth" x-student-id="'.$studentData->stuId.'">'.$studentData->stuBirth.'</span><br/>
              Rank: <span class="students-editable" x-field="stuRank" x-student-id="'.$studentData->stuId.'">'.$studentData->stuRank.'</span><br/>
              Trip Duration: <span class="students-editable" x-field="stuTripDuration" x-student-id="'.$studentData->stuId.'">'.$studentData->stuTripDuration.'</span><br/>
              Gossip: <span class="students-editable x-field="stuGossip" x-student-id="'.$studentData->stuId.'">'.$studentData->stuGossip.'</span></span></div></td>';
    $html.='</tr>';
    $i++;
  }
  $html.='</tbody></table>';
  echo $html;

?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
