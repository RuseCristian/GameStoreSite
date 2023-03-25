<?php require_once 'controllers/authController.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login Site</title>
    <link rel="stylesheet" href="css/forms.css">

    <?php include('naviBar.phtml');?>
</head>

<body>
    <section class="page-wrap">
        <div class="logo_box">
            <img class=" logo" src="images/logo.jpg">
        </div>

        <div class="label_box" style="margin-bottom:90px;margin-top:30px">
            <h2>
                <p>Reset your password</p>
            </h2>
            <p>
                Enter the email address associated with your account, and if such account exists we'll email you a link
                to reset your
                password.
            </p>
        </div>
        <form action="forgotpass.php?sentEmail=1" method="post">
            <div class="label_box">
                <label for="uname"><b></b></label>
                <input style="padding-left:20px" class="label_inside" type="email" id="email" placeholder="E-mail"
                    class="email" name="email" required />
            </div>
            <div class="label_box">
                <button type="submit" class="btn_form">
                    <i class="fas fa-exclamation"></i> Send reset Link
                </button>
            </div>
        </form>

        <?php
        if(isset($_POST['email'])):
            $email = $_POST["email"];
            if(isset($_GET['sentEmail'])):
                $sql = "SELECT email FROM users WHERE email = " . "'" . $email ."'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                if(isset($row['email'])): 
                    ?>
        <div class="label_box">
            <div class="label_inside">
                <h2>
                    <p style=" padding-top: 40px" class="label_inside">We sent you a password
                        recovery link to your email.
                    </p>
                </h2>
            </div>
        </div>
        <?php
                    endif;
                else:?>
        <div class="label_box">
            <div class="label_inside">
                <h2>
                    <p style="padding-top: 40px" class="label_inside">We did not find an account
                        with that email.
                    </p>
                </h2>
            </div>
        </div>
        <?php
            endif;
        endif;
        unset($_GET['sentEmail']);
        ?>
    </section>
</body>

</html>