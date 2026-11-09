<?php
require_once "db.php";

$message = "";

if (isset($_POST['register'])) {

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
    
     $check = $pdo->prepare(
            "SELECT * FROM users WHERE email = ?"
        );
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            $message = "Email already exists.";
        } else {

        $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

 $sql = "INSERT INTO users
                    (fullname, email, password, role)
                    VALUES (?, ?, ?, 'member')";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $fullname,
                $email,
                $hashed_password
            ]);

            $message = "Registration successful!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

    <h2>Create Account</h2>

    <p><?php echo htmlspecialchars($message); ?></p>

    <form method="POST">

        <label>Full Name:</label><br>
        <input type="text" name="fullname" required>
        <br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required>
        <br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required>
        <br><br>

        <label>Confirm Password:</label><br>
        <input type="password" name="confirm_password" required>
        <br><br>

        <button type="submit" name="register">
            Register
        </button>

    </form>

    <p>Already have an account? 
        <a href="login.php">Login here</a>
    </p>

</body>
</html>