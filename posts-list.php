<?php
include_once 'includes/header.php';
if ($_SESSION['sessionId'] != "admin@gmail.com") {?>
 <style>
     a.edit-post { display: none; }
</style>
<?php
}
if (isset($_SESSION['sessionId'])) {
    include_once 'includes/Database.php';
    include_once 'includes/DBConnection.php';

// connection to the database
$database = new Database();
$db = $database->getConnection();
$dbConnection = new DBConnection($db);
$table_name = "posts";

    if (isset($_GET['postssorting']) == "date") {
        $sortingButton = '';
        $sortingType = "createdAt";
    } else {
        $sortingButton = '<a href="posts-list.php?postssorting=date" type="button" class="btn btn-info">Sort by date</a>';
        $sortingType = "title";
    }
?>

<div class="container">

    <h3>All posts</h3>
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 'loggedin') {
       echo '<div class="alert alert-success">Hello '. $_SESSION['sessionUser'] .'!</div>';
    }

    if (isset($_GET['postediting']) && $_GET['postediting'] == 'success') {
        echo '<div class="alert alert-success">The post was successfully updated!</div>';
    } elseif (isset($_GET['postediting']) && $_GET['postediting'] == 'sqlerror') {
        echo '<div class="alert alert-warning">Sorry. The post could not be updated.</div>';
    } elseif (isset($_GET['addpost']) && $_GET['addpost'] == 'success') {
        echo '<div class="alert alert-success">The post was successfully created.</div>';
    }

    ?>
    <div class="button-block">
        <?php echo $sortingButton;?>
    </div>
    <?php

        $stmt = $dbConnection->showAllPosts($table_name, $sortingType);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo ' <div class="well" >
                    <div class="media" >
                        <div class="media-body" >
                            <h4 class="media-heading" > '. $title .'</h4 >
                            <p > '. $content .'</p >
                            <ul class="list-inline list-unstyled" >
                                <li ><span > '. $createdAt .'</span ></li >
                            </ul >
                            <a href="post-creation.php?editpost='. $createdAt .'" type="button" class="btn btn-success edit-post">Eddit</a>
                        </div >
                    </div >
                </div > ';
            }
    ?>
<div class="button-block"><a href="includes/logout.php" class="btn btn-secondary btn-lg logout-button">LogOut</a></div>
</div>
<?php
}else {
    ?>
    <div class="container">
        <div class='alert alert-danger'>Please log in to see a list of posts.</div>
    </div>
<?php
}
include_once 'includes/footer.php';
?>