<?php
    include "dbConfig/dbconnect.php";
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once "assets/php-mailer/src/Exception.php";
    require_once "assets/php-mailer/src/PHPMailer.php";
    require_once "assets/php-mailer/src/SMTP.php";
    $error = "";

    function generateRandomCode($length = 6) {
        return mt_rand(pow(10, $length-1), pow(10, $length)-1);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];

        $code = generateRandomCode();

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $updateQuery = "UPDATE users SET code = ? WHERE email = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("ss", $code, $email);
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
                    $mail->Subject = 'Code Verification';
                    $mail->Body = "Your password reset code is: $code";

                    $mail->send();
                    header("Location: code_verification.php?email=" . urlencode($email));
                    exit();
                } catch (Exception $e) {
                    $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                $error = "Error updating code. Please try again later.";
            }
        } else {
            $error = "Email not found. Please enter a valid email.";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/img/medLogo.png">
    <title>MedEquip Tracker</title>

    <link rel="stylesheet" href="assets/css/forgot_pass.css">
</head>
<body>
    <div class="blueBg">
    </div>
    <div class="forgotPassword">
        <form class="fpContent" method="post" action="">
            <div class="fpIcon">
                <img src="assets/img/blue-exclamation.png" alt="">
            </div>

            <div class="fpText">
                <h1>Forgot Password?</h1>
                <p>Enter your email, and we'll send a code to reset your password</p>
            </div>

            <?php if (!empty($error)) { ?>
                <div class="error"><?php echo $error; ?></div>
            <?php } ?>
            <div class="fpInput">
                <input type="text" name="email" placeholder="Enter your email (e.g. example@gmail.com)" required>
            </div>

            <div class="fpBtn">
                <button type="submit">Submit</button>
            </div>

            <div class="backLink">
                <a href="../webcraft/authentication/signin.php">
                    <p>Back to sign in</p>
                </a>
            </div>
        </form>
    </div>

    <footer>
        <div class="footerImg">
            <img src="assets/img/medLogo.png" alt="">
        </div>
        <div class="footerTxt">
            <p>Software Engineering Project   |    Copyright  ©  2024  WebCraft</p>
        </div>
    </footer>
</body>
</html>

<!-- *Copyright  © 2024 WebCraft - All Rights Reserved*
        *Administartive Office Facility Reservation and Management System*
        *IT 132 - Software Engineering *
        *(WebCraft) Members:
            Falcatan, Khriz Marr
            Gabotero, Rogie
            Taborada, John Mark
            Tingkasan, Padwa 
            Villares, Arp-J* -->