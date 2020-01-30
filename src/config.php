<?php
return array(
	"database" => array(
		"host" => getenv("DB_SERVER"), 
		"username" => getenv("DB_USER"), 
		"password" => getenv("DB_PASSWORD"), 
		"database" => getenv("DB_NAME")));
