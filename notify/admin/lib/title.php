<?php
require "config.php";
		$sth = $db -> query ("SELECT * FROM title");
		while($row = $sth->fetch (PDO::FETCH_NUM))
		define('TITLE',$row[1]);
