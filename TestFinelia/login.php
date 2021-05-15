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
        $row = mysqli_fetch_assoc($result);
        if(strlen($password) == strlen($row["password"]) && (string) $password == (string) $row["password"]) {
            //password valide
            $_SESSION["user"] = $row;
            $success = 1;
            $_SESSION["success"] = $success;
            header('Location: menu.php');
        }
        else {
            //password invalide
            $success = -1;
            $_SESSION["success"] = $success;
            header('Location: index.php');
        }   
    }
    else {
        //compte inexistant
        $success = -2;
        $_SESSION["success"] = $success;
        header('Location: index.php');
    }
    
?>
