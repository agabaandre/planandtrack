<?php //session_start(); 
        if(!isset($_GET['type_id'])){
             $approval = $_SESSION['approval'];
             }else{
             $approval = $_GET['type_id'];
             $_SESSION['approval'] = $approval;
        } 
$approval = "approval/".$approval;
// Header content type
header("Content-type: application/pdf");
header("Content-Length: " . filesize($approval));
// Send the file to the browser.
readfile($approval);
