<?php

    include 'includes/header.php';

?>

    <div class="container">
        <h1>Log in</h1>
        <p>No account? <a href="register.php">Register here!</a></p>
        <form action="includes/login-inc.php" method="post">
            <?php
                if (isset($_GET['email'])) {
                    $email = $_GET['email'];
                    echo '<input type="text" name="email" placeholder="E-mail" value="'. $email .'">';
                } else {
                    echo '<input type="text" name="email" placeholder="E-mail">';
                }
            ?>
            <input type="password" name="password" placeholder="Password">
            <button type="submit" name="submit" class="btn btn-dark">LOGIN</button>
        </form>
        <?php
            if (!isset($_GET['error'])) {
                exit();
            } else {
                $errorCheck = $_GET['error'];

                if ($errorCheck == "emptyemail") {
                    echo "<div class='alert alert-danger'>Empty E-mail field.</div>";
                } elseif ($errorCheck == "emptypassword") {
                    echo "<div class='alert alert-danger'>Empty Password field.</div>";
                } elseif ($errorCheck == "emptyemailpassword") {
                    echo "<div class='alert alert-danger'>Empty E-mail and Password fields.</div>";
                } elseif ($errorCheck == "invalidemail") {
                    echo "<div class='alert alert-danger'>Invalid E-mail.</div>";
                } elseif ($errorCheck == "invalidpassword") {
                    echo "<div class='alert alert-danger'>Invalid Password.<br>The password can contain uppercase and lowercase Latin letters, numbers and symbols '-', '_'.</div>";
                } elseif ($errorCheck == "noemail") {
                    echo '<div class="alert alert-danger">There are no users with this email.<br>Please specify another or <a href="register.php">register here</a>.</div>';
                } elseif ($errorCheck == "wrongpass") {
                    echo "<div class='alert alert-danger'>Wrong password.</div>";
                }
            }
        ?>
    </div>
<?php
include_once 'includes/footer.php';
?>