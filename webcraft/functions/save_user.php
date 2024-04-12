<?php
require_once "../dbConfig/dbconnect.php";
include_once "../authentication/auth.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "../assets/php-mailer/src/Exception.php";
require_once "../assets/php-mailer/src/PHPMailer.php";
require_once "../assets/php-mailer/src/SMTP.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_initial = $_POST['middle_initial'];
    $designation = $_POST['designation'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($_POST)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $role = "user";

    $sql = "INSERT INTO users (first_name, last_name, middle_initial, designation, email, username, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $first_name, $last_name, $middle_initial, $designation, $email, $username, $hashedPassword, $role);

    if ($stmt->execute()) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'pawtingkasan20@gmail.com';
            $mail->Password = 'pxmr fvrz lcgl fwjc';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('pawtingkasan20@gmail.com');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Welcome to MedEquip Tracker';
            $mail->Body = "
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Welcome to MedEquip Tracker</title>
                    <style>
                        :root {
                            font-size: 16px;
                        }
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f2f2f2;
                            margin: 0;
                            padding: 0;
                        }
                        .container {
                            max-width: 31.25rem;
                            margin: 1.25rem auto;
                            padding: 1.25rem;
                            background-color: #ffffff;
                            border-radius: 0.625rem;
                            box-shadow: 0 0 0.625rem rgba(0, 0, 0, 0.1);
                            text-align: justify;
                        }
                        .header {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            margin-bottom: 1.25rem;
                            margin-left: 3.5rem;
                        }
                        .logo {
                            width: auto;
                            height: 4.375rem;
                        }
                        p {
                            font-size: 0.875rem;
                            line-height: 1.6;
                            margin: 0.625rem 0;
                        }

                        strong {
                            font-weight: bold;
                        }

                        .message{
                            border-bottom: 0.0625rem #ccc solid;
                            padding-bottom: 1.25rem;
                        }

                        .header-content {
                            flex-grow: 1;
                            text-align: center;
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <img src='https://drive.google.com/uc?export=view&id=1pTJhLj_6Eqg1l-TwCTQP1q955iNratFX' alt='Logo Left' class='logo'>
                            <div class='header-content'>
                                <p>Western Mindanao State University <br> College of Medicine <br> National Road, Baliwasan, Zamboanga City</p>
                            </div>
                            <img src='https://drive.google.com/uc?export=view&id=1cMPyfzCR8XWfoJnvIeGlZjsnU_w9XFWW' alt='Logo Right' class='logo'>
                        </div>
                        <p>Welcome to MedEquip Tracker, <strong>$first_name $last_name</strong>!</p>
                        <br>
                        <p class='message'>We are delighted to have you as one of our valued end users. By adding you to our system, you are now responsible for managing the units under your name. Should you encounter any issues or have any concerns, please don't hesitate to report them to our administration. We will takeprompt action to address any matters that require attention.</p>
                        <br>
                        <p>Here are your account details:</p>
                        <p>Email: <strong>$username</strong></p>
                        <p>Password: <strong>$password</strong></p>
                        <br>
                        <p>To access your account and continue, please click the following link: <a href='http://localhost/WebCraft-main/WebCraft/landing_page.php'>Login</a></p>
                        <p>Thank you for joining MedEquip Tracker. We look forward to assisting you in managing your units effectively.</p>
                    </div>
                </body>
                </html>
            ";

            $mail->send();
            header("Location: ../templates/adminPanel/user_list.php?id={$userID}");
            exit;
        } catch (Exception $e) {
            echo "Error sending email: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
}
?>