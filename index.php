<?php 
	require 'start.php';

	if (isset($_GET['Search'])) {
		$search = urldecode($_GET['Search']);

		$index = $tnt->selectIndex("articles.index");
		$res = $tnt->search($search, 100);

		if (!empty($res['ids'])) {

		$ids = $res['ids'];

		$params = array_merge($ids, $ids);

		$placeholder = trim(str_repeat("?,", count($ids)), ",");

		$search = $db->prepare("
		    SELECT * FROM articles
		    WHERE id IN ($placeholder)
		    ORDER BY FIELD(id, $placeholder);
		");

		$search->execute($params);

		}

	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<a href="index.php">Search</a><br>
	<a href="insert.php">Insert records</a><br>
	<a href="display.php">Display records</a><br>

	<br><br>
	<h2>Search</h2>
	<form action="index.php" method="get">

		<div>
			<input type="text" name="Search" placeholder="Your search">
			<input type="submit" value="Search" id="search">
		</div>

	</form>

	<?php
		if (!empty($res['ids'])) {
			while($row = $search->fetch(PDO::FETCH_ASSOC)) {
				echo $row['id']; echo '<br>';
				echo $row['title']; echo '<br>';
				echo $row['slug']; echo '<br>';
				echo $row['article']; echo '<br>';
				echo '<br>'; echo '<br>';
			}
		}else {
			echo "No results found!";
		}

	?>

</body>
</html>