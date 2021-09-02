<?php

include "user.php";
try {
    $pdo = new PDO('mysql:host=localhost;dbname=php_course;charset=utf8', 'alex','789555');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*    $sql = "SELECT * FROM users";
    $result = $pdo->query($sql);*/
/*    foreach ($result as $row) {
        echo "<p>" . $row['firstName'] . " | " . $row["email"]. "</p>";
    }*/

    /*$result->setFetchMode(PDO::FETCH_CLASS, 'User');*/
/*    while ($row = $result->fetch( )) {
        /*echo "<p>" . $row['firstName'] . " | " . $row["email"]. "</p>";*/ // FETCH_ASSOC
        /*echo "<p>" . $row[0] . " | " . $row[1]. "</p>";*/ // FETCH_NUM
        /*echo "<p>" . $row->firstName . " | " . $row->password . "</p>";*/ // FETCH_OBJ
        /*echo "<p>" . $row->getFirstName() . " | " . $row->getEmail() . "</p>";*/ // FETCH_CLASS
    /*}*/
/*    $result->setFetchMode(PDO::FETCH_ASSOC);
    print_r($result->fetchAll());*/


/*    $sql = "INSERT INTO users (firstName, email, password) VALUES ('New User', 'new@gmail.com', '123456') ";
    $affected_rows = $pdo->exec($sql);
    echo $affected_rows;*/

$firstName = "New User";
    $sql = "SELECT * FROM users where firstName = ?";
    $result = $pdo->prepare($sql);
    $result->bindParam(1, $firstName);
    $result -> execute();
    print_r($result->fetchAll());

} catch (PDOException $e) {
        echo $e->getMessage();
}

?>