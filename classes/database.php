<?php
class database
{

    public static $error;

    public static function connect()
    {
        $servername = "localhost";
        $username = "Loginservice";
        $password = "login";
        $dbname = "login";

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $pdo;
        } catch (PDOException $e) {
            self::$error = $e->getMessage();
            return self::$error;
        }
    }
    public static function adduser($username, $password)
    {
        $database = self::connect();
        try {
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
            $statement = $database->prepare($sql);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $hashedpassword);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            self::$error = $e->getMessage();
            return self::$error;
        }
    }
    public static function login($username, $password)
    {
        $database = self::connect();
        try {
            $sql = "SELECT * FROM user WHERE username = :username";
            $statement = $database->prepare($sql);
            $statement->bindParam(':username', $username);
            $statement->execute();
            $result = $statement->fetch();
            if ($result && password_verify($password, $result['password'])) {
                if ($result['admin'] == 1) {
                    $_SESSION['admin'] = true;
                    return $result;
                } else {
                    $_SESSION['admin'] = false;
                    if ($result) {
                        return $result;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            self::$error = $e->getMessage();
            return self::$error;
        }
    }
    public static function getallacounts()
    {
        $database = self::connect();
        try {
            $sql = "SELECT * FROM user";
            $statement = $database->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $acounts = null;
            foreach ($result as $acount) {
                $acounts .= "<p>$acount[username]</p>";
                $acounts .= "<a href='functiononly_pages/delete.php?username=$acount[username]'>Delete</a> <br> <br>";
                if ($acount['admin'] == 0) {
                    $acounts .= "<a href='functiononly_pages/promote.php?username=$acount[username]'>Promote</a> <br> <br>";
                }
            }
            return $acounts;
        } catch (PDOException $e) {
            self::$error = $e->getMessage();
            return self::$error;
        }
    }
    public static function deleteacount($username)
    {
        $database = self::connect();
        try {
            $sql = "DELETE FROM user WHERE username = :username";
            $statement = $database->prepare($sql);
            $statement->bindParam(':username', $username);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            self::$error = $e->getMessage();
            return self::$error;
        }
    }
    public static function promoteacount($username)
    {
        $database = self::connect();
        try {
            $sql = "UPDATE user SET admin = 1 WHERE username = :username";
            $statement = $database->prepare($sql);
            $statement->bindParam(':username', $username);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            self::$error = $e->getMessage();
            return self::$error;
        }
    }

    public static function searchacounts($search)
    {
        $database = self::connect();
        try {
            $search = "%$search%";
            $sql = "SELECT * FROM user WHERE username LIKE :search";
            $statement = $database->prepare($sql);
            $statement->bindParam(':search', $search);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        } catch (PDOException $e) {
            self::$error = $e->getMessage();
            return self::$error;
        }
    }
}