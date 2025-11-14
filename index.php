<?php
session_start();
include 'db.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        $message = '<div class="alert alert-danger text-center">Invalid email or password!</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            color: 135deg;
            background: linear-gradient(135deg, #cae0f1ff, #5eb1e0ff);
        }
        .login-card {
            background: #dde5e9ff;
            border-radius: 15px;
            padding: 30px;
        }
        .login-title {
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
        }
        button {
            border-radius: 10px;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
        }
        a {
            text-decoration: none;
            font-weight: 500;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="col-md-5">

        <div class="card shadow login-card">
            <div class="card-body">

                <h2 class="text-center login-title">Login</h2>

                <?php echo $message; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control shadow-sm" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control shadow-sm" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100 shadow-sm">Login</button>

                    <p class="text-center mt-3">
                        <a href="register.php">Register</a> • 
                        <a href="forgot_password.php">Forgot Password?</a>
                    </p>
                </form>

            </div>
        </div>

    </div>
</div>

</body>
</html>
