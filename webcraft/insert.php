<?php
include_once "dbConfig/dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['password'], $_POST['role'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        insertNewUser($username, $password, $role);
    } else {
        echo "Please fill in all required fields.";
    }
}

function insertNewUser($username, $password, $role)
{
    global $conn;

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the INSERT statement
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashedPassword, $role);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows === 1) {
        echo "New user inserted successfully.";
    } else {
        echo "Error inserting user.";
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create User Account</title>
</head>
<body>
    <h1>Create User Account</h1>

    <form method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="role">Role:</label>
        <input type="text" name="role" id="role" required><br><br>

        <input type="submit" value="Create Account">
    </form>
</body>
</html>
