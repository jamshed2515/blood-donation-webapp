<?php
session_start();
include 'conn.php';

if (isset($_POST["login"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "SELECT * FROM admin_info WHERE admin_username='$username' AND admin_password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Username or Password are not matched!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center min-h-screen" style="background-image: url('admin_image/blood-cells.jpg');">

    <div class="bg-black bg-opacity-60 min-h-screen flex items-center justify-center px-4">
        <form method="post" class="bg-white bg-opacity-90 shadow-lg rounded-2xl p-10 w-full max-w-md">
            <h2 class="text-3xl font-bold text-center text-red-700 mb-6">Admin Login</h2>
            <p class="text-center text-sm text-gray-700 mb-6">Blood Bank & Management System</p>

            <?php if (isset($error)): ?>
                <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 font-semibold text-center">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <div class="mb-4">
                <label class="block text-gray-800 font-semibold mb-2">Username <span class="text-red-500">*</span></label>
                <input type="text" name="username" class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Enter your username" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-800 font-semibold mb-2">Password <span class="text-red-500">*</span></label>
                <input type="password" name="password" class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Enter your password" required>
            </div>

            <button type="submit" name="login" class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 font-semibold transition duration-300">
                LOGIN
            </button>
        </form>
    </div>

</body>
</html>
