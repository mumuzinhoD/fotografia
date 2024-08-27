<?php
    $serverName = "localhost";
    $userName= "root";
    $passWord = "";
    $db_name = "fotografia";

    $connect = mysqli_connect($serverName, $userName, $passWord, $db_name);
    mysqli_set_charset($connect, "utf8");

    if(mysqli_connect_error()) :
        echo "Erro na conexão: " . mysqli_connect_error();    

    endif;
    ?>
