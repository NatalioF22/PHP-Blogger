<?php
    
 include 'inc/header.php';

    session_start();
    
    if (isset($_SESSION["user_id"])) {
        $session_in = true;
        $mysqli = require __DIR__ . "/database.php";
        
        $sql = "SELECT * FROM user
                WHERE id = {$_SESSION["user_id"]}";
                
        $result = $mysqli->query($sql);
        
        $user = $result->fetch_assoc();
    }
    if($session_in==false){
        header("Location:login.php");
    }
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,'login_db');



    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login_db";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    


if(isset($_POST['delete'])){
    $id = htmlspecialchars($user["id"]);

    $query =  "DELETE FROM post WHERE id = '$id'";
    
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        echo "Deleted Successfully";
        header('Location:index.php');
    }else{
        echo "Not Done";
    }

}

?>