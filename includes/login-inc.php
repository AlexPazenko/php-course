<?php


if (isset($_POST['submit'])) {
    include_once 'Database.php';
    include_once 'DBConnection.php';

    $database = new Database();
    $db = $database->getConnection();
    $dbConnection = new DBConnection($db);
    $table_name = "users";

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) && empty($password)) {
        header("Location: ../index.php?error=emptyemailpassword");
        exit();
    }
    if (empty($email)) {
        header("Location: ../index.php?error=emptyemail");
        exit();
    }
    if (empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?error=emptypassword&email=$email");
        exit();
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?error=invalidemail&email=$email");
        exit();
    }
    if (!preg_match('/^[a-zA-Z0-9-_]*$/', $password)) {
        header("Location: ../index.php?error=invalidpassword&email=$email");
        exit();
    } else {
        $row = $dbConnection->checkUserData($table_name, $email);
        if ($row) {
            $passCheck = password_verify($password, $row['password']);
            if ($passCheck == true) {
                session_start();
                $_SESSION['sessionId'] = $row['email'];
                $_SESSION['sessionUser'] = $row['firstName'];
                header("Location: ../posts-list.php?success=loggedin");
                exit();
            } else {
                header("Location: ../index.php?error=wrongpass&email=$email");
                exit();
            }
        } else {
            header("Location: ../index.php?error=noemail&email=$email");
            exit();
        }


    }

} else {
    header("Location: ../index.php?error=accessforbidden");
    exit();
}
?>