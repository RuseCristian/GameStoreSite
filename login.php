<?php require_once 'controllers/authController.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login Site</title>
    <link rel="stylesheet" href="css/forms.css">

    <?php
    include('naviBar.phtml');
    ?>
</head>

<body>
    <section class="page-wrap">

        <div class="logo_box">
            <img class=" logo" src="images/logo.jpg">
        </div>

        <div class="label_box">
            <div class="label_inside">
                <h2>
                    <p style="padding-left:15px;padding-top: 25px" class="label_inside">Login For the Best Prices!</p>
                </h2>
            </div>
        </div>

        <form action=" login.php" method="post">


            <div class="label_box">
                <label for=" username"><b></b></label>
                <input class="label_inside" style="padding-left:20px" type="text" placeholder="Username or  E-mail"
                    class="email" name="username" required>
            </div>



            <div class="label_box">
                <label for="psw"><b></b></label>
                <input class="label_inside" style="padding-left:20px" type="password" placeholder="Password"
                    class="password" name="password" required>
            </div>



            <div class="label_box">
                <button type="submit" class="btn_form" name="login-btn">Login</button>
            </div>



            <div class="label_box">
                <div class="label_inside" style="margin-top:50px">
                    <i class=" fas fa-sad-cry"></i> Not a member? <a href="register.php"> Sign Up Now</a>
                </div>
            </div>



            <div class="label_box">
                <div class="label_inside">
                    <a href="forgotpass.php"> Forgot password?</a>
                </div>
            </div>
        </form>
    </section>
</body>

</html>