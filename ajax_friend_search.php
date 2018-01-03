<?php 
include("C:/xampp/htdocs/social/config/config.php");
include("C:/xampp/htdocs/social/includes/classes/User.php");

$query=$_POST['query'];
$userLoggedIn=$_POST['userLoggedIn'];


$names=explode(" ", $query);

if(strpos($query, "_")!==false){
	$userReturned=mysqli_query($con,"SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");
}

else if(count($names)==2){
	$userReturned=mysqli_query($con,"SELECT * FROM users WHERE (first_name LIKE '%$names[0]%' AND last_name LIKE '%$names[1]%') AND user_closed='no' LIMIT 8");
}

else{
	$userReturned=mysqli_query($con,"SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%') AND user_closed='no' LIMIT 8");
}

if($query!=""){
	while($row=mysqli_fetch_array($userReturned)){
		$user= new User($con, $userLoggedIn);


		if($row['username']!=$userLoggedIn){
			$mutual_friends=$user->getMutualFriends($row['username']) . "  Mutual Friends";
		}
		else{
			$mutual_friends="";
		}

		if($user->isFriend($row['username'])){
			echo 	"<div class='resultDisplay'>
						<a href='messages.php?u='" . $row['username'] . "' style='color:#000;'>
							<div class='liveSearchProfilePic'>
								<img src='" .$row['profile_pic']. "'>
							</div>
							<div class='liveSearchText'>
								".$row['first_name']. " ". $row['last_name']. "	
								<p id='grey'>" . $mutual_friends ."</p>
							</div>
						</a>


					</div>";
		}

	}
}


 ?>