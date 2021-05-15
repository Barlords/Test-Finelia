<?php
    session_start();
    
    $conn = new mysqli("localhost", "root", "root", "test_finelia");
    if ($conn->connect_errno) {
        echo "Échec lors de la connexion à MySQL : (" . $conn->connect_errno . ") " . $conn->connect_error;
        exit();
    }
    
    $sql = 'DELETE FROM notes WHERE id_note = '.$_POST['id_note'] ;
    $result = mysqli_query($conn, $sql);
    $success = 1;    
    
    $_SESSION["success"] = $success;
    header('Location: consultationNote.php');
    
?>