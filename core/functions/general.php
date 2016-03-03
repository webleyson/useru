<?php

function get_all_posts_from_user(){	
	$query = "SELECT title, post, username FROM posts, users
	WHERE users.user_id = posts.user_id";
	$result = mysql_query($query);
	while($row = mysql_fetch_assoc($result)){
		echo "<h2>".$row['title'] ."</h2>";
		echo "<p>".$row['post']."</p>";
	}
}

function get_all_posts_likes(){
	$query = "SELECT 
			posts.id, 
			posts.user_id, 
			u1.username, 
			posts.title, 
			posts.post, 
			COUNT( posts_likes.id ) AS likes, 
			GROUP_CONCAT( u2.username SEPARATOR  '|' ) AS liked_by

			FROM posts

			LEFT JOIN posts_likes ON posts.id = posts_likes.post
			LEFT JOIN users AS u1 ON posts.user_id = u1.user_id
			LEFT JOIN users AS u2 ON posts_likes.user = u2.user_id
			GROUP BY posts.id
	";


	$result = mysql_query($query);
	while ($row = mysql_fetch_assoc($result)){
		$row['liked_by'] = $row['liked_by'] ? explode('|', $row['liked_by'] ) : [];
		$articles[] = $row;
	}

	//echo "<pre>". print_r($articles, true). "</pre>";
	
	foreach ($articles as $article): ?>
		<article class="article">
			<header>
			<h3 class="float_left"><?php echo $article['title']; ?></h3><a class="float_right" href="<?php echo $article['username'];?>"><?php echo $article['username'];?></a>
			</header>
			<p><?php echo $article['post']; ?></p>
			<a href="like.php?type=article&id=<?php echo $article['id'];?>">Like</a>
			<p><?php echo $article['likes'];?> likes</p>
			<?php if(!empty($article['liked_by'])): ?>
				<ul>
				<?php foreach ($article['liked_by'] as $user): ?>
					<li><?php echo $user;?></li>
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>

		</article>

		<?php endforeach; 
}

function get_all_posts_without_likes(){
	$query = "SELECT posts.id, posts.user_id, users.username, posts.title, posts.post
	 FROM posts
	INNER JOIN users
	ON posts.user_id = users.user_id";


	$result = mysql_query($query);
	while ($row = mysql_fetch_assoc($result)){
		$articles[] = $row;
	}

	echo "<pre>". print_r($articles, true). "</pre>";
}
/*function users_posts($user_id){
	$user_id = (int)$user_id;
	$query = "SELECT posts.title, posts.post, posts.category_id  FROM posts JOIN users ON posts.user_id = users.user_id WHERE posts.user_id= $user_id";
	$result = mysql_query($query);
	while ($row = mysql_fetch_assoc($result)) {

		echo "<h3>" . $row['title'] . "</h3>";
		echo "<p>".$row['post']. "</p>";

	}
}*/

function logged_in_redirect(){
	if (logged_in()=== true){
		header('Location: index.php');
		exit();
	}
}

function protectpage(){
	if (logged_in() === false){
		header('Location: notallowed.php');
		exit();
	}
}

function admin_protect(){
	global $user_data;

	if (has_access($user_data['user_id'], 1) === false){
		header('Location: index.php');
		exit();
	}
}

function array_sanitize(&$item){
	$item = htmlentities(strip_tags(mysql_real_escape_string($item)));
}

function sanitize($data){
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}

function output_errors($errors){
	$output = array();
	foreach ($errors as $error) {
		# code...
		$output[] = '<li>' . $error . '</li>';
	}
	return '<ul>' . implode('', $output) . '</ul>';
} 
?>