<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($title)) {
    $title = "TaskChat - Find Local Taskers";
}
?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <style>
    .header {
      background: #4CAF50;
      padding: 15px 0;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
    }
    .header-content {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
    }
    .logo {
      color: white;
      font-size: 24px;
      font-weight: bold;
      text-decoration: none;
    }
    .nav-links {
      display: flex;
      gap: 20px;
    }
    .nav-links a {
      color: white;
      text-decoration: none;
      padding: 8px 15px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .nav-links a:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }
    .main-content {
      margin-top: 70px;
    }
  </style>
</head>
<body>
  <header class="header">
    <div class="header-content">
      <a href="index.php" class="logo">TaskRabbit</a>
      <nav class="nav-links">
        <?php if(isset($_SESSION['unique_id'])){ ?>
          <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'user') { ?>
            <a href="post_task.php">Post a Task</a>
          <?php } else { ?>
            <a href="tasks.php">Available Tasks</a>
          <?php } ?>
          <a href="users.php">Messages</a>
          <a href="php/logout.php?logout_id=<?php echo $_SESSION['unique_id']; ?>">Logout</a>
        <?php } else { ?>
          <a href="index.php">Home</a>
          <a href="communication.php">Sign Up</a>
          <a href="login.php">Login</a>
        <?php } ?>
      </nav>
    </div>
  </header>
  <div class="main-content">
</body>
</html>