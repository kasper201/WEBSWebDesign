<?php
// I am ignoring getArr on purpose for more safe queries
if(isset($_POST['login']))
{
    include 'getMysqli.php';
    $mysqli = getMysqli();

} elseif(isset($_POST['register'])) {
    include 'getMysqli.php';
    $mysqli = getMysqli();
    $processLogin = new processLogin($mysqli);
    $e = $processLogin->createUser($_POST['email'], $_POST['password']);
    if($e === 0)
    {
        echo '<script>window.location.href = "./Main.php";</script>';
    }
    else
    {
        echo "<script>alert('Failed to create user');</script>";
        echo '<script>window.location.href = "./Login.php";</script>';
    }
}

class processLogin
{
    private $mysqli;

    private function __contruct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    private function __destruct()
    {
        $this->mysqli->close();
    }

    private function loginQuery($email, $password)
    {
        $query = "SELECT * FROM User WHERE Email = ? AND Password = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function loginUser($email, $password)
    {
        if($this->loginQuery($email, $password))
        {
            echo "<script>console.log('Logged in');</script>";
            echo "<script>localStorage.setItem('username', '$email');</script>";
            return 0;
        }
        else
        {
            echo "<script>console.log('Failed to login');</script>";
            return 1;
        }
    }

    private function createQuery($username, $password)
    {
        $query = "INSERT INTO User ()";
    }

    public function createUser($username, $password)
    {
        echo "<script>console.log('$username');</script>";


        echo "<script>localStorage.setItem('username', '$username');</script>";
        return 0;
    }
}