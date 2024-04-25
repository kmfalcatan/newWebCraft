<?php
include "dbConfig/dbconnect.php";
$email = isset($_GET['email']) ? $_GET['email'] : '';
$storedCode = isset($_GET['code']) ? $_GET['code'] : '';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    if (strlen($newPassword) < 6) {
        $error = "Password must be at least 6 characters long.";
    } elseif (!preg_match("/[A-Z]/", $newPassword) || !preg_match("/[a-z]/", $newPassword) || !preg_match("/[0-9]/", $newPassword) || !preg_match("/[^a-zA-Z0-9]/", $newPassword)) {
        $error = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
    } elseif ($newPassword !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE email = ? AND code = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $hashedPassword, $email, $storedCode);
        if ($stmt->execute()) {
            header("Location: password_updated.php");
            exit();
        } else {
            $error = "Error updating password. Please try again.";
        }
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
    <div class="newPassword">
        <form class="cvContent"  method="post" action="">
            <div class="cvText">
                <h1>New Password</h1>
                <div class="cvText2">
                    <p>Please create a new password that you <br>don't use an any other site.</p> 
                </div>
            </div>

            <?php if (!empty($error)) { ?>
                <div class="error"><?php echo $error; ?></div>
            <?php } ?>

            <div class="npInput">
                <input type="password" name="password" placeholder="Enter your new password" required>
                <input type="password" name="confirm_password" placeholder="Confirm your password" required>
            </div>

            <div class="fpBtn">
                <button type="submit">Continue</button>
            </div>

            <div class="backLink">
                <a href="code_verification.php?email=<?php echo $email ?>">
                    <p>Back to previous page</p>
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