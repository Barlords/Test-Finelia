<?php
    session_start();
    
    $conn = new mysqli("localhost", "root", "root", "test_finelia");
    if ($conn->connect_errno) {
        echo "Échec lors de la connexion à MySQL : (" . $conn->connect_errno . ") " . $conn->connect_error;
        exit();
    }
    $user = $_SESSION["user"];
    $sql = 'SELECT * FROM matieres ORDER BY `name`';
    $result = mysqli_query($conn, $sql);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style.css">
        <title>Ajout d'une note</title>
    </head>
    <body>
        <div class="wrapper2">
            <div class="flex-item flex-container">
                <form method="post" action="menu.php">
                    <input type="submit" class="aClient" value="Retour au menu">
                </form>
                <form method="post" action="consultationNote.php">
                    <input type="submit" class="aClient" value="Consulter mes notes">
                </form>
            </div>
            <form class="formPlan" name="note" method="post" action="insertNote.php">
                <input type="number" name="value" required="true" placeholder="Votre note">
                <input type="number" name="max" required="true" placeholder="Barême">
                <input type="number" name="coefficient" required="true" placeholder="Coefficient">
                <select name="id_matiere" required="true">
                    <option value="">--Sélectionner une matière--</option>
                    <?php  
                        while($row = mysqli_fetch_assoc($result)){
                    ?>                    
                    <option value="<?php echo $row["id_matiere"] ?>"> <?php echo $row["name"] ?> </option>
                    <?php } ?> 
                </select>
                <input class="btnReserver" type="submit" value="AJOUTER">
                <input type="hidden" name="id_etudiant" value="<?php echo $user["id_etudiant"] ?>">
            </form>
            <?php if($_SESSION["success"] == -1) { ?>
            <div class="error">
                ERROR : la note ne peut pas être supérieur au barême
            </div>
            <?php } ?>
        </div>
    </body>
</html>

