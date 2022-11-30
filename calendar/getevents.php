<?php
include("../connect.php");
$start = $_GET["start"];
$end = $_GET["end"];

$query = "SELECT expenditures.expenditure_id as id, CONCAT(COALESCE(lname,'',''),' ',COALESCE(fname,'',''),' - ',COALESCE(member_states.member_state,'','')) as title, expenditures.actual_start_date as start,expenditures.actual_end_date as end,member_states.color as color,activity, 'true' as allDay from expenditures,travellers,staff,member_states
 WHERE expenditures.expenditure_id=travellers.expenditure_id and staff.staff_id=travellers.staff_id and member_states.member_state_id=expenditures.member_state_id and expenditures.actual_start_date between '$start' and '$end' ";

$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($row, true);


