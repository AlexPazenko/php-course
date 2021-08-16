<?php

if(isset($_POST['save'])) {

    include_once 'Database.php';
    include_once 'DBConnection.php';

    $database = new Database();
    $db = $database->getConnection();
    $dbConnection = new DBConnection($db);
    $table_name = "posts";

    $postTitle = $_POST['title'];
    $postContent = $_POST['content'];

    $dbConnection->postCreation($table_name, $postTitle, $postContent);

}
?>