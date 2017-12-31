<?php
		class Message {
			private $user_obj;
			private $con;

			public function __construct($con, $user){
				$this->con = $con;
				$this->user_obj = new User($con, $user);
			}

			public function getMostRecentUser()
			{
				$userLoggedIn=$this->user_obj->getUsername();
				$query=mysqli_query($this->con,"SELECT user_to, user_from FROM messages WHERE user_to='$userLoggedIn' OR user_from='$userLoggedIn' ORDER BY id DESC LIMIT 1");
				if(mysqli_num_rows($query)==0)
				{
					return false;
				}
				else
				{
					$row=mysqli_fetch_array($query);
					$user_to=$row['user_to'];
					$user_from=$row['user_from'];
				}

				if($user_to!=$userLoggedIn)
					return  $user_to;
				else 
					return $user_from;
			}


			public function sendMessage($user_to,$body,$date)
			{
				if($body!="")
				{
					$userLoggedIn=$this->user_obj->getUsername();
					$query=mysqli_query($this->con,"INSERT INTO messages VALUES('', '$user_to', '$userLoggedIn', '$body', '$date', 'no', 'no', 'no')");
				}
			}


			public function getMessages($otherUser)
			{
				$userLoggedIn=$this->user_obj->getUsername();
				$data="";

				$query=mysqli_query($this->con,"UPDATE messages SET deleted='yes' WHERE user_to='$userLoggedIn' AND user_from='$otherUser'");
				$get_messgaes_query=mysqli_query($this->con,"SELECT * FROM messages WHERE (user_to='$userLoggedIn' AND user_from='$otherUser') OR (user_to='$otherUser' AND user_from='$userLoggedIn') ");

			
				while ($row= mysqli_fetch_array($get_messgaes_query)) {
					$user_to=$row['user_to'];
					$user_from=$row['user_from'];
					$body=$row['body'];

					$div_top=($user_to==$userLoggedIn) ? "<div class='message' id='green'> ": "<div class='message' id='blue'>";
					$data= $data . $div_top . $body . "</div> <br><br>";
				}

				return $data;

			}

		




		}


?>