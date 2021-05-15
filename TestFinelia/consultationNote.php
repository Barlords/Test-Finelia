<?php
    session_start();
    
    $conn = new mysqli("localhost", "root", "root", "test_finelia");
    if ($conn->connect_errno) {
        echo "Échec lors de la connexion à MySQL : (" . $conn->connect_errno . ") " . $conn->connect_error;
        exit();
    }
    
    $user = $_SESSION["user"];
    $moyenne_G = 0;
    $moyenne_max = 0;
    
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style.css">
        <title>Consultation des notes</title>
    </head>
    <body>
        <div class="wrapper2">
            <section class="carousel">
                <div class="flex-item flex-container">
                    <form method="post" action="menu.php">
                        <input type="submit" class="aClient" value="Retour au menu">
                    </form>
                    <form method="post" action="addNote.php">
                        <input type="submit" class="aClient" value="Ajouter une note">
                    </form>
                </div>
                <?php
                $sql = 'SELECT * FROM matieres ORDER BY `name`';
                $result = mysqli_query($conn, $sql);     
                while($row = mysqli_fetch_assoc($result)) {
                    $sql2 = 'SELECT * FROM notes WHERE etudiant = '.$user["id_etudiant"].' AND matiere = '.$row['id_matiere'];
                    $result2 = mysqli_query($conn, $sql2);
                    $total_value = 0;
                    $total_max = 0;
                    while($row2 = mysqli_fetch_assoc($result2)) {
                        $total_value += ($row2['value']/$row2['max']) * 20 * $row2['coefficient'];
                        $total_max += 20*$row2['coefficient'];
                    }
                    if($total_max != 0) {
                        $total_value = round(($total_value/$total_max)*20, 2 , PHP_ROUND_HALF_UP );
                        $moyenne_G += $total_value*$row['coefficient'];
                        $moyenne_max += 20*$row['coefficient'];
                    ?>
                <div class="name_matiere"> <h1> Module : <?php echo $row['name'];  ?> - Moyenne : <?php echo $total_value."/20" ?> - Coefficient : <?php echo $row['coefficient'];  ?> </h1></div>
                <ul class="carousel-items">
                    <?php   
                    $sql2 = 'SELECT * FROM notes WHERE etudiant = '.$user["id_etudiant"].' AND matiere = '.$row['id_matiere'];
                    $result2 = mysqli_query($conn, $sql2);
                    while($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                    <li class="carousel-item">
                        <div class="card">
                            <h2 class="card-title"> <?php echo $row2['value'].'/'.$row2['max']; ?> </h2>
                            <h4 class="card-title"> Coefficient : <?php echo $row2['coefficient']; ?> </h4>
                            <form method="post" action="deleteNote.php">
                                <input type="submit" class="supprNote" value="Supprimer">
                                <input type="hidden" name="id_note" value="<?php echo $row2['id_note']; ?>">
                            </form>
                        </div>
                    </li>
                    <?php } ?> 
                </ul> 
                    <?php }
                    } 
                $moyenne_G = round(($moyenne_G/$moyenne_max)*20, 2 , PHP_ROUND_HALF_UP );
                ?> 
                <div id="moyenne_G"> <h1> Moyenne Générale : <?php echo $moyenne_G ?>/20 </h1></div>
            </section>
        </div>
    </body>
</html>