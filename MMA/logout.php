<?php 
    SESSION_start();
    SESSION_destroy();
    if(isset($_SESSION['nome'])){
        header("location: /index.php");
    }