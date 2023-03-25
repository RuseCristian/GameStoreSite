<?php require_once 'controllers/authController.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Gamers E-Shop</title>
    <link rel="stylesheet" href="css/forms.css">

    <?php include('naviBar.phtml');?>


</head>

<body>
    <?php
        $sql = "SELECT * FROM games_id";
        $result = $conn->query($sql);
        $counter = 0;
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $counter++;
            }
        }
        $game_id = $counter;
    ?>
    <section class="page-wrap" style="height: 1200px">

        <form action="addgame.php" method="post" enctype="multipart/form-data">
            <div class=" logo_box">
                <img class=" logo" src="images/logo.jpg">
            </div>

            <div class="label_box">
                <div class="label_inside">
                    <h2>
                        <p style="padding-left:65px; padding-top: 25px" class="label_inside">Add new game
                        </p>
                    </h2>
                </div>
            </div>

            <div class="label_box">

                <label for="game_name"></label>
                <br>
                <p>Game Name</p>
                <input class="label_inside" style="padding-left:20px" type="name" placeholder="Game Name"
                    class="game_name" maxlength="50" name="game_name" required>
            </div>
            <div class="label_box">
                <label for="game_price"></label>
                <br>
                <br>
                <p>Game Price</p>
                <input class="label_inside" style="padding-left:20px" type="number" placeholder="Game Price($)"
                    class="game_price" maxlength="50" name="game_price" required>
            </div>

            <div class="box_big">
                <label for="game_description">
                    <br>
                    <br>
                    <p>Description</p>
                </label>
                <textarea name="game_description" required></textarea>
            </div>
            <div class="box_big">
                <label for="game_requirements">
                    <br>
                    <p>Requirements</p>
                </label>
                <textarea name="game_requirements" required></textarea>
            </div>

            <div class="label_box" style="height:90px">
                <label>
                    <p>Category</p>
                    <br>
                </label>
                <input type="checkbox" name="game_category_1" value="Adventure">
                <label> Adventure </label><br>
                <input type="checkbox" name="game_category_2" value="Action">
                <label> Action</label><br>
                <input type="checkbox" name="game_category_3" value="Cars">
                <label> Cars</label>
            </div>

            <div class="box_big">
                <label>
                    <p>Images (Last image must be the banner)</p>
                    <br>
                </label>
                <input type="file" name="game_images[]" multiple="multiple" accept="image/jpeg" required>
            </div>

            <div class="box_big">
                <div>
                    <button class="btn_form" style="margin-left: 45px" type="submit" class="submit"
                        name="addgame_btn">Add Game</button>
                </div>
            </div>
            <div class="label_box">

                <label for="game_name"></label>
                <br>
                <?php
            if (isset($_POST['addgame_btn'])) {
                $game_name = $_POST['game_name'];
                $game_price = "$" . $_POST['game_price'];
                $game_description = $_POST['game_description'];
                $game_requirements = $_POST['game_requirements'];
                
                $game_category = "";
                if(isset($_POST['game_category_1'])){
                    $game_category .= $_POST['game_category_1'];
                }
                if(isset($_POST['game_category_2'])){
                    $game_category .= $_POST['game_category_2'];
                }
                if(isset($_POST['game_category_3'])){
                    $game_category .= $_POST['game_category_3'];
                }
                
                if (!file_exists("images/games/game_". $game_id)) {
                    mkdir("images/games/game_". $game_id);
                }
                
                $game_images = count($_FILES['game_images']['name']) -1;  
                copy($_FILES['game_images']['tmp_name'][0], "images/games/game_". $game_id ."/banner.jpg");
                $counter2 = 1;
                while($counter2 <= $game_images){
                    copy($_FILES['game_images']['tmp_name'][$counter2], "images/games/game_". $game_id ."/image_" . $counter2 - 1 . ".jpg");
                    $counter2++;
                }
                
                $sql = "INSERT INTO games_id (game_name, game_id, game_description, game_requirements, game_price, game_images, category) VALUES ('". $game_name ."','". $game_id ."','". $game_description ."','". $game_requirements ."','". $game_price ."','". $game_images."','". $game_category ."')";
                $result = $conn->query($sql);
                
                if($result){
                    echo "<p style='color:green' > Game succesfully uploaded to the database!</p>";
                }else{
                    echo"<p style='color:red' >Could not upload the game to the database!</p>";
                }
                
            }
        
            ?>

            </div>
        </form>
    </section>
</body>

</html>