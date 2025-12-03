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
    <title>User Management: Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
	 body {
			 background: #0f0f0f;
		}
     
      .sidebar {
        height: 100%;
        width: 200px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #1c1c1c;
        padding-top: 20px;
		 border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      }

      .sidebar1 {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding-left: 10px;
      }
	  .sidebar2 {
			padding-top: 250px;
			padding-left: 10px;
		}

      .sidebar1 img {
        margin-right: 10px;
      }

      .sidebar a {
        text-decoration: none;
        font-size: 18px;
        color:  #c8ff00;
        transition: 0.3s;
      }

      .sidebar a:hover {
        color: #98b52b;
      }

     
      .content {
        margin-left: 220px;
        padding: 20px;
      }

      .profile {
        max-width: 960px;
        background: #1c1c1c;
        border-radius: 15px;
        border: 1px solid #ddd;
        box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        padding: 20px;
        text-align: center;
      }

      .profile img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        margin-bottom: 15px;
      }

      .profile p {
        margin: 5px 0;
        font-size: 16px;
		color:white;
      }

      .profile p:first-of-type {
        font-weight: bold;
        font-size: 20px;
		 color: #85a904;
      }
	  .inner1 {
			color: white;
		}
		.inner2 {
			color: white;
		}
	  .inner1 img {
			width: 30px;
			height: 30px;
		}
		.inner2 img {
			width: 30px;
			height: 30px;
		}
		.projects {
        max-width: 960px;
        background:  #0f0f0f;
        border-radius: 15px;
        border: 1px solid #ddd;
        box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        padding: 20px;
        text-align: center;
		margin-left: 241px;
      }
	  .project1 {
			display: flex;
			gap: 10px;
		}
		.card1 {
			width: 100%;
			margin-top: 20px;
			background-color: #1c1c1c;
			border-radius: 20px;
			padding: 10px;
		}
		
		.card2 {
			width: 100%;
			margin-top: 20px;
			background-color:  #1c1c1c;
			border-radius: 20px;
			padding: 10px;
		}
		.card3 {
			width: 100%;
			margin-top: 20px;
			background-color:  #1c1c1c;
			border-radius: 20px;
			padding: 10px;
		}
		.button {
        margin-top: 20px;
		color:black;
      }
      .btn {
        padding: 12px;
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
		button.btn.btn-outline-dark {
			width: 26%;
			margin-left: 20px;
			margin-top: 20px;
		}
		.progress-bar {
			background-color: #c8ff00;
		}
		.progress {
			margin: 10px;
		}
		p {
			color: #85a904;
		}
		small {
			color: white;
		}
		.payment {
        max-width: 960px;
        background:#1c1c1c;
        border-radius: 15px;
        border: 1px solid #ddd;
        box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        padding: 20px;
        text-align: center;
		margin-left: 241px;
		margin-top: 20px;
      }
	 strong {
			color: #c8ff00;
		}
		h4.mb-1 {
			color: white;
		}
		button.btn-close {
			color: #c8ff00;
		}
		p.px-4 {
			color: white;
		}
		p.mb-0 {
			color: white;
		}
		.fw-bold {
			font-weight: 700!important;
			color: #c8ff00;
		}
		.payment p {
			color: white;
		}
		label.form-check-label.ps-1.h4 {
			color: white;
		}
	  .time {
        max-width: 960px;
        background: #1c1c1c;
        border-radius: 15px;
        border: 1px solid #ddd;
        box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        padding: 20px;
        text-align: center;
		margin-left: 241px;
		margin-top: 20px;
      }
		.time img {
			padding-top: 20px;
		}

    </style>
  </head>
  <body>
   
    <div class="sidebar">
      <div class="sidebar1">
        <img src="img/profile.png" height="25" width="25">
        <a href="profile.php">Profile</a>
      </div>
	  <div class="sidebar1">
	     <img src="img/user-avatar.png" height="25" width="25">
		  <a href="edit.php">Edit Profile</a>
		 </div>
      <div class="sidebar1">
        <img src="img/idea.png" height="25" width="25">
        <a href="project.php">Projects</a>
      </div>
      <div class="sidebar1">
        <img src="img/task.png" height="25" width="25">
        <a href="task.php">Tasks</a>
      </div>
	  
      <div class="sidebar1">
        <img src="img/cogwheel.png" height="25" width="25">
        <a href="setting.php">Settings</a>
      </div>
	  <div class="sidebar2">
        <img src="img/check-out.png" height="25" width="25">
        <a href="logout.php">log out</a>
      </div>
    </div>

    <div class="content">
      <div class="profile">
        <?php if ($user): ?>
          <img src="uploads/<?php echo $user['image']; ?>" alt="Profile picture">
          <p><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></p>
          <p><?php echo $user['position']; ?></p>
          <p><?php echo $user['country']; ?></p><br>
          <div class="inner1">
            <img src="img/picture.png"> UI-Intern
          </div>
          <div class="inner1">
            <img src="img/blocked.png"> On-Teak
          </div><br>
          <div class="inner2">
            <img src="img/add.png"> <?php echo $user['phone']; ?>
          </div>
          <div class="inner2">
            <img src="img/email.png"> <?php echo $user['email']; ?>
          </div>
        <?php else: ?>
          <p style="color:red;">No user found in database.</p>
        <?php endif; ?>
      </div>
    </div>

	<div class="projects">
	    <button type="button" class="btn btn-dark">Ongoing Projects</button> 
		<div class="project1">
			   <div class="card1">
			     <button type="button1" class="btn btn-outline-dark">June</button>
				 <p>Web designing</p>
				 <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
				  <div class="progress-bar" style="width: 85%"></div>
				  
				</div>
				<small>85% Completed</small>
			
				</div>
								  
			   
			   <div class="card2">
			      <button type="button1" class="btn btn-outline-dark">March</button>
				 <p>Mobile App</p>
				  <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
				  <div class="progress-bar" style="width: 90%"></div>
				</div>
				<small>90% Completed</small>
			   </div>
			
			<div class="card3">
			   <button type="button1" class="btn btn-outline-dark">April</button>
				 <p>Deshboard</p>
				 <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
				  <div class="progress-bar" style="width: 100%"></div>
				</div>
				<small>100% Completed</small>
			</div>
		
		
		</div>
	</div>
	<div class="payment">
	  <button type="button" class="btn btn-dark">Earning</button> 
		<div class="alert bg-light-warning text-dark-warning alert-dismissible fade show" role="alert">
			<strong><?php echo $user['email']; ?></strong>
			<p class="mb-0">Your selected payout method was confirmed on Next Payout on 15 October, 2025</p>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="row mt-6">
			<div class="col-xl-4 col-lg-4 col-md-12 col-12 mb-3 mb-lg-0">
				<div class="text-center">
				
					<div id="payoutChart" class="apex-charts">
					  <img src="img/growth.png" width="200">
					</div>
					<h4 class="mb-1">Your Earning this month</h4>
					<h5 class="mb-0 display-4 fw-bold">$3,210</h5>
					<p class="px-4">Update your payout method in settings</p>
					<a href="#" class="btn btn-primary">
					Withdraw Earning
					</a>
				</div>
			</div>
			<div class="col-xl-8 col-lg-8 col-md-12 col-12">
			
				<div class="border p-4 rounded-3 mb-3">
					<div class="custom-control custom-radio">
						<input type="radio" id="customRadio1" name="customRadio" class="form-check-input" checked />
						<label class="form-check-label" for="customRadio1">
						<img src="img/paypal.png" alt=""  width="100">
						</label>
						<p>Your paypal account has been authorized for payouts.</p>
						<a href="#" class="btn btn-outline-primary"> Remove Account</a>
					</div>
				</div>
				
				<div class="border p-4 rounded-3 mb-3">
					<div class="custom-control custom-radio">
					<input type="radio" id="customRadio2" name="customRadio" class="form-check-input" />
					<label class="form-check-label ps-1" for="customRadio2">
					<img src="img/symbols.png" alt="" width="100">
					</label>
					</div>
				</div>
				
				<div class="border p-4 rounded-3">
					<div class="custom-control custom-radio">
					<input type="radio" id="customRadio3" name="customRadio" class="form-check-input" />
					<label class="form-check-label ps-1 h4" for="customRadio3">
					Bank Transfer
					</label>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="time">
	  <button type="button1" class="btn btn-dark">Spend Timing</button>
	  <div class="img">
	  <img src="img/pie-chart.png">
	  </div>
	</div>
	

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
