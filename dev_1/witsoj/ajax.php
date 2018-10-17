<?php
#echo "Hello World" ;

#requiring this file so that we can access its functionality

require_once('../../../../config.php');

define('ASSIGNFEEDBACK_WITSOJ_STATUS_PENDING', 0);
define('ASSIGNFEEDBACK_WITSOJ_STATUS_JUDGING', 1);

$gradeid = $_POST['sendID'];
global $DB;

// $sql = "SELECT * FROM {assignfeedback_witsoj} s ".
// 	" WHERE userid=".$id . " AND assignment = ".$assignid .
// 	" ORDER BY timemodified ASC ";
// $rec = $DB->get_records_sql($sql);

$feedbackcomment = $DB->get_record('assignfeedback_witsoj', array('grade'=>$gradeid));
$feedbackstatus = $feedbackcomment->status ;
$assignmentid = $feedbackcomment->assignment;
// $current_time = $feedback-comment->timemodified;


if($feedbackstatus  == ASSIGNFEEDBACK_WITSOJ_STATUS_PENDING){
	console.log("reached if statement");
	$sql = " SELECT position FROM
		(SELECT grade, @position := @position + 1 as position FROM
		(SELECT @position := 0) A,
		(SELECT * FROM mdl_assignfeedback_witsoj WHERE status= 0 ORDER BY timemodified ASC) B
	    WHERE assignment= '$assignmentid') C
	    WHERE grade = '$gradeid'";

	$rec = $DB->get_records_sql($sql);

	foreach($rec as $position => $v){
		echo "Your position in the queue is " .$position;
	}
	// modifying the queue query
	// query for the postion of the current user in the queue
	// $sql1 = "SELECT COUNT(*) FROM mdl_assignfeedback_witsoj WHERE timemodified < '$current_time' AND status = 0";
	// $sql2 = "SELECT COUNT(*) FROM mdl_assignfeedback_witsoj WHERE status = 0";
	// $rec1 = $DB->get_records_sql($sql1);
	// $rec2 = $DB->get_records_sql($sql2);

	// $position = reset($rec1);
	// $total_queue = reset($rec2);
			// "SELECT COUNT(*) FROM mdl_assignfeedback_witsoj WHERE timemodified < '$current_time' AND STATUS = 0";
			// "SELECT COUNT(*) FROM mdl_assignfeedback_witsoj WHERE status = 0";
	// $rec = $DB->get_records_sql($sql); // queries the datebase
	// echo $rec->count . " " .$rec2->count;
	// echo $position;
	// echo "Your position in the queue is ". $position . " out of " . $total_queue;


}elseif ($feedbackstatus  == ASSIGNFEEDBACK_WITSOJ_STATUS_JUDGING){
	console.log("reached elseif statement");
	echo "Judging" ;

}else{
	console.log("reached else statement");
	echo "GRADED";
	//echo $feedbackcomment->commenttext;
}
?>
