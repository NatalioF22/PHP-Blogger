<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body style=" background-image: linear-gradient(to right, rgb(208, 35, 35) , yellow); margin-top:150px">
    <section>
    <div class="container-xxl spacing ">
    <div class="row align-items-center justify-content-center">
    <div class="container-xxl col-3 my-5 ">
    
    <div class="conntainer text-center">
                        <h1>PHP BLOG</h1>
                        <p class="lead text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit</p>
                   </div>
                   </div>
                   <div class="container-xxl col-3 my-5 ms-5 card p-5 centyer">
                   <form method="post" >
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    <div class="form-group row">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email"  class="form-control" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
    </div>
    <div class="form-group row">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
        <button class="btn btn-primary my-4">Log in</button>
        <a href="signup.php" class="btn btn-info">Sign Up</a>
    </form>
                   </div>
    
    </div>
    </div>

    </section>
   
    
   
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>




