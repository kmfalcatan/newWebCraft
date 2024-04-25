<?php
    include "dbConfig/dbconnect.php";
    $email = isset($_GET['email']) ? $_GET['email'] : '';
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $enteredCode = $_POST["code"];

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedCode = $row['code'];
            if ($enteredCode == $storedCode) {
                header("Location: new_password.php?email=" . urlencode($email) . "&code=$storedCode");
                exit();
            } else {
                $error = "Invalid code. Please enter the correct code.";
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
    <div class="blueBg"></div>
    <div class="codeVerification">
        <form class="cvContent" method="post" action="">
            <div class="cvText">
                <h1>Code Verification</h1>
                <div class="cvText2">
                    <p>We've sent a password reset code to your <br>email - <?php echo $email; ?></p>
                </div>
            </div>

            <?php if (!empty($error)) { ?>
                <div class="error"><?php echo $error; ?></div>
            <?php } ?>

            <div class="fpInput">
                <input type="number" name="code" placeholder="Enter code" required>
                <input type="hidden" name="email" value="<?php echo $email?>">
            </div>

            <div class="fpBtn">
                <button type="submit">Continue</button>
            </div>

            <div class="backLink">
                <a href="forgot_password.php?email=<?php echo $email; ?>">
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
