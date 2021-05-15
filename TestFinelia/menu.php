<?php
    session_start();
    
    $conn = new mysqli("localhost", "root", "root", "test_finelia");
    if ($conn->connect_errno) {
        echo "Échec lors de la connexion à MySQL : (" . $conn->connect_errno . ") " . $conn->connect_error;
        exit();
    }
    $user = $_SESSION["user"];
    $sql = 'SELECT * FROM notes WHERE etudiant = '.$user["id_etudiant"];
    $result = mysqli_query($conn, $sql);
    
    $_SESSION["success"] = 1;
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style.css">
        <title>Home</title>
    </head>
    <body>
        <div id ="containerClient">
            <div class="wrapper">
                <h1>Bonjour <?php echo $user["name"]; ?>, tu as de nouvelles notes ?</h1>
                <div class="flex-container flex-container-style fixed-height">
                    <div class="flex-item">
                        <form method="post" action="addNote.php">   
                            <input type="hidden" name= "button" value="addNote">
                            <input type ="submit" class="aClient" value="Ajouter une note">
                        </form>
                        <form method="post" action="consultationNote.php">
                            <input type="hidden" name= "button" value="consultNote">
                            <input type ="submit" class ="aClient" value="Consulter mes notes">
                        </form>
                    </div>
                    <h4 id="menuItem">Voici vos dernières notes :</h4>
                    <div class="slideshow-container">
                        <?php 
                            if($row = mysqli_fetch_assoc($result)){ ?>
                        <div class="mySlides fade">
                            <div class="numbertext">1 / 3</div>
                            <div class="text"><?php echo $row["value"]."/".$row["max"] ; ?></div>
                        </div>
                        <?php }
                            if($row = mysqli_fetch_assoc($result)){?>
                        <div class="mySlides fade">
                            <div class="numbertext">2 / 3</div>
                            <div class="text"><?php echo $row["value"]."/".$row["max"] ; ?></div>
                        </div>
                        <?php } 
                            if($row = mysqli_fetch_assoc($result)){?>
                        <div class="mySlides fade">
                            <div class="numbertext">3 / 3</div>
                            <div class="text"><?php echo $row["value"]."/".$row["max"] ; ?></div>
                        </div>
                        <?php } ?>
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    </div>
                    <br>
                    <div style="text-align:center">
                        <span class="dot" onclick="currentSlide(1)"></span>
                        <span class="dot" onclick="currentSlide(2)"></span>
                        <span class="dot" onclick="currentSlide(3)"></span>
                    </div>
                </div>
                <br>
                <div class="flex-container flex-container-style fixed-height">
                    <a href="index.php">Se déconnecter</a>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="slider.js"></script>
</html>

