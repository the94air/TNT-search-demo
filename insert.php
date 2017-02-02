<?php 
	require 'start.php';

	if (isset($_POST['Insert'])) {

	$title = $_POST['title'];
	$article = $_POST['article'];
	$slug = $_POST['slug'];

	//Validation here

	$insert = $db->prepare("INSERT INTO `articles`(`title`, `article`, `slug`) VALUES (:title,:article,:slug)");

	$insert->execute([
		':title' => $title,
		':article' => $article,
		':slug' => $slug
	]);

	$article_id = $db->lastInsertId();

	$tnt->selectIndex("articles.index");

	$index = $tnt->getIndex();

	$index->indexBeginTransaction();
	$index->insert([
		'id' => $article_id,
		'title' => $title,
		'article' => $article,
		'slug' => $slug
	]);
	$index->indexEndTransaction();

	header('Location: display.php');

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Insert</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<a href="index.php">Search</a><br>
	<a href="insert.php">Insert records</a><br>
	<a href="display.php">Display records</a><br>

	<br><br>
	<h2>Insert records</h2>
	<form action="insert.php" method="post">

		<div>
			<label for="title">Article title</label><br>
			<input type="text" name="title" id="title" required>
		</div>

		<div>
			<label for="article">Article body</label><br>
			<textarea name="article" id="article" required></textarea>
		</div>

		<div>
			<label for="slug">Article slug</label><br>
			<input type="text" name="slug" id="slug" required>
		</div>

		<div>
			<input type="submit" value="Insert" name="Insert">
		</div>

	</form>

</body>
</html>