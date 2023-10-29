<?php
session_start();

function saveUserData($userData)
{
    $file = 'user_data.txt';
    $data = file_get_contents($file);
    $data = json_decode($data, true) ?: [];

    foreach ($data as $user) {
        if ($user['email'] === $userData['email']) {
            return false; // User already exists
        }
    }

    $data[] = $userData;

    file_put_contents($file, json_encode($data));

    return true; // User registered successfully
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => 'user',
        ];

        $registered = saveUserData($userData);

        if ($registered) {
            header("Location: login.php");
            exit();
        } else {
            $error = "User with this email already exists.";
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Registration Form</h2>
                <?php
                if (isset($error)) {
                    echo '<p class="alert alert-danger">' . $error . '</p>';
                }
                ?>

                <form method="post">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="text-center">
                            <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>

                <p class="text-center">Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
