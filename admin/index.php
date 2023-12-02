<?php
    require('inc/db_config.php');

    session_start();
    if (isset($_SESSION['user_id'])) {
        header("Location: dashboard.php");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login panel</title>
    <?php require ('inc/links.php'); ?>
    <style>
        div.login-form{
            position:absolute;
            top:50%;
            left:50%;
            transform: translate(-50%,-50%);
            width:400px;
        }
    </style>
</head>

<body class ="bg-light" >
    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form method="POST"  action="">
        <?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANEL</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="name" required type="text" class="form-control shadow-none text-center" placeholder="Admin Name">                      
                </div>
                <div class="mb-4">
                    <input name="pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">                      
                </div>
                <button  type="submit" class="btn text-white custom-bg shadow-none">Login</button>
                
            </div>
        </form>
    </div>
<?php 
   
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $username = $_POST['name'];
    $password = $_POST['pass'];

   $sql = "SELECT * FROM admin_cred WHERE name = ? AND pass = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['name'];

        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }

    $con->close();
}

?>
   


    <?php require ('inc/scripts.php'); ?>
</body>
</html>