<?php 
include 'core/init.php';
include 'includes/overall/header.php';
?>
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

	<?php
$db = new mysqli('localhost', 'webleyson', 'supplier', 'useru');
$articlesQuery = $db->query("
		SELECT 
		posts.id, 
		posts.title,
		posts.post,
		users.username,
		COUNT(posts_likes.id) AS likes, 
		GROUP_CONCAT(users.username SEPARATOR '|') as liked_by

		FROM posts

		LEFT JOIN posts_likes 
		ON posts.id=posts_likes.post

		LEFT JOIN users
		ON posts_likes.user = users.user_id

		GROUP BY posts.user_id

		");
while ($row = $articlesQuery->fetch_object()){
	var_dump($row);
	$row->liked_by = $row->liked_by ? explode('|', $row->liked_by) : [];
	$articles[] = $row;

	}


	
	 foreach ($articles as $article): ?>
		<article class="article">
		<hr />
			<h3><?php echo $article->title; ?></h3><a href="<?php echo $article->username;?>"><?php echo $article->username; ?></a>
			<p><?php echo $article->post; ?></p>
			
			<?php
				if(logged_in()){
					?>
					<a href="like.php?type=article&id=<?php echo $article->id;?>">Like</a>		
					<?php
				}else{
					?>
					<a href="login.php">You must login to vote</a>
					<?php
				}
			?>
			

			<p><?php echo $article->likes; ?> people like this</p>
			<?php if(!empty($article->liked_by)): ?>
			<ul>
				<?php foreach ($article->liked_by as $user): ?>
				<li>
					<?php echo $user; ?>
				</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		</article>	
	<?php endforeach ?>
</section>
<?php
if(isset($_SESSION['user_id'])){
	echo 'Logged in';
}else{
	echo 'not logged in';
}
?>
<?php include 'includes/overall/footer.php';?>
	