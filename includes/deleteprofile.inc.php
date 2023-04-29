<?php
session_start();
include_once 'dbh.inc.php';

$sessionid = $_SESSION['id'];

$filename = "../uploads/profile".$sessionid."*";
$fileinfo = glob($filename);
$fileext = explode(".", $fileinfo[0]);
$fileactualext = $fileext[1];

$file = "../uploads/profile".$sessionid.".".$fileactualext;

if(!unlink($fileinfo[0])){
    echo "There was an error deleting your file";
}else{
    echo "File deleted";
}

$sql = "UPDATE profileimg SET status=0 WHERE userid='$sessionid';";
mysqli_query($conn, $sql);
$_SESSION['imgStatus'] = 0;

header("Location: ../profile.php?deletesuccess");

