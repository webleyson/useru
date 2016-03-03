<?php 
include 'core/init.php';
include 'includes/overall/header.php';

if(isset($_GET['type'], $_GET['id'] )){
	$type 	= $_GET['type'];
	$id  	= (int)$_GET['id'];

	switch($type){
		case 'article':
			$query = "
				INSERT INTO posts_likes (user, post)
					SELECT {$_SESSION['user_id']}, {$id}
					FROM posts 
					WHERE EXISTS(
						SELECT id
						FROM posts
						WHERE id = {$id})
					AND NOT EXISTS (
						SELECT id
						FROM posts_likes
						WHERE user = {$_SESSION['user_id']}
						AND post = {$id})
					LIMIT 1
			";
		mysql_query($query); 
		break;
	}
}
header('Location: index.php');
include 'includes/overall/footer.php';?>
