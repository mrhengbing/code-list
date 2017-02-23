<?php

	header("Content-Type:text/html; charset=utf-8");

	require "page.class.php";

	$mysqli = new mysqli("localhost", "root", "root", "phpmywind");

	$result = $mysqli->query("select id from db_infolist");

	$page = new Page($result->num_rows, 5);

	$sql = "select id, title from db_infolist order by id {$page->limit}";

	$result = $mysqli->query($sql);

	echo '<table align="center" border="1" width="900">';
	echo '<caption><h1>新闻列表</h1></caption>';
	echo '<tr><th>ID</th><th>TITLE</th></tr>';
	while ($row = $result->fetch_assoc()) {
		echo '<tr>';
			foreach ($row as $col) {
				echo '<td>'.$col.'</td>';
			}

		echo '</tr>';
	}

	echo '<tr><td align="center" colspan="2">'.$page->fpage().'</td></tr>';
	echo '</table>';