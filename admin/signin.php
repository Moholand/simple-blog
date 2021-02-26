<?php

session_start();

include("./include/config.php");
include("./include/db.php");

if (isset($_POST['login'])) {

    if (trim($_POST['email']) != "" && trim($_POST['password']) != "") {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user_select = $db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $user_select->execute(['email' => $email, 'password' => $password]);

        if ($user_select->rowCount() == 1) {

            $_SESSION['email'] = $email;
            header("Location:index.php");
            exit();
        } 
    
    } else {

        header("Location:signin.php?err_msg=پر کردن تمام فیلد ها الزامی می باشد.");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin.css">
    <title>MOHOLAND-Login</title>
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center" style="height: 100vh">
            <div class="card bg-dark">
                <?php
                if (isset($_GET['err_msg'])) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET['err_msg'] ?>
                    </div>
                <?php
                }
                ?>

                <h3 class="text-white text-center pt-3">ورود</h3>
                <div class="card-body" style="width: 400px">
                    <form method="post">
                        <div class="form-group">
                            <label for="email" class="text-white">ایمیل</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="ایمیل خود را وارد نمایید.">
                        </div>
                        <div class="form-group">
                            <label class="text-white" for="password">رمز عبور</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="پسورد خود را وارد کنید.">
                        </div>

                        <button type="submit" name="login" class="btn btn-outline-primary btn-block">ورود</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>