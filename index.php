<?php
include 'db_config.php';

$email = "";
$username = "";
$password = "";

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Registration
    if (isset($_POST['register_user'])) {

        try {
            $username = $_POST["username"];
            if (empty($username) || empty($email) || empty($password)) {
                throw new Exception("All the fields are required");
            }

            $check_query = "SELECT * FROM user_accounts WHERE username='$username' OR email='$email'";
            $check_result = mysqli_query($connect, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                throw new Exception("Username or email already exists");
            }

            $password = md5($password); // Encrypt the password
            $sql = "INSERT INTO user_accounts (username, email, password) VALUES ('$username','$email','$password')";
            $result = $connect->query($sql);

            if (!$result) {
                throw new Exception("Invalid Query: " . $connect->error);
            }

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You Created Your Account Successfully";
            header("location:index.php");
            exit;

        } catch (Exception $e) {
            $errors['register'] = $e->getMessage();
        }
    }

    // Login
    if (isset($_POST['login_user'])) {
        try {
            $email = mysqli_real_escape_string($connect, $_POST['email']);
            $password = mysqli_real_escape_string($connect, $_POST['password']);

            if (empty($email) || empty($password)) {
                throw new Exception("Both email and password are required");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email format");
            }

            $query = "select * from user_accounts where email = '$email' limit 1";
            $result = mysqli_query($connect, $query);

            if (!$result || mysqli_num_rows($result) === 0) {
                throw new Exception("Invalid email or password");
            }

            $user_data = mysqli_fetch_assoc($result);

            if ($user_data['password'] !== md5($password)) {
                throw new Exception("Invalid email or password");
            }

            header("location: ../Home_Page/homepage.html");
            die;

        } catch (Exception $e) {
            $errors['login'] = $e->getMessage();
        }
    }

    // Admin Login
    if (isset($_POST['login_admin'])) { // Changed name to 'login_admin'
        try {
            $email = mysqli_real_escape_string($connect, $_POST['email']);
            $password = mysqli_real_escape_string($connect, $_POST['password']);

            if ($email === "admin@admin.com" && $password === "@dmi1n@dm1n") {
                $_SESSION['username'] = 'Admin';
                header("location: ../Admin_pages/admin-page.html");
                exit;
            }

            $query = "select * from user_accounts where email = '$email' limit 1";
            $result = mysqli_query($connect, $query);

            if (!$result || mysqli_num_rows($result) === 0) {
                throw new Exception("Invalid email or password");
            }

            $user_data = mysqli_fetch_assoc($result);

            if ($user_data['password'] !== md5($password)) {
                throw new Exception("Invalid email or password");
            }

            header("location: ../Home_Page/homepage.html");
            die;

        } catch (Exception $e) {
            $errors['admin'] = $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/jpg" href="assets/photos/favicon.jpg">
    <title>Essence To You</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="assets/photos/logo.png" alt="Logo">
        </div>
    </header>

    <div class="wrapper">
        <div class="form-box login">
            <h2>Login</h2>
            <form method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" required name="email">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" required name="password">
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <a href="forgotpassword.php">Forgot Password?</a>
                </div>
                <button type="submit" class="btn" name="login_user">Login</button>
                <div class="error-message">
                    <?php if(isset($errors['login'])) echo $errors['login']; ?>
                </div>
                <div class="login-register">
                    <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
                </div>
            </form>
        </div>

        <div class="form-box register">

            <h2>Register</h2>
            <form action="Register" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input required type="text" name="username" value="<?php echo $username; ?>"> 
                    <label>Username</label>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" required value="<?php echo $email; ?>">
                    <label>Email</label>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input required type="password" name="password" value="<?php echo $password; ?>">
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox"> I agree to the terms & conditions</label>
                </div>
                <button type="submit" class="btn" name="register_user">Register</button>
                <div class="error-message">
                    <?php if(isset($errors['register'])) echo $errors['register']; ?>
                </div>
                <div class="login-register">
                    <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>
