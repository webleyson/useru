<?php 
include 'core/init.php';
protectpage();
include 'includes/overall/header.php';


if(isset($_GET['username']) === true && empty($_GET['username'])===false){
	$username 	= $_GET['username'];

	if (user_exists($username) === true){
		$user_id 	= user_id_from_username($username);
		$profile_data = user_data($user_id, 'first_name', 'last_name', 'email', 'username', 'profile');


	?>
	<section id="profile_page">
	<header>
		
	<figure>
	<img src="<?php echo $profile_data['profile']; ?>">
	<figcaption>
		<h1><?php echo $profile_data['username'];?></h1>
	</figcaption>
	</figure>
	</header>
	<?php
	users_posts($user_id)
	?>
	<?php	
	}else{
		echo 'User does not exist';
	}


	}else{
		header('location: index.php');
		exit();
	}

?>
</section>
<?php include 'includes/overall/footer.php';?>
	