<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: index.php"); exit; }
include 'db.php';
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
$pending = $pdo->prepare("SELECT COUNT(*) FROM todos WHERE user_id = ? AND status = 'pending'");
$pending->execute([$user_id]);
$pending_count = $pending->fetchColumn();
$overdue = $pdo->prepare("SELECT COUNT(*) FROM todos WHERE user_id = ? AND due_date < CURDATE() AND 
status != 'completed'");
$overdue->execute([$user_id]);
$overdue_count = $overdue->fetchColumn();
?>
<!DOCTYPE html>
<html><head><title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">
<style>
        body {
            background: linear-gradient(135deg, #cae0f1ff, #5eb1e0ff);
            min-height: 100vh;
            font-family: Arial, sans-serif;
            color: #000;
        }
        h2 {
            font-weight: 700;
            margin-bottom: 30px;
        }
        .card {
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card h5 {
            font-weight: 600;
            margin-bottom: 10px;
        }
        .card h2 {
            font-size: 2.5rem;
            font-weight: 700;
        }
        .btn-primary {
            border-radius: 10px;
            padding: 12px 25px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background-color: #4a90e2;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }
        .dashboard-container {
            padding-top: 50px;
            padding-bottom: 50px;
        }
      
        .navbar-brand{
            background: linear-gradient(135deg, #dde5e9ff, #6ba2bbff);
            border-radius: 0 0 10px 10px;
            box-shadow: 0 15px 15px  rgba(0,0,0,0.1);
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .custom-navbar .navbar-brand {
            font-weight: 700;
            color: #000;
            font-size: 1.5rem;
        }

        .custom-navbar .navbar-brand:hover {
            color: #5eb1e0;
        }

        .custom-navbar .nav-link {
            font-weight: 500;
            color: #000;
            margin-left: 15px;
            transition: all 0.2s;
        }

        .custom-navbar .nav-link:hover {
            color: #5eb1e0;
            text-decoration: underline;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {
            background-color: #5eb1e0;
            border-radius: 5px;
        }
        /* Top Header Bar */
.top-header {
    background-color: #3a90c9; /* top bar color */
    color: #fff;
    font-size: 0.9rem;
}

.top-header .top-link {
    color: #fff;
    margin-left: 20px;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

.top-header .top-link:hover {
    color: #ffdd57; /* hover color */
}


    </style>
</head><body>
<div class="top-header d-flex justify-content-end align-items-center px-4 py-2">
    <a href="dashboard.php" class="top-link">Dashboard</a>
    <a href="profile.php" class="top-link">Profile</a>
    <a href="logout.php" class="top-link">Logout</a>
</div>
<div class="container mt-5">
 <h2>Welcome, <strong><?php echo htmlspecialchars($user['username']); ?></strong>!</h2>
 <nav class="navbar custom-navbar">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">TodoApp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
  </div>
</nav>
 <div class="row g-4">
 <div class="col-md-6">
 <div class="card text-white bg-warning"><div class="card-body"><h5>Pending 
Tasks</h5><h2><?php echo $pending_count; ?></h2></div></div>
 </div>
 <div class="col-md-6">
 <div class="card text-white bg-danger"><div class="card-body"><h5>Overdue</h5><h2><?php 
echo $overdue_count; ?></h2></div></div>
 </div>
 </div>
 <div class="mt-4"><a href="todos.php" class="btn btn-primary">Go to TODOs</a></div>
</div>


</body></html>