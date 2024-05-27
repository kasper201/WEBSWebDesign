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
    if($e == 0)
    {
        echo '<script>window.location.href = "./Main.php";</script>';
        exit;
    }
    else
    {
        echo '<script>window.location.href = "./Login.php";</script>';
        exit;
    }

} elseif(isset($_POST['register'])) {
    include 'getMysqli.php';
    $mysqli = getMysqli();
    $processLogin = new processLogin($mysqli);
    $e = $processLogin->createUser($_POST['email'], $_POST['password']);
    if($e == 0)
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
        $query = "SELECT password FROM User WHERE Email = '$email'";
        $passwordStored = getArr($query, $this->mysqli);
        if (password_verify($password, $passwordStored[0]['password'])) {
            return 1;
        } else {
            return 0;
        }
    }

    public function loginUser($email, $password)
    {
        if ($this->loginQuery($email, $password)) {
            echo "<script>console.log('Logged in');</script>";
            setcookie('user', $this->getID($email) . "-" . strstr($email, '@', true), time() + (86400 * 30), "/");
            return 0;
        } else {
            if($this->getID($email) > 0)
            {
                echo "<script>console.log('Wrong password');</script>";
                echo "<script>alert('Wrong password');</script>";
            }
            else
            {
                echo "<script>console.log('User does not exist');</script>";
                echo "<script>alert('User does not exist');</script>";
            }
            return 1;
        }
    }

    private function createQuery($email, $password)
    {
        $encryptedPassword = $this->encrypt($password);
        $query = "CALL AddUser('$encryptedPassword', '$email');";
        getArr($query, $this->mysqli);
    }

    private function mail($emailIn)
    {
        require '../../vendor/autoload.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.sendgrid.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'apikey'; // this is the SendGrid API Key
        $mail->Password = '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'; // safe(not)
        $mail->SMTPSecure = 'tls'; // use 'ssl' for port 465
        $mail->Port = 587; // use 25 for unencrypted/TLS connections, 465 for SSL connections

        $mail->setFrom('kasperjnssen@gmail.com', 'Kasper Janssen');
        $mail->addAddress($emailIn, 'recipient');
        $mail->isHTML(true);
        $mail->Subject = 'Account Confirmation';
        $mail->Body    = '<strong>Thank you for registering at Kaspers Shop</strong>';
        $mail->AltBody = 'and easy to do anywhere, even with PHP';

        try {
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
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

    public function createUser($email, $password)
    {
        if ($this->checkUser($email)) {
            echo "<script>console.log('User already exists');</script>";
            echo "<script>alert('User already exists');</script>";
            return 1;
        }

        $this->createQuery($email, $password);
        $this->mail($email);

        echo "<script>console.log('User created');</script>";
        echo "<script>console.log('emailed:$email')</script>";
        setcookie('user', $this->getID($email) . "-" . strstr($email, '@', true), time() + (86400 * 30), "/");
        return 0;
    }
}