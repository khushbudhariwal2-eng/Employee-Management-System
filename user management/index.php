<?php
session_start();
include 'db.php';

$emailErr = $usernameErr = $passwordErr = "";
$email = $username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $username = htmlspecialchars(trim($_POST['username']));

   
    if (empty($email)) {
        $emailErr = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    if (empty($username)) {
        $usernameErr = "Username is required";
    }

    
    if (empty($_POST['password1']) || empty($_POST['password2'])) {
        $passwordErr = "Password and Confirm Password are required";
    } else {
        $raw_password = $_POST['password1'];
        $confirm_password = $_POST['password2'];

        if ($raw_password !== $confirm_password) {
            $passwordErr = "Passwords do not match";
        } elseif (
            strlen($raw_password) < 8 ||
            !preg_match('/[A-Z]/', $raw_password) ||
            !preg_match('/[a-z]/', $raw_password) ||
            !preg_match('/[0-9]/', $raw_password) ||
            !preg_match('/[\W]/', $raw_password)
        ) {
            $passwordErr = "Password must have at least 8 chars, uppercase, lowercase, number, special char";
        } else {
            $password = password_hash($raw_password, PASSWORD_DEFAULT);
        }
    }

    
    if (empty($emailErr) && empty($usernameErr) && empty($passwordErr)) {
        $sql = "INSERT INTO `user` (email, username, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sss", $email, $username, $password);

        if ($stmt->execute()) {
			echo "<script>
			alert('Registration Successful');
			window.location.href = 'login.php';
		</script>";


        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Management - Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
         gap: 20px; 
        width: 100%;
        max-width: 1000px;
        background: #1c1c1c;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
		margin-top: 20px;
      }
    h1 {
    color: #85a904;
    }
    .left {
        width: 100%;
        margin-top: 40px;
        padding: 20px;
    }
	   img {
		width: 100%;
		padding-top: 40px;
	}
    .col-auto {
        display: flex;
        gap: 10px;
        color: black;
        flex-direction: column;
    }
	.form-text {
			font-size: 12px;
			color: white;
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
	  .form-check-input:checked {
			background-color: #c8ff00;
			border-color: #c8ff00;
		}
	  a {
			color: #c8ff00;
		}
    .error { 
        color: #FF0000;
        font-size: 14px;
    }
  </style>
</head>
<body>
<div class="container">
   <div class="left">
      <h1>Create Your Account </h1>
  
      <form action="" method="POST">
       
        <div class="mb-3">
          <label for="email" class="form-label">Email </label>
          <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>">
          <span class="error"><?php echo $emailErr; ?></span>
        </div>

      
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($username); ?>">
          <span class="error"><?php echo $usernameErr; ?></span>
        </div>

      
        <div class="mb-3">
          <label for="password1" class="form-label">Password</label>
          <input type="password" class="form-control" name="password1">
          <span class="error"><?php echo $passwordErr; ?></span>
        </div>

        
        <div class="col-auto2">
          <span class="form-text">• Use 8 or more characters</span>
          <span class="form-text">• One uppercase character</span>
		  </div>
		  <div class="col-auto2">
          <span class="form-text">• One lowercase character</span>
          <span class="form-text">• One special character</span>
          <span class="form-text">• One number</span>
        </div>

        
        <div class="mb-3 mt-3">
          <label for="password2" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" name="password2">
        </div>

       
        <div class="mb-3">
           <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck">
              <label class="form-check-label" for="gridCheck">
                I want to receive emails for all types.
              </label>
           </div>
        </div>

        
        <div class="mb-3">
          <button type="submit" class="btn btn-primary">Create Your Account</button>
        </div>

        
        <div class="mb-3">
          <label>Already have an account? <a href="login.php">Log in</a></label>
        </div>
      </form>
   </div>

   
   <div class="right">
      <div class="img">
         <img src="img/img3.png" alt="Register Image">
      </div>
   </div>
</div>
</body>
</html>
