<?php
require_once 'controllers/authController.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/games.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/rara.css">
    <link rel="stylesheet" href="css/category.css" />
    <script src="https://code.jquery.com/jquery-3.1.1.js"
        integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>

    <?php include('naviBar.phtml');
    $_SESSION['game_id'] = $_GET['gameId'];
    $sql = "SELECT game_name, game_id, game_price, game_requirements, game_description, game_images FROM games_id WHERE
    game_id = " . $_SESSION["game_id"];
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    ?>
</head>

<body>

    <header class="hero2">
        <div class="banner2">
            <div class="container">
                <div class="title">
                    <h1><?php echo  $row["game_name"]; ?></h1>
                </div>
                <div class="slider-outer">
                    <img src="images/arrow-left.png" class="prev" alt="Prev">
                    <div class="slider-inner">
                        <?php
                        $counter = 0;
                        while ($counter < $row["game_images"]) {
                            if ($counter == 0) {
                                echo '<img style="width: 491px" src="images/games/game_' . $row["game_id"] . '/image_' . $counter . '.jpg" class="active">';
                            } else {
                                echo '<img style="width: 491px" src="images/games/game_' . $row["game_id"] . '/image_' . $counter . '.jpg">';
                            }
                            $counter++;
                        }
                        ?>
                    </div>
                    <img src="images/arrow-right.png" class="next" alt="Next">
                </div>
            </div>


            <div class="buy">
                <p><?php echo  $row["game_name"]; ?></p>
                <div class="date">
                    <div class="pret">
                        <?php
                        echo  $row["game_price"];
                        ?>
                    </div>
                    <form method="post">
                        <div class="popup btn">
                            <button type="submit" class="popup pay" name="doPay">Buy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </header>

    <?php
    if (isset($_POST['doPay'])) {
        if (isset($_SESSION['username'])) {
            $sql2 = "SELECT cart FROM users WHERE username = '" . $_SESSION['username'] . "'";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();

            if (substr_count($row2['cart'], ",") == 0 && $row2['cart'] == "") {
                $new_cart = $row2['cart'] . $_SESSION['game_id'];
            } else {
                $new_cart = $row2['cart'] . "," . $_SESSION['game_id'];
            }

            $sql3 = "UPDATE users SET cart = '" . $new_cart . "' WHERE username = '" . $_SESSION['username'] . "'";
            $result3 = $conn->query($sql3);
            echo "<h2 style='margin-left:30%;color:green'>The game has been added to your cart.</h2>";
        } else {
            echo "<h2 style='margin-left:40%;color:red'>Please log in first.</h2>";
        }
    }


    echo  $row["game_description"];

    echo  $row["game_requirements"];
    ?>


</body>

</html>