<?php

$the_countries = array(
	'United Kingdom',
	'United States',
	'British Indian Ocean Territory',
	'Cayman Islands',
	'Central African Republic',
	'Cocos (Keeling) Islands',
	'Cook Islands',
	'Dominican Republic',
	'Falkland Islands (Malvinas)',
	'Faroe Islands',
	'French Southern Territories',
	'Heard Island and Mcdonald Islands',
	'Iran, Islamic Republic of',
	'Korea, Democratic People\'s Republic of',
	'Korea, Republic of',
	'Lao People\'s Democratic Republic',
	'Marshall Islands',
	'Micronesia, Federated States of',
	'Moldova, Republic of',
	'Netherlands',
	'Netherlands Antilles',
	'Northern Mariana Islands',
	'Philippines',
	'Russian Federation',
	'Solomon Islands',
	'Syrian Arab Republic',
	'Turks and Caicos Islands',
	'United Arab Emirates',
	'United States Minor Outlying Islands',
	'Virgin Islands, British',
	'Virgin Islands, U.S.',
	'Western Sahara'
);

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
	$db->query("SELECT p.* FROM person p WHERE p.purl LIKE '$purl';");
	$rows = $db->getRowList();
	if(count($rows) > 0){
		return new User(array(
			"id" => $rows[0]->id,
			"first_name" => $rows[0]->first_name,
			"last_name" => $rows[0]->last_name,
			"email" => $rows[0]->email,
			"purl" => $rows[0]->purl,
			"country" => $rows[0]->country
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

function update_user($purl, $data=array()){
	$query = 'UPDATE person SET ';
	$d = array();
	foreach($data as $k=>$v){
		$d[] = $k.' = \''.addslashes($v).'\'';
	}
	$query .= implode(',', $d);
	$query .= ' WHERE purl=\''.$purl.'\'';
	
	global $db;
	$db->query($query);
	return true;
}
