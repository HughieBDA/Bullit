<?php

session_start();

require_once('db.conf.php');
require_once('db.class.php');
require_once('lib.php');

$user = null;
if(isset($_GET['p']) and !empty($_GET['p'])){
	$_SESSION['purl'] = $_GET['p'];
	header('Location: '.str_replace($_GET['p'], '', $_SERVER['REQUEST_URI']));
	exit;
}

if(isset($_SESSION['purl'])){
	$user = get_user($_SESSION['purl']);
}

if($user==null){
	exit;
}

record_visit($user->get('id'));

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="/css/normalize.css">
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/style.css">
		<link rel="stylesheet" href="/css/jquery.selectbox.css">
        <script src="/js/vendor/modernizr-2.6.1.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
        
        <div id="container">
        	
        	<header class="clearfix">
        		
        		<img src="/img/logo.png" alt="CAT" id="logo" />
        		
        		<nav>
        			<ul>
        				<li><a href="<?php echo $_SERVER['REQUEST_URI']; ?>" class="on">Home</a></li>
        				<li><a href="http://catphones.com">Catphones.com</a></li>
        				<li><a href="http://catphones.com/support.php">Support</a></li>
        			</ul>
        		</nav>
        		
        	</header>
        	
        	<section id="banner">
        		<img src="/img/knock-dunk-freeze.png" alt="Knock it. Dunk it. Freeze it." width="168" height="173" id="knockdunkfreeze">
        	</section>
        	
        	<section id="content" class="clearfix">
        	
        		<div id="col-left">
        			
        			<h2>Thanks for your interest in Cat<sup>&reg;</sup> phones. We're sorry to say the world's most rugged phones aren't available in <?php echo (in_array($user->get('country'), $the_countries) ? 'the ' : '').$user->get('country'); ?> right now.</h2>
        			
        			<h3>We're working hard to change this, and will be in touch with more news soon.</h3>
        			
        			<h4>In the meantime discover more.</h4>
        			
        			<p>See the Cat<sup>&reg;</sup> phone story unfold on our <a href="http://catphones.com/" target="_blank">new website</a> and get a glimpse of the cutting edge <a href="http://catphones.com/b10.php" target="_blank">Cat<sup>&reg;</sup> B10</a> smartphone and ultra-compact <a href="http://catphones.com/b25.php" target="_blank">Cat&reg; B25</a>.</p>
        			
        		</div>
        		
        		<div id="col-right">
        			<img src="/img/phones.png" alt="Cat B10 and Cat B25" width="465" height="466" id="phones">
        			
        			<div id="b10">
        				<p>
        					<img src="/img/icons-b10.png" alt="icons-b10" width="153" height="32">
        					<br />
        					<a href="http://catphones.com/b10.php" class="button">Find out more</a>
        				</p>
        			</div>
        			
        			<div id="b25">
        				<p>
        					<img src="/img/icons-b25.png" alt="icons-b25" width="117" height="32">
        					<br />
        					<a href="http://catphones.com/b25.php" class="button">Find out more</a>
        				</p>
        			</div>
        			
        		</div>
        		
        	</section>
        	
        	<section id="buckets" class="clearfix">
        		
        		<div id="knockit">
        			<img src="/img/knock-it-on.jpg" alt="knockit" />
        		</div>
        		
        		<div id="dunkit">
        			<img src="/img/dunk-it-on.jpg" alt="dunkit" />
        		</div>
        		
        		<div id="freezeit">
        			<img src="/img/freeze-it-on.jpg" alt="freezeit" />
        		</div>
        		
        	</section>
        	
        	<footer class="clearfix">
        		<p><img src="/img/logo-footer.png" alt="logo-footer" width="61" height="61">&copy; 2012 Caterpillar / CAT, CATERPILLAR, their respective logos, “Caterpillar Yellow,” “Caterpillar Corporate Yellow,” as well as corporate and product identity used herein, are trademarks of Caterpillar and may not be used without permission. Third-party trademarks are the property of their respective owners.  Bullitt Mobile Ltd is a licensee of Caterpillar, Inc.</p
        	</footer>
        	
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.8.0.min.js"><\/script>')</script>
        <script src="/js/plugins.js"></script>
        <script src="/js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
