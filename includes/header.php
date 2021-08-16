<?php
    include 'includes/head.php';
?>
<header>
    <div class="container">
        <?php
        if (!isset($_SESSION['sessionId'])) {
        ?>
    <nav class="navbar">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="index.php">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        </ul>
    </nav>
        <?php
        }
        if ($_SESSION['sessionId'] == "admin@gmail.com") {?>
            <nav class="navbar">
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="post-creation.php">Create a post</a></li>
                </ul>
            </nav>
          <?php
        }
        ?>
    </div>
</header>