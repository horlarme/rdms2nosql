<?php

require_once "./vendor/autoload.php"; 

header('content-type: application/json');

/**
 * Loading Migrate Class
 * @var $b Object
 */
$a = new horlarme\rdms2nosql\Migrate;


if($_GET['current']){
	echo json_encode(
		$a->export($_GET['current'])
	);
}
