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
                        header("Location: ../profile.php?error=none");
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
                header("Location: ../profile.php?");

            }else{
                echo "Your file is too big";
            }
        }else{
            echo 'There was an error uploading';
        }
    }else{
        echo 'You cannot upload files of this type!';
    }
}