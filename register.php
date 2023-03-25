<?php require_once 'controllers/authController.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Register Ludos</title>
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
                    <p style="padding-left:105px; padding-top: 25px" class="label_inside">Register
                    </p>
                </h2>
            </div>
        </div>

        <form action="register.php" method="post">

            <?php if(count($errors) > 0): ?>
            <div style="margin-bottom: 30px; margin-top:30px" class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <li> <?php echo $error; ?></li>
                <?php endforeach; ?>
            </div>

            <?php endif; ?>

            <div class="label_box">
                <label for="username"></label>
                <input class="label_inside" style="padding-left:20px" type="name" placeholder="Name" class="name "
                    maxlength="50" name="username" value="" required>
            </div>


            <div class="label_box">
                <label for="email"></label>
                <input class="label_inside" style="padding-left:20px" type="email" placeholder="E-mail" class="email"
                    maxlength="150" name="email" value="" required>
            </div>


            <div class="label_box">
                <label for="password"></label>
                <input class="label_inside" style="padding-left:20px" type="password" placeholder="Password"
                    class="password" maxlength="50" name="password" required>
            </div>


            <div class="label_box">
                <label for="passwordConf"> </label>
                <input class="label_inside" style="padding-left:20px" type="password" placeholder="Retype-Password"
                    class="password" maxlength="50" name="passwordConf" required>
            </div>


            <div class="label_box">
                <pre><label class="rem">
                <p> <input type="checkbox"class="checkbox"  name="remember" required><p>I accept the <a href="html/terms.html"target="_blank">Terms & Conditions</a> and I acknowledge</p><p class="Privacy"><a href="html/privacy.html"target="_blank">Privacy Policy</a></p>
                </label>
                </div>
                <div>
                    <button class="btn_form"  style="margin-left: 160px"type="submit"class="submit" name="signup-btn">Register</button>
                </div>
                
        </form>
    </section>

</body>

</html>