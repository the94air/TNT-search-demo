<?php 
	require 'start.php';

	$display = $db->prepare("SELECT * FROM `articles`");

	$display->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Display records</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<a href="index.php">Search</a><br>
	<a href="insert.php">Insert records</a><br>
	<a href="display.php">Display records</a><br>

	<br><br>
	<h2>Display records</h2>

	<?php if ($display->rowCount() > 0) : ?>

	<table border="1">

	<tr>
		<th>id</th>
		<th>title</th>
		<th>edit</th>
		<th>delete</th>
	</tr>

	<?php while($row = $display->fetch(PDO::FETCH_ASSOC)) : ?>
	<tr>
		<td><?php echo $row['id']; ?></td>
		<td><?php echo $row['title']; ?></td>
		<td><a href="update.php?article=<?php echo urlencode($row['slug']); ?>">Update</a></td>
		<td><a href="delete.php?article=<?php echo $row['id']; ?>">Delete</a></td>
	</tr>
	<?php endwhile ?>

	</table>

	<?php else: ?>
		<p>No records!!</p>
	<?php endif; ?>
</body>
</html>