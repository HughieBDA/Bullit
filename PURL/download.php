<?php

require_once('db.conf.php');
require_once('db.class.php');
require_once('lib.php');

$purl = iss($_GET['p'],'');
$dl = iss($_GET['t'],'');
$user = get_user($purl);

record_download($user->get("id"),$dl);

switch($dl) {
	
	case "Anna" : download('/uptospeedday/docs/social_media_too_much_information.pdf'); break;
	case "David" : download('/uptospeedday/docs/big_things_for_the_small_screen.pdf'); break;
	case "Rob" : download('/uptospeedday/docs/a_stickier_web.pdf'); break;
	case "Westley" : download('/uptospeedday/docs/the_flexible_web.pdf'); break;
	case "Andy" : download('/uptospeedday/docs/new_marketing_landscape.pdf'); break;
	
}

?>