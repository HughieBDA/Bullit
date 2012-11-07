<?php

require_once('db.conf.php');
require_once('db.class.php');
require_once('user.class.php');

// Create the database connection object
$db = Database_MySQL::getInstance(array(
	'host' => DB_HOST,
	'user' => DB_USER,
	'password' => DB_PASS,
	'database' => DB_NAME
));

// Function to ensure a variable is set
function iss(&$var, $def) {
	return isset($var) ? $var : $def;
}

// Function to get user details
function get_user($purl) {
	
	global $db;
	$purl = mysql_escape_string($purl);	
	$db->query("SELECT p.id, p.first_name, p.last_name, p.email, p.purl, c.company FROM person AS p INNER JOIN company AS c ON p.company = c.id WHERE p.purl LIKE '$purl';");
	$rows = $db->getRowList();
	if(count($rows) > 0){
		return new User(array(
			"id" => $rows[0]->id,
			"first_name" => $rows[0]->first_name,
			"last_name" => $rows[0]->last_name,
			"email" => $rows[0]->email,
			"purl" => $rows[0]->purl,
			"company" => $rows[0]->company
		));	
	}else{
		return null;
	}
}

function record_visit($user) {
		
	global $db;
	$db->query("INSERT INTO visit (person) VALUES ($user)");
		
}

function record_download($user,$file) {
	
	$file = mysql_escape_string($file);	
	global $db;
	$db->query("INSERT INTO download (person, file) VALUES ($user,'$file')");
		
}

function download($path) {
	$file = explode("/",$path);
	$file = array_pop($file);
	header("Content-type: application/pdf");
	header('Content-Disposition: attachment; filename="'.$file.'"');
	readfile($_SERVER['DOCUMENT_ROOT'] . $path);
}
