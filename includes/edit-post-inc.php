<?php

if(isset($_POST['save'])) {

    include_once 'Database.php';
    include_once 'DBConnection.php';

    $database = new Database();
    $db = $database->getConnection();
    $dbConnection = new DBConnection($db);
    $table_name = "posts";

    $dbConnection->postTitle = $_POST['title'];
    $dbConnection->postContent = $_POST['content'];
    $dbConnection->postCreatedAt = $_POST['createdAt'];

    $result = $dbConnection->postUpdating($table_name);

    if ($result == true) {
        header("Location: ../posts-list.php?postediting=success");
        exit();
    } else {
        header("Location: ../posts-list.php?error=sqlerror");
        exit();
    }
    var_dump($ttt);

}



?>