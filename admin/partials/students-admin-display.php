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
  $studentsToApprove= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}students WHERE isApproved = 0");
  $html='<h3><span class="dashicons dashicons-flag"></span>Students Entries to Approve</h3>';
  $html.='<table class="students-table-to-approve">
          <thead><th>#</th><th>Player Photo</th><th>Player Details</th><th>Approve</th><th>Reject</th></thead><tbody>';
  $i=1;
  function renderStudentField($fieldText, $fieldName, $field){
    $html.='<div class="students-editable-f">';
    $html.= $fieldText.': <span class="students-editable" x-field="'.$fieldName.'">'.$field.'&nbsp;&nbsp;&nbsp;</span>';
    $html.= '<span class="students-editable-e students-hidden" x-field="'.$fieldName.'"></span>';
    $html.='<br/></div>';
    return $html;
  }
  foreach($studentsToApprove as $studentData){
    $html.='<tr class="students-row" id="students-id-'.$studentData->stuId.'">';
    $html.='<td>'.$i.'</td>';
    $html.='<td class="students-photo-cell"><img class="students-photo" src="'.wp_get_attachment_url($studentData->stuPhoto).'"></td>';
    $html.='<td><h2 class="students-name">'.$studentData->stuName.'</h2>';
    $html.='<div class="students-card">KGS: '.$studentData->stuKgs.'<br/>
                                      Country: '.$studentData->stuCountry.'<br/>
                                      Year of Birth: '.$studentData->stuBirth.'<br/>
                                      Rank: '.$studentData->stuRank.'<br/>
                                      Trip Duration: '.$studentData->stuTripDuration.'<br/>
                                      Text:<br/>'.$studentData->stuText.'<br/>
                                      Gossip: <span class="students-gossip">'.$studentData->stuGossip.'</span></div></td>';
    $html.='<td><a href="#" class="button secondary students-approve-player" x-student-id="'.$studentData->stuId.'">Approve Student</a></td>';
    $html.='<td><a href="#" class="button button-red students-remove-player" x-student-id="'.$studentData->stuId.'">Reject Student</a></td>';
    $html.='</tr>';
    $i++;
  }
  $html.='</tbody></table>';
  echo $html;
  $students= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}students WHERE isApproved = 1");
  $html='<h3><span class="dashicons dashicons-flag"></span>Students Entries For Edit</h3>';
  $html.='<table class="students-table students-table-edit">
          <thead><th>#</th><th>Player Photo</th><th>Students Details</th></thead><tbody>';
  $i=1;
  foreach($students as $studentData){
    $isCurrent='Current';
    $html.='<tr class="students-row" id="students-id-'.$studentData->stuId.'">';
    $html.='<td>'.$i.'</td>';
    $html.='<td class="students-photo-cell"><img class="students-photo" src="'.wp_get_attachment_url($studentData->stuPhoto).'"></td>';
    $html.='<td><h2 class="students-name-editable">'.$studentData->stuName.'</h2>';
    $html.='<div class="students-card-editable" x-student-id="'.$studentData->stuId.'">';
    $html.= renderStudentField('Status','isCurrent', $studentData->isCurrent);
    $html.= renderStudentField('Kgs','stuKgs', $studentData->stuKgs);
    $html.= renderStudentField('Country','stuCountry', $studentData->stuCountry);
    $html.= renderStudentField('Date of Birth','stuBirth', $studentData->stuBirth);
    $html.= renderStudentField('Rank','stuRank', $studentData->stuRank);
    $html.= renderStudentField('Trip Duration','stuTripDuration', $studentData->stuTripDuration);
    $html.= renderStudentField('About','stuText', $studentData->stuText);
    $html.= renderStudentField('Gossip','stuGossip', $studentData->stuGossip);
    $html.='</tr>';
    $i++;
  }
  $html.='</tbody></table>';
  echo $html;

?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
