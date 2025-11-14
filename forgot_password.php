<?php
include 'db.php';
include 'utils.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $email = trim($_POST['email']);
 $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
 $stmt->execute([$email]);
 $user = $stmt->fetch();
 if ($user) {
 $token = bin2hex(random_bytes(32));
 $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
 $update = $pdo->prepare("UPDATE users SET reset_token = ?, reset_expiry = ? WHERE id = ?");
 $update->execute([$token, $expiry, $user['id']]);
 $link = "http://localhost/todo-app/reset_password.php?token=$token";
 simulate_email($email, "Password Reset", "Click: $link");
 $message = '<div class="alert alert-success">Check <code>email_log.txt</code> for reset 
link!</div>';
 } else {
 $message = '<div class="alert alert-danger">Email not found!</div>';
 }
}
?>
<!DOCTYPE html>
<html><head><title>Forgot Password</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">
</head>

    <style>
        body {
            background: linear-gradient(135deg, #cae0f1ff, #5eb1e0ff);
            color: 135deg;
        
        

    }
        .card {
            background: #dde5e9ff; 
            border-radius: 15px;
            padding: 30px;
            margin-top: 100px;
            margin-bottom: 400px;
        }
        .Title {
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
           
        }
        button {
            background: linear-gradient(#f2f2f2, #f1c8c8ff, #f0afafff);
            border-radius: 10px;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            transition: all ease 0.3s ease;

        }
        a {
            text-decoration: none;
            font-weight: 500;
        }
        a:hover {
            text-decoration: underline;
        }

        button:hover { 
            text-decoration: onclick; 
            transform: scale(1.02);
        }
    </style>
<body class= "body">
<div class="container mt-5">
 <div class="card shadow">
 <div class="card-body">
 <h3 class="Title">Forgot Password</h3>
 <?php echo $message; ?>
 <form method="POST">
 <div class="mb-4"><label>Email</label><input type="email" name="email" class="form-control" required></div>
 <button type="submit" class="button">Send Reset Link</button>
 </form>
 <p class="mt-3"><a href="index.php">Back to Login</a></p>
 </div>
 </div>
</div>
</body>
</html>