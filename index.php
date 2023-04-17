<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION['user_id'];
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

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <?php include("inc/header.php")   ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
    <div class="container-lg">
        
        
        <?php if (isset($user)): ?>
            
            <p>Hello <?= htmlspecialchars($user["f_name"]) ?></p>
            
            
            
        <?php else: ?>
            
            <p><a href="login.php">Log in</a> or <a href="signup.php">sign up</a></p>
            
        <?php endif; ?>
        <section>
        <div class="row g-0 text-center bg-light  ">
            <div class="col-12 col-sm-12 col-md-12 ">
                <h2>Feed</2>
                <div class="bg-primary text-start border rounded-3 p-3 mb-3">  
<?php
            $connection = mysqli_connect("localhost","root","");
            $db = mysqli_select_db($connection,'login_db');


            $date = "added_date";
            //$query = "SELECT * FROM todolist WHERE checked='$id'";
            if (isset($_POST['sort'])){
                $date = $_POST['sorting'];
            }

            $query = "SELECT * FROM post ORDER BY $date";
            $query_run = mysqli_query($connection, $query);
            ?>

    <?php
        if($query_run){
    while ($row = mysqli_fetch_array($query_run)) {
        
            ?>
            <div class="bg-secundary mb-3 border rounded-4 p-4">
        <h2 ><?php echo $row['content_header']; ?></h2>
        <hr>
        <p ><?php echo $row['content']; ?></p>
        <small class="text-muted">By <?php echo $row['author']; ?> | Posted on <?php echo $row['added_date']; ?></small>
        <?php if($row["id"]==$user_id){?>
        <div class="my-3">
            <a href="update_post.php" id="<?php echo $row['id']?>" class="btn btn-info px-2 d-inline-block">Update</a>

            <form action="delete_post.php" method="post" class="d-inline-block">
                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                <input type="submit" name = 'delete' value="DELETE"  class="btn btn-danger ">
            </form>
        </div>
        </div>
       
    
        <?php
        }
        
    }}
    else{
    echo "No record found";
    }
    
        ?>
        </div>
       
        </section>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
    
    