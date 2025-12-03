<?php
session_start();
include 'db.php';

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
   
    $id = 1; 
}


$stmt = $conn->prepare("SELECT * FROM edit_image WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>user-management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
	
	<style>
	     body {
         background: #0f0f0f;
         color: #fff;
        justify-content: center;
        align-items: center;
        margin: 0;
      }
	  h1 {
			color: #6e8909;
			text-align: center;
			padding-top: 10px;
		}
      .container {
        display: flex;
        max-width: 1000px;
        width: 100%;
        background: #1c1c1c;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
		margin-top: 20px;
      }
	  img {
			width: 50%;
		}
		.icon {
			text-align: right;
		}
		.icon img {
			width: 10%;
			padding-top: 72px;
		}
		.contant {
			padding-top: 30px;
		}
		.contant h1{
			 color: #85a904;
		}
		.app1{
        display: flex;
        max-width: 1000px;
        width: 100%;
        background: #1c1c1c;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
		margin-top: 20px;
		}
		.app {
			margin-left: 132px;
		}
		.app1 img {
			width: 12%;
			margin-bottom: 10px;
			margin-top: 10px;
			padding-left: 10px;
		}	
       .text p {
			padding-top: 25px;
		}	
        small {
			padding-left: 340px;
		}	
        .app1 .icon {
			padding-top: 25px;
		}	
        h3 {
			color: #85a904;
			padding-top: 20px;
		}		
	</style>
  </head>
  <body>
    <h1>Settings</h1>
	<div class="container">
	  <?php if ($user): ?>
	  <div class="img">
	     <img src="uploads/<?php echo $user['image']; ?>" >
	  </div>
	  <div class="contant">
	    <h1><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></h1>
		<p><?php echo $user['email']; ?></p>
		<p><?php echo $user['phone']; ?></p>
	  </div>
	  <div class="icon">
	    <img src="img/edit (1).png">
	  </div>
	<?php endif; ?>
	</div>
	<div class="app">
	  <h3>App Settings</h3>
	  <div class="app1">
	    <div class="img">
		   <img src="img/home.png">
		</div>
		<div class="text">
		    <p>Add Home</p>
		</div>
		<div class="icon">
		  <small> > </small>
		</div>
	    </div>
	</div>
	<div class="app">
	  <div class="app1">
	    <div class="img">
		   <img src="img/home.png">
		</div>
		<div class="text">
		    <p>Add work</p>
		</div>
		<div class="icon">
		  <small> > </small>
		</div>
	  </div>
	</div>
	<div class="app">
	  <div class="app1">
	    <div class="img">
		   <img src="img/home.png">
		</div>
		<div class="text">
		    <p>Shortcuts</p>
		</div>
		<div class="icon">
		  <small> > </small>
		</div>
	  </div>
	</div>
	<div class="app">
	  <div class="app1">
	    <div class="img">
		   <img src="img/home.png">
		</div>
		<div class="text">
		    <p>Privacy</p>
		</div>
		<div class="icon">
		  <small> > </small>
		</div>
	  </div>
	</div>
	<div class="app">
	  <div class="app1">
	    <div class="img">
		   <img src="img/home.png">
		</div>
		<div class="text">
		    <p>Communications</p>
		</div>
		<div class="icon">
		  <small> > </small>
		</div>
	  </div>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>