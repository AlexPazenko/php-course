<?php

    include 'includes/header.php';
if (isset($_SESSION['sessionId']) &&  $_SESSION['sessionId'] == "admin@gmail.com") {
    if (isset($_GET['editpost'])) {
        $createdAt = $_GET['editpost'];
        $formLink = "includes/edit-post-inc.php";
        include_once 'includes/Database.php';
        include_once 'includes/DBConnection.php';

// connection to the database
        $database = new Database();
        $db = $database->getConnection();
        $dbConnection = new DBConnection($db);
        $table_name = "posts";
        $row = $dbConnection->getPostByDate($table_name, $createdAt);

    } else {
        $formLink = "includes/post-creation-inc.php";
    }
?>

    <div class="container">
        <h3>Post creation form</h3>

        <form action="<?php echo $formLink; ?>" method="post" value>
            <?php
            if (isset($_GET['editpost'])) {
                echo '<input type="text" name="title" placeholder="Title" value="'. $row['title'] .'">';
                echo '<textarea name="content">'.$row['content'].'</textarea>';
                echo '<input type="hidden" name="createdAt" value="'. $row['createdAt'] .'">';
            } else {
                echo '<input type="text" name="title" placeholder="Title">';
                echo '<textarea name="content"></textarea>';
            }
            ?>
            <button type="submit" name="save" class="btn btn-dark">Save</button>
        </form>
        <?php
        if (!isset($_GET['addpost'])) {
            exit();
        } else {
            $errorCheck = $_GET['addpost'];

            if ($errorCheck == "sqlerror") {
                echo "<div class='alert alert-danger'>Error connecting to database.</div>";
            } elseif ($errorCheck == "success") {
                echo "<div class='alert alert-success'>The post was successfully created.</div>";
            }
        }
        ?>
    </div>
<?php
} else {
    ?>
    <div class="container">
        <div class='alert alert-danger'>Only the admin can create posts!</div>
    </div>
<?php
}
include 'includes/footer.php';

?>