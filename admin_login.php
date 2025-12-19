<?php
session_start();
include('connection.php');
$error = "";

if(isset($_POST['login'])) {
    // SECURITY NOTE: The SQL query here is vulnerable to SQL Injection.
    // It should be replaced with a prepared statement.
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vulnerable query:
    // $sql = "SELECT * FROM admin WHERE username='$username'";

    // Secure Prepared Statement (Recommended fix):
    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Continue with the original logic using the result from the prepared statement:
    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Username not found.";
    }
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
  <link rel="icon" type="image/png" href="img/fav.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded-xl shadow-2xl w-96 transform transition duration-500 hover:scale-[1.02]">
    <h2 class="text-3xl font-extrabold mb-8 text-center text-[#46A0FA]">Admin Login</h2>

    <?php if($error): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-6 border border-red-300 font-medium"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="" class="space-y-6">
        <div>
            <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
            <input type="text" id="username" name="username" class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150" required>
        </div>
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
            <input type="password" id="password" name="password" class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150" required>
        </div>
        <div>
            <button type="submit" name="login" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold text-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-150 shadow-lg">Login</button>
        </div>
    </form>
</div>

</body>
</html>

