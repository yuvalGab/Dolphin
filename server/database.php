<?php

    //database connection
    $db = new PDO('mysql:host=localhost;dbname=dolphin;charset=utf8', 'root' , 'yuval762db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
