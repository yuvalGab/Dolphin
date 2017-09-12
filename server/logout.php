<?php 

    //delete user set cookies
    setcookie("username", null, -1, "/dolphin");
    setcookie("permission", null, -1, "/dolphin");
    header("Location: /dolphin/");
