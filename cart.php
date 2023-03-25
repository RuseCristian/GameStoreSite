<?php require_once 'controllers/authController.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Cart</title>
    <link rel="stylesheet" href="css/forms.css">

    <?php
    include('naviBar.phtml');
    if (isset($_POST['clear_btn'])) {
        $sql = "UPDATE users SET cart ='' WHERE username='" . $_SESSION['username'] . "'";
        $result = $conn->query($sql);
    }
    if (isset($_POST['buy_btn'])) {
        $sql = "UPDATE users SET cart ='' WHERE username='" . $_SESSION['username'] . "'";
        $result = $conn->query($sql);
        $thank_you = 1;
        unset($_POST['buy_btn']);
    }
    if (isset($_SESSION['username'])) :
        $sql1 = "SELECT * FROM users WHERE username = " . "'" . $_SESSION['username'] . "'";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $in_cart = explode(",", $row1['cart']);

    ?>

</head>


<body>
    <?php
        echo '<section class="page-wrap" style="height:' . (count($in_cart) + 1) * 270 . 'px;">';
    ?>
    <div class=" logo_box">
        <img class=" logo" src="images/logo.jpg">
    </div>

    <div class="label_box">
        <div class="label_inside">
            <h2>
                <p style="padding-left:125px;padding-top: 25px" class="label_inside">Cart</p>
            </h2>
        </div>
    </div>

    <?php


        $total_pay = 0;
        $i = 0;
        if ($in_cart[0] != "") :
            while ($i < count($in_cart)) {
                $sql2 = "SELECT * FROM games_id WHERE game_id = " . "'" . $in_cart[$i] . "'";
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch_assoc();
                $total_pay += intval(explode("$", $row2['game_price'])[1]);
                $i++;
                echo
                '<div class="label_box" style="height: 150px;width:500px"> 
                        <img style="width: 200px; height: 100px;" src="images/games/game_' . $row2['game_id'] . '/banner.jpg" alt=""  >' .
                    '<p >' . $row2['game_name'] . '</p>' .
                    '<p > Price: ' . $row2['game_price'] . '</p>
                          
                    </div>';
            }


    ?>

        <form action="cart.php" method="post">

            <div class="label_box">
                <p>Total to pay: $<?php echo $total_pay; ?> </p>
            </div>


            <div class="label_box">
                <button type="submit" class="btn_form" name="buy_btn">Buy</button>
            </div>
        </form>
        <form action="cart.php" method="post">

            <div class="label_box">
                <button type="submit" class="btn_form" name="clear_btn">Clear Cart</button>
            </div>
        </form>
    <?php
        else :
    ?>
        <div class="label_box">
            <div class="label_inside">
                <h2>
                    <?php
                    if (isset($thank_you)) {
                        echo '<p style="color:green;margin-top:80px;margin-left:35px" class=" label_inside">Thank you for Buying! :)</p>';
                    } else {
                        echo '<p style="margin-top:80px;margin-left:50px" class=" label_inside">Your Cart is Empty.</p>';
                    }
                    ?>
                </h2>
            </div>
        </div>
        </section>


    <?php
        endif;
    else :
    ?>
    <section class="page-wrap" style="height:'. (count($in_cart)+1)*230 .'px;">
        <div class=" logo_box">
            <img class=" logo" src="images/logo.jpg">
        </div>

        <div class="label_box">
            <div class="label_inside">
                <h2>
                    <p style="padding-left:125px;padding-top: 25px" class="label_inside">Cart</p>
                </h2>
            </div>
        </div>

        <div class="label_box">
            <div class="label_inside">
                <h2>
                    <p style="margin-top:80px;margin-left:45px" class=" label_inside">You are not logged in.</p>
                </h2>
            </div>
        </div>
    </section>
<?php
    endif;
?>

</body>

</html>