<?php
session_start();
include "db.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

   
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
			echo "<script>
			alert('Registration Successful, welcome " . htmlspecialchars($user['username']) . "!');
			window.location.href = 'profile.php';
		  </script>";

            
        } else {
            echo "<div class='alert alert-danger'>Wrong password.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>No user found with this email.</div>";
    }

    $stmt->close();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Management: Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      body {
         background: #0f0f0f;
         color: #fff;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
      }
      .container {
			display: flex;
			flex-wrap: wrap;
			max-width: 1000px;
			width: 90%;
			background: #1c1c1c;
			border-radius: 20px;
			overflow: hidden;
			box-shadow: 0 10px 25px rgba(0,0,0,0.2);
			border-bottom: 10px solid #85a904;
		}
      .left {
        flex: 1;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
      }
      .left h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #85a904;
        margin-bottom: 20px;
      }
      .form-label {
			font-weight: 600;
			color: white;
		}
      .form-control {
        border-radius: 12px;
        padding: 12px;
        border: 1px solid #ddd;
        transition: 0.3s;
      }
      .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 8px rgba(79,70,229,0.3);
      }
      .button {
        margin-top: 20px;
		color:black;
      }
      .btn {
        padding: 12px;
        width: 100%;
        border-radius: 12px;
        font-weight: 600;
        background: #c8ff00;
       color: #000;
        border: none;
        transition: 0.3s;
      }
	  
      .btn:hover {
        background: #98b52b;
        transform: scale(1.02);
      }
      .right {
        flex: 1;
        background: #f9fafb;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .right img {
			width: 100%;
			height: 100%;
			object-fit: contain;
			border-radius: 90px !important;
		}
      @media (max-width: 768px) {
        .container {
          flex-direction: column;
        }
        .right {
          display: none;
        }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="left">
        <h1>Welcome Back</h1>
        <form action="" method="POST">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="button">
            <button type="submit" class="btn">Login Now</button>
          </div>
        </form>
      </div>
      <div class="right">
        <img src="img/login2.png" alt="Login illustration">
      </div>
    </div>
  </body>
</html>
