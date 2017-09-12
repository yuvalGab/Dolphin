<?php 

    include "database.php";

    //check if the username and password are correct
    $username = $_POST['user'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM editors WHERE username = :user;";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':user' => $username));
    $result = $stmt->fetchAll();
    
    if (!$result) {
        echo "שם משתמש לא קיים";
    } else {
        if (password_verify($password, $result[0]["password"])) {
            if ($result[0]["username"] == $username) { 
                echo "כניסה";
                setcookie("username", $username, time()+60*60*24*30, "/dolphin", "", 0);
                if($result[0]['permission'] == 1) {
                    setcookie("permission", 'admin', time()+60*60*24*30, "/dolphin", "", 0);
                }
            } else {
               echo "שם משתמש לא קיים"; 
            }
        } else {
            echo "סיסמה לא נכונה";
        }
    }