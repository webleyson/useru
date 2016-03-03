<?php 
include 'core/init.php';
include 'includes/overall/header.php';
?>
<div class="row">
		<section id="posts">
			<h1>Home</h1>
			<p>Template</p>


			<?php
			/*if(has_access($session_user_id, 1) === true){
				echo 'admin';
			}else if(has_access($session_user_id, 2) === true){
				echo 'Moderator';
			}
			print_r($session_user_id);
			exit();*/
			?>
			<!-- <?php
			get_all_posts_likes();
			?> -->
		</section>
	<div class="col-xs-12 col-md-8">
	<?php
	if(isset($_SESSION['user_id'])){
	?>

	<div class="linkPreview" id="lp2"></div>
	<?php
	}
	?>
		<div id="retrieveFromDatabase"></div>


	</div>
	<div class="col-xs-12 col-md-4">
		<?php include 'includes/aside.php'; ?>
		<?php
		if(isset($_SESSION['user_id'])){
			echo 'Logged in';
		}else{
			echo 'not logged in';
		}
		?>
	</div>
<?php include 'includes/overall/footer.php';?>
	