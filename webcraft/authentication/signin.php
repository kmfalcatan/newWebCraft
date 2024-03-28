<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If remember me is checked, set cookies
    if(isset($_POST['remember']) && $_POST['remember'] == 'on') {
        setcookie('remember_email', $_POST['email'], time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('remember_password', $_POST['password'], time() + (86400 * 30), "/"); // 86400 = 1 day
    } else {
        // If remember me is not checked, delete cookies if they exist
        if(isset($_COOKIE['remember_email'])) {
            setcookie('remember_email', '', time() - 3600, '/');
        }
        if(isset($_COOKIE['remember_password'])) {
            setcookie('remember_password', '', time() - 3600, '/');
        }
    }

    require_once '../functions/signin.php';
}

$message = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../assets/css/signin.css">
</head>
<body id="body">
    <div class="container">
        <div class="subContainer" style="width: 90%;">
            <div class="imageContainer" id="image">
                <img class="image" src="../assets/img/steth.png" alt="">
                <div class="backgroundContainer">
                    <div class="paragraphContainer">
                        <p class="paragraph">Discover the power of efficient equipment management wiith MedEquip Tracker</p>
                    </div>

                    <div class="learnButtonContainer">
                        <a href="../landing_page.php">
                            <button class="learnButton">Back</button>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="logInFormContainer1">
                <div class="logoContainer">
                    <div class="nameContainer">
                        <p>MedEquip Tracker</p>
                    </div>
    
                    <div class="subLogoContainer">
                        <img class="logo" src="../assets/img/medLogo.png" alt="">
                    </div>
                </div>
    
            <form action="" method="POST">
                <div class="logInFormContainer">
                    <div class="subLogInFormContainer">
                        <div class="logIntextContainer">
                            <p class="logIntext">SIGN IN</p>
                        </div>
    
                        <?php
                        session_start();
                        if (isset($_SESSION['login_error'])) {
                            echo '<div id="alert" class="alert alert-danger">' . $_SESSION['login_error'] . '</div>';
                            unset($_SESSION['login_error']);
                        }
                        ?>
                        
                        <div class="subLogInFormContainer1">
                            <div class="iconContainer">
                                <img class="icon" src="../assets/img/email.png" alt="">
                            </div>
    
                            <div class="inputContainer">
                                <input class="inputField" name="username" type="text" value="<?php echo isset($_COOKIE['remember_email']) ? $_COOKIE['remember_email'] : ''; ?>" required>
                                <span>Username</span>
                            </div>  
                        </div>
    
                        <div class="subLogInFormContainer1">
                            <div class="iconContainer">
                                <img class="icon" src="../assets/img/password.png" alt="">
                            </div>
    
                            <div class="inputContainer">
                                <input class="inputField" name="password" type="password"  value="<?php echo isset($_COOKIE['remember_password']) ? $_COOKIE['remember_password'] : ''; ?>"  required>
                                <span>Password</span>
                            </div>  
                        </div>
    
                        <div class="rememberMeContainer">
                            <input class="checkBox" type="checkbox" name="remember" <?php if(isset($_COOKIE['remember_email'])) echo 'checked'; ?>>
                            <p class="rememberMe">Remember Me</p>
                        </div>
    
                        <div class="signInButtonContainer">
                            <button class="signInButton">Sign in</button>
                        </div>
    
                        <div class="forgotContainer">
                            <a class="forgot" href="">
                                <p>Forgot password?</p>
                            </a>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/login.js"></script>
    <!-- <script src="../assets/js/theme/login-theme.js"></script> -->
</body>
</html>
