<?php
    $connection = pg_connect ("host=localhost dbname=plot user=postgres password=root");
    if(!$connection) {
      echo 'Database Connection Failed';
    }
	return $connection;
?>
