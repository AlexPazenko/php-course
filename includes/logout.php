<?php
    session_start();
    unset($_SESSION['sessionId']);
    header("Location: ../index.php");
?>