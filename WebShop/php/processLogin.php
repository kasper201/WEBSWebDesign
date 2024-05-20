<?php
include 'getArr.php';

if(preg_match('/[\'^*()}{#~><>,|=¬]/', $_POST['email']) || preg_match('/[\'^*()}{#~><>,|=¬]/', $_POST['password']))
{
    echo "<script>alert('Invalid characters in input field');</script>";
    echo '<script>window.location.href = "./Login.php";</script>';
    exit;
}
if(isset($_POST['login']))
{
    include 'getMysqli.php';
    $mysqli = getMysqli();
    $processLogin = new processLogin($mysqli);
    $e = $processLogin->loginUser($_POST['email'], $_POST['password']);
    if($e === 0)
    {
        echo '<script>localStorage.setItem("username", "' . $_POST['email'] . '");</script>';
        echo '<script>window.location.href = "./Main.php";</script>';
        exit;
    }
    else
    {
        echo '<script>localStorage.setItem("username", "' . $_POST['email'] . '");</script>';
        echo "<script>alert('Failed to login');</script>";
        echo '<script>window.location.href = "./Login.php";</script>';
        exit;
    }

} elseif(isset($_POST['register'])) {
    include 'getMysqli.php';
    $mysqli = getMysqli();
    $processLogin = new processLogin($mysqli);
    $e = $processLogin->createUser($_POST['email'], $_POST['password']);
    if($e === 0)
    {
        echo '<script>window.location.href = "./Main.php";</script>';
        exit;
    }
    else
    {
        echo '<script>window.location.href = "./Login.php";</script>';
        exit;
    }
}

class processLogin
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    private function encrypt($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function getID($email)
    {
        $query = "SELECT ID FROM User WHERE Email = '$email'";
        $arr = getArr($query, $this->mysqli);
        return $arr[0]['ID'];
    }

    private function loginQuery($email, $password)
    {
        $encryptedEmail = $this->encrypt($email);
        $encryptedPassword = $this->encrypt($password);
        $query = "SELECT * FROM User WHERE Email = $encryptedPassword AND Password = $encryptedEmail";
        return getArr($query, $this->mysqli);
    }

    public function loginUser($email, $password)
    {
        if ($this->loginQuery($email, $password)) {
            echo "<script>console.log('Logged in');</script>";
            echo "<script>localStorage.setItem('username', '$email');</script>";
            return 0;
        } else {
            echo "<script>console.log('Failed to login');</script>";
            return 1;
        }
    }

    private function createQuery($username, $password)
    {
        $encryptedPassword = $this->encrypt($password);
        $query = "CALL AddUser('$encryptedPassword', '$username');";
        return getArr($query, $this->mysqli);
    }

    private function checkUser($email)
    {
        $query = "SELECT * FROM User WHERE Email = '$email'";
        $arr = getArr($query, $this->mysqli);
        if($arr) {
            return 1;
        } else{
            return 0;
        }
    }

    public function createUser($username, $password)
    {
        if ($this->checkUser($username)) {
            echo "<script>console.log('User already exists');</script>";
            echo "<script>alert('User already exists');</script>";
            return 1;
        }

        $this->createQuery($username, $password);

        echo "<script>console.log('User created');</script>";
        setcookie('user', $this->getID($username), time() + (86400 * 30), "/");
        return 0;
    }
}