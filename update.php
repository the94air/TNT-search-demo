<?php 

	require 'start.php';

	$slug = urldecode($_GET['article']);

	$view = $db->prepare("SELECT * FROM `articles` WHERE slug = :slug LIMIT 1");

	$view->execute([ ':slug' => $slug ]);

	$viewResult = $view->fetch();

	$viewId = e($viewResult['id']);
	$viewTitle = e($viewResult['title']);
	$viewArticle = e($viewResult['article']);
	$viewSlug = e($viewResult['slug']);

	if (isset($_POST['Update'])) {

	$id = $viewId;
	$title = $_POST['title'];
	$article = $_POST['article'];
	$slug = $_POST['slug'];

	//Validation here

	$update = $db->prepare("UPDATE `articles` SET `title` = :title, `article` = :article, `slug` = :slug WHERE id = :id");

	$update->execute([
		':id' => $id,
		':title' => $title,
		':article' => $article,
		':slug' => $slug
	]);

	$tnt->selectIndex("articles.index");

	$index = $tnt->getIndex();

	$index->indexBeginTransaction();
	$index->update($id, [
		'id' => $id,
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
	<title>Update records</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<a href="index.php">Search</a><br>
	<a href="insert.php">Insert records</a><br>
	<a href="display.php">Display records</a><br>

	<br><br>
	<h2>Update records</h2>

	<form action="update.php?article=<?php echo urlencode($viewSlug); ?>" method="post">

		<div>
			<label for="title">Article title</label><br>
			<input type="text" name="title" id="title" value="<?php echo $viewTitle; ?>">
		</div>

		<div>
			<label for="article">Article body</label><br>
			<textarea name="article" id="article"><?php echo $viewArticle; ?></textarea>
		</div>

		<div>
			<label for="slug">Article slug</label><br>
			<input type="text" name="slug" id="slug" value="<?php echo $viewSlug; ?>">
		</div>

		<div>
			<input type="submit" value="Update" name="Update">
		</div>

	</form>
</body>
</html>