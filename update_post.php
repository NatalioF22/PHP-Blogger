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
    $id = htmlspecialchars($user["id"]);
    $query = "SELECT * FROM post WHERE id='$id'";
    
    $query_run = mysqli_query($conn,$query);
    if($query_run){
        while($row = mysqli_fetch_array($query_run)){
            ?>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <form method="post" action="" >
        <input type="hidden" name = "id" value="<?php echo $row['id']?>">


        <div class="container-xxl my-2 mx-2 mx-auto">
    
            <input type="text" name = "content" class="w-75 border rounded-3 display-6 px-4"  value="<?php echo $row['content_header']?>">
        </div>
        <div class="container-xxl">
            <input type="text" name = "content_header" class="w-75 border rounded-3 display-6 px-4"  value="<?php echo $row['content']?>">
        </div>
        <div  class="container-xxl my-2 mx-2 mx-auto">
            <button class="btn btn-success align-top border rounded-3 display-3 px-4 add-btn btn btn-xs" name="update">Update</button>
            <a class="btn btn-danger align-top border rounded-3 display-3 px-4 add-btn" href="index.php">Cancel</a>
        </div>

    </form>
   
    <?php     
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        if (isset($_POST['update'])){
        $content = $_POST['content'];
        $content_header = $_POST['content_header'];
        
        $sql = "UPDATE post SET content='$content', content_header='$content_header' WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
        header("Location:index.php");
        } else {
        echo "Error updating record: " . mysqli_error($conn);
        }

        mysqli_close($conn);
        }
        if (isset($_POST['cancel'])){
            header("Location:index.php");}
        ?>
       <?php
       }
        }
        else{
            echo "No record found";
   }
   ?>
</body>
</html>