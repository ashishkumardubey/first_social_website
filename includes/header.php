<?php  
require 'config/config.php';

include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");

if(isset($_SESSION['username']))
	{
		$userLoggedIn= $_SESSION['username'];
		$user_details_query=mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
		$user=mysqli_fetch_array($user_details_query);
	}

else
	{
		header("Location:register.php");
	}

?>

<html>
<head>
	<title>Welcome to GETTOGETHER</title>

	<!-- JavaScript -->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootbox.min.js"></script>
	<script src="assets/js/social.js"></script>
	<script src="assets/js/jquery.Jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>


	<!--CSS -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />

	<link href="https://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister" rel="stylesheet">
</head>
<body>
	<div class="top_bar">
		<div class="logo">
			<a href="index.php">GETTOGETHTER</a>
		</div>

		<nav>
			<a href="<?php echo $userLoggedIn ?>">
				<?php echo $user['first_name']; ?>
			</a>
			<a href="index.php" title="homepage">
				<i class="fa fa-home fa-lg"></i>
			</a>
			<a href="#" title="msgbox">
				<i class="fa fa-envelope-o fa-lg"></i>
			</a>
			<a href="#" title="notifications">
				<i class="fa fa-bell-o fa-lg"></i>
			</a>
			<a href="requests.php" title="friend_requests">
				<i class="fa fa-users fa-lg"></i>
			</a>
			<a href="#" title="settings">
				<i class="fa fa-cog fa-lg"></i>
			</a>
			<a href="includes/handlers/logout.php" title="logout">
				<i class="fa fa-sign-out fa-lg"></i>
			</a>
		</nav>

	</div>


	<div class="wrapper">