<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login_styles.css">
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>

            <?php
            // Cek apakah form telah di-submit
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Ambil nilai dari form
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Dummy data pengguna (biasanya data ini disimpan di database)
                $dummy_username = "admin";
                $dummy_password = "password";

                // Cek apakah username dan password cocok
                if ($username == $dummy_username && $password == $dummy_password) {
                    // Jika cocok, redirect ke halaman utama atau halaman selanjutnya
                    header("Location: index.php");
                    exit();
                } else {
                    // Jika tidak cocok, beri pesan error
                    echo "<script>alert('Username atau password salah');</script>";
                }
            }
            ?>
        </form>
    </div>
</body>

</html>