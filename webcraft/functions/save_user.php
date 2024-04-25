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
    $rank = $_POST['rank'];
    $designation = $_POST['designation'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($middle_initial)) {
        $middle_initial = $middle_initial . '.';
    }

    if (isset($_POST)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = "user";

        $sql = "INSERT INTO users (first_name, last_name, middle_initial, rank, designation, email, username, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $first_name, $last_name, $middle_initial, $rank, $designation, $email, $username, $hashedPassword, $role);

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
                            <img src='https://drive.google.com/uc?export=view&id=1cMPyfzCR8XWfoJnvIeGlZjsnU_w9XFWW' alt='Logo Right'class='logo'>
                        </div>
                        <div class='message'>
                            <p>Dear $first_name $middle_initial $last_name,</p>
                            <p>Welcome to MedEquip Tracker! We are excited to have you on board.</p>
                            <p>You can now log in to your account using the following credentials:</p>
                            <p><strong>Username:</strong> $username</p>
                            <p><strong>Password:</strong> $password </p>
                            <p>Please keep your login credentials confidential and do not share them with anyone.</p>
                            <p>If you have any questions or need assistance, feel free to reach out to us.</p>
                            <p>Thank you and enjoy using MedEquip Tracker!</p>
                        </div>
                        <div class='footer'>
                            <p>MedEquip Tracker &copy; 2024. All rights reserved.</p>
                        </div>
                    </div>
                </body>
                </html>
                ";

                if ($mail->send()) {
                    header("Location: ../templates/adminPanel/user_list.php?id={$userID}&success_message=New user added successfully.");
                    exit();
                } else {
                    header("Location: ../templates/adminPanel/user_list.php?id={$userID}error_message=Failed to send email.");
                    exit();
                }
            } catch (Exception $e) {
                header("Location: ../templates/adminPanel/user_list.php?id={$userID}&error_message=Error: {$mail->ErrorInfo}");
                exit();
            }
        } else {
            header("Location: ../templates/adminPanel/user_list.php??id={$userID}&error_message=Failed to add new user.");
            exit();
        }
        $stmt->close();
        $conn->close();
    }
}
?>

<!-- *Copyright  © 2024 WebCraft - All Rights Reserved*
    *Administartive Office Facility Reservation and Management System*
    *IT 132 - Software Engineering *
    *(WebCraft) Members:
        Falcatan, Khriz Marr
        Gabotero, Rogie
        Taborada, John Mark
        Tingkasan, Padwa 
        Villares, Arp-J* -->