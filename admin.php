<?php
include_once 'header.php';
?>

<?php
include_once 'includes/dbh.inc.php';

if(!isset($_SESSION['id'])){
    header("location: index.php");
    exit();
}


$sql = "SELECT * FROM users;";
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach ($users as $users){
    if($users['id'] == $_SESSION['id']){
        if($users['rights'] == 1){

            //make another login to check if the user is an admin (to protect from session hijacking)

            echo "<h2>USERS</h2> <br>";
            $sql = "SELECT * FROM users;";
            $result = mysqli_query($conn, $sql);
            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
            print_r($users);

            echo "<h2>PRODUCTS</h2> <br>";
            $sql = "SELECT * FROM products;";
            $result = mysqli_query($conn, $sql);
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
            print_r($products);

            echo "<h2>PRODUCTSLIST</h2> <br>";
            $sql = "SELECT * FROM productslist;";
            $result = mysqli_query($conn, $sql);
            $productslist = mysqli_fetch_all($result, MYSQLI_ASSOC);
            print_r($productslist);

            echo "<h2>PROFILEIMG</h2> <br>";
            $sql = "SELECT * FROM profileimg;";
            $result = mysqli_query($conn, $sql);
            $profileimg = mysqli_fetch_all($result, MYSQLI_ASSOC);
            print_r($profileimg);

            echo "<h2>RANK</h2> <br>";
            $sql = "SELECT * FROM rank;";
            $result = mysqli_query($conn, $sql);
            $rank = mysqli_fetch_all($result, MYSQLI_ASSOC);
            print_r($rank);

            echo "<h2>STATUS</h2> <br>";
            $sql = "SELECT * FROM status;";
            $result = mysqli_query($conn, $sql);
            $status = mysqli_fetch_all($result, MYSQLI_ASSOC);
            print_r($status);

            /*echo "<h2>USERRANK</h2> <br>";
            $sql = "SELECT * FROM userrank;";
            $result = mysqli_query($conn, $sql);
            $userrank = mysqli_fetch_all($result, MYSQLI_ASSOC);
            print_r($userrank);*/

            echo "<h2>SUBJECT</h2> <br>";
            $sql = "SELECT * FROM subject;";
            $result = mysqli_query($conn, $sql);
            $subject = mysqli_fetch_all($result, MYSQLI_ASSOC);
            print_r($subject);

            echo "<h2>CLASS</h2> <br>";
            $sql = "SELECT * FROM class;";
            $result = mysqli_query($conn, $sql);
            $class = mysqli_fetch_all($result, MYSQLI_ASSOC);
            print_r($class);

            echo "<h2>MESSAGE</h2> <br>";
            $sql = "SELECT * FROM message;";
            $result = mysqli_query($conn, $sql);
            $message = mysqli_fetch_all($result, MYSQLI_ASSOC);
            print_r($message);

        } else {
            header("location: index.php");
        }
    }
}




?>


<?php
include_once 'footer.php';
?>
