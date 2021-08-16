<?php

class DBConnection
{
    private $conn;

    // object properties
    public $title;
    public $content;
    public $createdAt;
    public $row;
    public $creat_row;
    public $row_at;
    public $postsSorting;

    public $postTitle;
    public $postContent;
    public $postCreatedAt;

    public function __construct($db) {
        $this->conn = $db;
    }


    public function postCreation($tableName, $postTitle, $postContent) {



        $query = "INSERT INTO " . $tableName . " (title, content) VALUES (?,?)";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            header("Location: ../post-creation.php?addpost=sqlerror");
            exit();
        } else {
            $stmt->bindParam(1, $postTitle);
            $stmt->bindParam(2, $postContent);
            $stmt->execute();
            header("Location: ../posts-list.php?addpost=success");
            exit();
        }

    }

    public function showAllPosts($tableName, $sortingType) {

        $query = "SELECT
                    title, content, createdAt
                FROM
                    " . $tableName . "
                ORDER BY
                    " . $sortingType . " ASC ";
/*        $query = "SELECT
                    title, content, createdAt
                FROM
                    " . $tableName . "
                ORDER BY
                    title ASC ";*/

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }




    public function checkUserData($table_name, $formEmail)
    {
        $query = "SELECT *
                FROM
                    " . $table_name . "
                WHERE email = ?";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }else {
            $stmt->bindParam(1, $formEmail);
            $stmt->execute();
            $this->row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $this->row;
        }
    }



    public function registerNewUser($table_name, $formFirstName, $formEmail, $formPass)
    {
        $query = "SELECT *
                FROM
                    " . $table_name . "
                WHERE email = ?";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }else {
            $stmt->bindParam(1, $formEmail);
            $stmt->execute();
            $this->creat_row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($this->creat_row > 0 ){
                header("Location: ../register.php?registration=emailtaken");
                exit();
            }else {
                $query = "INSERT INTO " . $table_name . " (firstName, email, password) VALUES (?,?,?)";
                $stmt = $this->conn->prepare($query);
                if (!$stmt) {
                    header("Location: ../register.php?registration=sqlerror");
                    exit();
                } else {
                    $hashedPass = password_hash($formPass, PASSWORD_DEFAULT);

                    $stmt->bindParam(1, $formFirstName);
                    $stmt->bindParam(2, $formEmail);
                    $stmt->bindParam(3, $hashedPass);
                    $stmt->execute();
                    header("Location: ../register.php?registration=success");
                    exit();
                }
            }


        }
    }

    public function getPostByDate($table_name, $createdAt)
    {
        $query = "SELECT *
                FROM
                    " . $table_name . "
                WHERE createdAt = ?";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }else {
            $stmt->bindParam(1, $createdAt);
            $stmt->execute();
            $this->row_at = $stmt->fetch(PDO::FETCH_ASSOC);
            return $this->row_at;
        }
    }



    public function postUpdating($table_name)
    {
        $query = "UPDATE " . $table_name . "
                SET
                title = :title,
                content = :content
                WHERE createdAt = :createdAt";

        // prepare request
        $stmt = $this->conn->prepare($query);
        // cleaning
        $this->postTitle=htmlspecialchars(strip_tags($this->postTitle));
        $this->postContent=htmlspecialchars(strip_tags($this->postContent));
        $this->postCreatedAt=htmlspecialchars(strip_tags($this->postCreatedAt));

        // value binding
        $stmt->bindParam(':title', $this->postTitle);
        $stmt->bindParam(':content', $this->postContent);
        $stmt->bindParam(':createdAt', $this->postCreatedAt);

        // execute the request
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
