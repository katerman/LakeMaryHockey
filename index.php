	<?php require("css_browser_selector.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="<?php echo css_browser_selector() ?>">

	<head>
	
		<title>Lake Mary Hockey - Home</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="keywords" content="Hockey, Lake Mary, Orlando , Roller Hockey, Hockey leauge, League, Florida Hockey, Lake mary hockey, orlando hockey"/>
		<meta name="description" content="Lake Marys own roller hockey league."/>
		
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/>
		
		<link rel="stylesheet" type="text/css" href="css/global.css" />
		<link rel="stylesheet" type="text/css"  href="css/lightbox.css" />
		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
		

		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<!--[if lte IE 7]>
       		<link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" />
   		<![endif]-->
		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
		
		
		<script src="js/lightbox.js" type="text/javascript"></script>
		<script src="js/popup.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/easySlider1.7.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true, 
				continuous: true,
				numeric: true
			});
		});	
	</script>
	</head>
	
	<body>
	
	<?php include_once("analyticstracking.php") ?>
	
	<div id="container">
		<div id="header">
			<div id="header-logo">
				<a href="index.html">
					<!--<img src="images/lmhLogo.png" alt="" />-->
				</a>
				<h1> Lake Mary Hockey</h1>			
			</div>
			
			<div id="header-team-icons">
			
				<a href="standings.html#team1">
					<!--<img src="images/team1.png" alt="" />-->
				</a>
	
				<a href="standings.html#team2">
					<!--<img src="images/team2.png" alt="" />-->
				</a>	
				
				<a href="standings.html#team3">
					<!--<img src="images/team3.png" alt="" />-->
				</a>
				
				<a href="standings.html#team4">
					<!--<img src="images/team4.png" alt="" />-->
				</a>
				
				
			</div>
		</div>
	
		<div id="nav">
			<ol>
				<li><a class="active" href="index.php">Home</a></li>
			 	<li><a href="standings.html#stands">Teams</a></li>
			 	<li><a href="playerstats.html#players">Players</a></li>
				<li><a href="http://www.facebook.com/groups/242140609216858/photos/">Pictures</a></li>
				<li><a href="rules.html">Rules</a></li>
				<li><a href="awards.html#awards">Awards</a></li>
				<li><a href="schedule.html">Schedule</a></li>
				<li id="payment"><a href="#">Payment</a></li>
				<li class="nav-msgbrd-fix"><a href="/msgboard/">Message Boards</a></li>
			</ol>
		</div>
		
		<div id="content"><!--start -content-->
		
			<div id="spec-content">
		<div id="slider">
			<ul>	

			<!--First Spec slide-->			
				<li>

		<img src="/images/spec-content-preview/ChampionShipWeek.jpg" alt="Leagues championship games start this upcoming week, lets see who will take home everything."/>
				
				</li>
				
							
			<!--second Spec slide-->			
				<li>

		<img src="/images/spec-content-preview/adam-hale-awards.jpg" alt="Adam hale, goalie for H-E Double Awesome takes home best goalie award."/>
				
				</li>

			
			<!--third Spec slide-->			
				
				<li>

		<img src="/images/spec-content-preview/matt-lind-awards.jpg" alt="H-E Double Awesome player Matt Lind takes home 3 awards, MVP, Goals, And assists."/>
				
				</li>

				
				
					
			</ul>
		</div>			
			

			</div>
			
			<div id="news-container"><!--start news-container-->
			<div id="news"><!--start news--->
			<h1><a href="beta/index.php">News</a></h1>
			
			<div id="news-stories">
					<ol><!--PHP/MySQL Script-->
							<?
							require_once 'beta/db.php';
							//Table restults
							$sql = $db->query('SELECT title, news, date FROM news ORDER BY id DESC');
										
							$results = $sql->fetchAll(PDO::FETCH_OBJ);
							
							foreach ($results as $result)
							{
								
							echo("<span>". $result->date . "</span> "
							."<br/>".
							"<h2>".$result->title."</h2>".
							"<br/>".
							"<p>".$result->news."<p>".
							"<br/>");
							
							}
							?>
					</ol>
				</div>
			</div><!--end news-->
			</div><!--end news-container-->
			
			<div id="calendar">
<iframe src="https://www.google.com/calendar/embed?title=Lake%20Mary%20Hockey%20Schedule&amp;showTitle=0&amp;showNav=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=200&amp;wkst=1&amp;hl=en&amp;bgcolor=%23cccccc&amp;src=3nag0rq4bd1sdpaj5d1bth3bvk%40group.calendar.google.com&amp;color=%23FFFFFF&amp;ctz=America%2FNew_York" style=" border-width:0 " width="300" height="200" frameborder="0" scrolling="no"></iframe>

			</div><!--end calendar-->
		</div><!--end content-->
	</div><!--end container-->

		<div id="footer"><!-- Start Footer -->

			<img class="footer" src="images/badaslogo.png" alt="badas logo!"/>
			<a href="http://www.badasdesign.com">
				Badas Design 2012&copy;
			</a>

		</div><!-- End Footer -->	
	
	</body>
</html> 


	