<?php
require 'vendor/autoload.php'; // Include the PHPMailer library

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the email from the request
  $email = $_POST['email'];

  // Generate a random password reset token
  $resetToken = generateRandomToken();

  // Update your database with the reset token and set the expiration time

  // Send the reset password email
  try {
    // Create a new PHPMailer instance
    $mail = new PHPMailer();

    // Configure the SMTP settings for Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587; // For TLS
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'collabhub0@gmail.com'; // Your Gmail email address
    $mail->Password = 'collab123'; // Your Gmail password

    // Set the From and Reply-To addresses
    $mail->setFrom('collabhub0@gmail.com');
    $mail->addReplyTo('collabhub0@gmail.com');

    // Set the email recipient
    $mail->addAddress($email);

    // Set the email subject and body
    $mail->Subject = 'Password Reset';
    $mail->Body = 'Please click the following link to reset your password: https://your_website.com/reset-password?token=' . $resetToken;

    // Send the email
    if ($mail->send()) {
      // Output a success message
      echo 'Password reset email sent successfully.';
    } else {
      // Output an error message
      echo 'An error occurred while sending the email: ' . $mail->ErrorInfo;
    }
  } catch (Exception $e) {
    // Output an error message
    echo 'An error occurred while sending the email: ' . $e->getMessage();
  }
} else {
  // Output an error message for invalid request method
  echo 'Invalid request method.';
}

// Function to generate a random password reset token
function generateRandomToken($length = 32) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $token = '';

  for ($i = 0; $i < $length; $i++) {
    $token .= $characters[rand(0, strlen($characters) - 1)];
  }

  return $token;
}
