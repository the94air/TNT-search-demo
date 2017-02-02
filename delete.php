<?php
	require 'start.php';

	$id = (int) $_GET['article'];

	$delete = $db->prepare("DELETE FROM `articles` WHERE id = :id");

	$delete->execute([ ':id' => $id ]);

	$tnt->selectIndex("articles.index");

	$index = $tnt->getIndex();

	$index->indexBeginTransaction();
	$index->delete($id);
	$index->indexEndTransaction();
	
	header('Location: display.php');