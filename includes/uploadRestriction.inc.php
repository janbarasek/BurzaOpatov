<?php

session_start();
include_once 'dbh.inc.php';
$id = $_SESSION['id'];

if(isset($_POST['submit'])){
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($fileActualExt,$allowed)){
        if ($fileError === 0){
            if ($fileSize < 500000000){//500mb

                if($_SESSION['imgStatus'] == 1){
                    $filenamedel = "../uploads/profile".$id."*";
                    $fileinfodel = glob($filenamedel);

                    if(!unlink($fileinfodel[0])){
                        echo "There was an error deleting your old file";
                        header("Location: ../profile.php?error=delete");
                    }else{
                        echo "File deleted";
                        header("Location: ../profile.php?deletesuccess");
                    }

                    $sql = "UPDATE profileImg SET status=0 WHERE userid='$id';";
                    mysqli_query($conn, $sql);
                    $_SESSION['imgStatus'] = 0;
                }




                $fileNameNew = "profile".$id.".". $fileActualExt;
                $fileDestination = '../uploads/' . $fileNameNew;

                move_uploaded_file($fileTmpName, $fileDestination);

                $sql = "UPDATE profileImg SET status=1 WHERE userid='$id';";
                $_SESSION['imgStatus'] = 1;
                $result = mysqli_query($conn, $sql);
                header("Location: ../profile.php?uploadsuccess");

            }else{
                header("Location: ../profile.php?error=filetoobig");
            }
        }else{
            header("Location: ../profile.php?error=uploaderror");
        }
    }else{
        header("Location: ../profile.php?error=wrongfiletype");
    }
}