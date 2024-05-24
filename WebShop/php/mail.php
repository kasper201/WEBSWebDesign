<?php
$email = $_POST['email'];

$subject = "Account Confirmation";
$message = "Thank you for creating an account!\n\n";
$headers = "From: kasperjnssen@gmail.com";

// Send the email
if(mail($email, $subject, $message, $headers)) {
    echo "Email successfully sent to $email";
} else {
    echo "Email sending failed";
    error_log("Email sending failed");
}