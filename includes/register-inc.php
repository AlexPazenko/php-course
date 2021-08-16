<?php

    if(isset($_POST['submit'])) {

        include_once 'Database.php';
        include_once 'DBConnection.php';

        $database = new Database();
        $db = $database->getConnection();
        $dbConnection = new DBConnection($db);
        $table_name = "users";

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);


        $firstName = trim($_POST['firstName']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        //First name rule for preg_match function
        $firstNameRule = '/^[a-zA-Z0-9_-]*$/';

        //Password rules for preg_match function
        $passwordRule1 = "/^[a-zA-Z0-9-_]{8,}$/";
        $passwordRule2 = "/[A-Z]{1,}/";
        $passwordRule3 = "/[0-9]{1,}/";


        if (empty($firstName) && empty($email) && empty($password)) {
            header("Location: ../register.php?registration=emptyfields");
            exit();
        }
        if (empty($firstName) && empty($email)) {
            header("Location: ../register.php?registration=emptyfields");
            exit();
        }
        if (empty($firstName) && !empty($email)) {
            header("Location: ../register.php?registration=emptyfirstname&email=$email");
            exit();
        }
        if (empty($email) && !empty($firstName)) {
            header("Location: ../register.php?registration=emptyemail&firstName=$firstName");
            exit();
        }
        if (empty($password) && !empty($firstName) && !empty($email)) {
            header("Location: ../register.php?registration=emptypassword&firstName=$firstName&email=$email");
            exit();
        }
        if (!preg_match($firstNameRule, $firstName) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../register.php?registration=invalidfirstname&firstName=$firstName&email=$email");
            exit();
        }
        if (preg_match($firstNameRule, $firstName) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../register.php?registration=invalidemail&firstName=$firstName");
            exit();
        }
        if (!preg_match($firstNameRule, $firstName) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../register.php?registration=invalidfields");
            exit();
        }
        if (!preg_match($passwordRule1, $password)) {
            header("Location: ../register.php?registration=invalidpassword&firstName=$firstName&email=$email");
            exit();
        }
        if (!preg_match($passwordRule2, $password)) {
            header("Location: ../register.php?registration=invalidpassword&firstName=$firstName&email=$email");
            exit();
        }
        if (!preg_match($passwordRule3, $password)) {
            header("Location: ../register.php?registration=invalidpassword&firstName=$firstName&email=$email");
            exit();
        }else {

            $dbConnection->registerNewUser($table_name, $firstName, $email, $password);

        }
    }
?>