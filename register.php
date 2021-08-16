<?php
include 'includes/header.php';
?>
    <div class="container">
        <h1>Register</h1>
        <p>Already have an account? <a href="index.php">Login!</a></p>
        <form action="includes/register-inc.php" method="post">

            <?php
            if (isset($_GET['firstName'])) {
                $firstName = $_GET['firstName'];
                echo '<input type="text" name="firstName" placeholder="Firstname" value="'. $firstName .'">';
            } else {
                echo '<input type="text" name="firstName" placeholder="Firstname">';
            }
            if (isset($_GET['email'])) {
                $email = $_GET['email'];
                echo '<input type="text" name="email" placeholder="E-mail" value="'. $email .'">';
            } else {
                echo '<input type="text" name="email" placeholder="E-mail">';
            }
            ?>
            <input type="password" name="password" placeholder="Password">
            <button type="submit" name="submit" class="btn btn-dark">REGISTER</button>
        </form>
        <?php
        if (!isset($_GET['registration'])) {
            exit();
        } else {
            $errorCheck = $_GET['registration'];

            if ($errorCheck == "emptyfields") {
                echo "<div class='alert alert-danger'>Please fill in all fields.</div>";
            } elseif ($errorCheck == "emptyfirstname") {
                echo "<div class='alert alert-danger'>Please fill in the Firstname field.</div>";
            } elseif ($errorCheck == "emptyemail") {
                echo "<div class='alert alert-danger'>Please fill in the E-mail field.</div>";
            } elseif ($errorCheck == "emptypassword") {
                echo "<div class='alert alert-danger'>Please fill in the Password field.</div>";
            } elseif ($errorCheck == "invalidfirstname") {
                echo "<div class='alert alert-danger'>Invalid Firstname.</div>";
            } elseif ($errorCheck == "invalidemail") {
                echo "<div class='alert alert-danger'>Invalid E-mail.</div>";
            } elseif ($errorCheck == "invalidfields") {
                echo "<div class='alert alert-danger'>Invalid Firstname and E-mail fields.</div>";
            } elseif ($errorCheck == "invalidpassword") {
                echo "<div class='alert alert-danger'>The password must be in Latin only.<br>Must contain at least 8 characters, 1 uppercase letter and 1 number.</div>";
            } elseif ($errorCheck == "emailtaken") {
                echo '<div class="alert alert-danger">This email is already in the database.<br>Please specify another or <a href="index.php">log in</a>.</div>';
            } elseif ($errorCheck == "sqlerror") {
                echo "<div class='alert alert-danger'>Error connecting to database.</div>";
            } elseif ($errorCheck == "success") {
                echo "<div class='alert alert-success'>Registration was successful.</div>";
            }
        }
        ?>
    </div>
<?php
include 'includes/footer.php';
?>