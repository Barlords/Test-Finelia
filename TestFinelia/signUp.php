<?php
    session_start();
    
    $conn = new mysqli("localhost", "root", "root", "test_finelia");
    if ($conn->connect_errno) {
        echo "Échec lors de la connexion à MySQL : (" . $conn->connect_errno . ") " . $conn->connect_error;
        exit();
    }
    
    $mail = (string) htmlspecialchars($_POST['mail']);
    $password = (string) htmlspecialchars($_POST['password']);
    
    $sql = 'SELECT * FROM etudiants WHERE mail ="'.$mail.'"';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $success = -3;
    }
    else {
        $sql2 = 'INSERT INTO etudiants (`name`,`fname`, `mail`,`password`)'
                . 'VALUES ("'.$_POST['name'].'","'.$_POST['fname'].'","'.$_POST['mail'].'","'.$_POST['password'].'")';
        $result2 = mysqli_query($conn, $sql2);
        $success = 1;  
    }
    $_SESSION["success"] = $success;
    header('Location: index.php');
    
?>

