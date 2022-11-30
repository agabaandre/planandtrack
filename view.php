<?php //session_start(); 
        if(!isset($_GET['type_id'])){
             $file_name = $_SESSION['file_name'];
             }else{
             $file_name = $_GET['type_id'];
             $_SESSION['file_name'] = $file_name;
        } 
$filename = "reports/".$file_name;
// Header content type
header("Content-type: application/pdf");
header("Content-Length: " . filesize($filename));
// Send the file to the browser.
readfile($filename);
