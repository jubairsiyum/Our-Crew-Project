<?php
session_start();

// Function to validate user credentials
function validateUser($email, $password)
{
    $file = 'user_data.txt';
    $data = file_get_contents($file);
    $users = json_decode($data, true) ?: [];

    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            return $user; // Return user data on successful login
        }
    }

    return null; // Invalid login credentials
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user credentials
    $user = validateUser($email, $password);

    if ($user) {
        // Successful login, set session data
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];

        // Redirect to the user's home page based on their role
        if ($user['role'] === 'admin') {
            header("Location: home_admin.php");
        } elseif ($user['role'] === 'manager') {
            header("Location: home_manager.php");
        } else {
            header("Location: home_user.php");
        }

        exit();
    } else {
        $error = "Invalid email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Login</h2>
                <?php
                if (isset($error)) {
                    echo '<p class="alert alert-danger">' . $error . '</p>';
                }
                ?>
                <form method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
