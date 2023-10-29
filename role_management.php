<?php
session_start();

$action = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['adminAction'])) {
        $action = $_POST['adminAction'];
        // Perform the action based on the selected option
        if ($action === 'editRoles') {
            // Logic for editing user roles
            // Update user roles in user_data.txt
            $selectedUser = $_POST['selectedUser'];
            $newRole = $_POST['userRole'];

            $userData = readUserDataFromFile('user_data.txt');
            foreach ($userData as &$user) {
                if ($user['username'] === $selectedUser) {
                    $user['role'] = $newRole;
                }
            }
            updateUserDataFile('user_data.txt', $userData);
        }
    }

    // Read user data from user_data.txt
    $userData = readUserDataFromFile('user_data.txt');
}

// Function to read user data from user_data.txt
function readUserDataFromFile($filename) {
    $userData = [];
    if (file_exists($filename)) {
        $fileContent = file_get_contents($filename);
        $userArray = json_decode($fileContent, true);
        if (is_array($userArray)) {
            $userData = $userArray;
        }
    }
    return $userData;
}

// Function to update user data in user_data.txt
function updateUserDataFile($filename, $userData) {
    $userDataJson = json_encode($userData);
    file_put_contents($filename, $userDataJson);
}

// Fetch user data from user_data.txt
$userData = readUserDataFromFile('user_data.txt');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Role Management</title>
</head>
<body>
    <div class="container">
        <h2>Role Management</h2>

        <!-- List of Users and Roles -->
        <table border="1">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>User Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userData as $user) { ?>
                    <tr>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="selectedUser" value="<?php echo $user['username']; ?>">
                                <select name="userRole">
                                    <option value="admin" <?php if ($user['role'] === 'admin') echo 'selected'; ?>>Admin</option>
                                    <option value="manager" <?php if ($user['role'] === 'manager') echo 'selected'; ?>>Manager</option>
                                    <option value="user" <?php if ($user['role'] === 'user') echo 'selected'; ?>>User</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Edit Role</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
