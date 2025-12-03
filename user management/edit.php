<?php
include 'db.php';
session_start();


if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
    $id = 1; 
}


$sql = "SELECT * FROM edit_image WHERE id=$id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $position = $_POST['position'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $update_img = "";
    if (!empty($_FILES['image']['name'])) {
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $folder = "uploads/" . basename($img_name);

        if (move_uploaded_file($tmp_name, $folder)) {
            $update_img = ", image = '$img_name'";
        }
    }
	
	 $sql = "INSERT INTO `edit_image` (firstname,lastname,position,country,phone,email) VALUES (?, ?, ?,?,?,?)";
     $stmt = $conn->prepare($sql);

    $sql = "UPDATE edit_image 
            SET firstname='$firstname', 
                lastname='$lastname', 
                position='$position', 
                country='$country', 
                phone='$phone', 
                email='$email'
                $update_img
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Profile updated successfully!');
                window.location.href = 'profile.php';
              </script>";
    } else {
        echo "Error updating: " . mysqli_error($conn);
    }
}
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>user management:edit profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
	<style>
	 body {
			 background: #0f0f0f;
		}
		
		.container {
        max-width: 1000px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
		padding: 20px;
		margin-top: 20px;
		
      }
	   h1 {
		color: #85a904;
		}
	

      .form {
        max-width: 960px;
        background: #0f0f0f;
        border-radius: 15px;
        border: 1px solid #ddd;
        box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        padding: 20px;
        text-align: center;
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
	  button.btn.btn-primary {
			width: 25%;
			padding: 9px;
		}
	  </style>
  </head>
  <body>
    <div class="container">
	   <div class="form">
	      <h1>Edit Your Profile</h1>
	     <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            
            <input type="file" name="image" class="form-control">
        </div>

        <div class="row">
            <div class="col">
                <input type="text" name="firstname" class="form-control" placeholder="First name" value="<?php echo $user['firstname']; ?>">
            </div>
            <div class="col">
                <input type="text" name="lastname" class="form-control" placeholder="Last name" value="<?php echo $user['lastname']; ?>">
            </div>
        </div><br>

        <div class="mb-3">
            <input type="text" name="position" class="form-control" placeholder="Position" value="<?php echo $user['position']; ?>">
        </div>

        <div class="mb-3">
            <input type="text" name="country" class="form-control" placeholder="Country" value="<?php echo $user['country']; ?>">
        </div>

        <div class="mb-3">
            <input type="number" name="phone" class="form-control" placeholder="Phone Number" value="<?php echo $user['phone']; ?>">
        </div>

        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $user['email']; ?>">
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
	   </div>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>