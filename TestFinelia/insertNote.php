<?php
    session_start();
    
    $conn = new mysqli("localhost", "root", "root", "test_finelia");
    if ($conn->connect_errno) {
        echo "Échec lors de la connexion à MySQL : (" . $conn->connect_errno . ") " . $conn->connect_error;
        exit();
    }
    
    if($_POST['value'] > $_POST['max']) {
        $success = -1;
    }
    else {
        $sql = 'INSERT INTO notes (`value`,`max`,`coefficient`,`matiere`,`etudiant`)'
                . 'VALUES ('.$_POST['value'].','.$_POST['max'].','.$_POST['coefficient'].','.$_POST['id_matiere'].','.$_POST['id_etudiant'].')';
        $result = mysqli_query($conn, $sql);
        $success = 1;    
    }
    $_SESSION["success"] = $success;
    header('Location: addNote.php');
    
?>