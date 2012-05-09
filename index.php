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

		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<!--[if lte IE 7]>
       		<link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" />
   		<![endif]-->
	


		<script src="js/css_browser_selector.js" type="text/javascript"></script>

		<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
		<script src="js/lightbox.js" type="text/javascript"></script>
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
					<!--<img src="images/chiefsLogo.png" alt="" />-->
				</a>
	
				<a href="standings.html#team2">
					<!--<img src="images/h-eLogo.png" alt="" />-->
				</a>	
				
				<a href="standings.html#team3">
					<!--<img src="images/wcbdfyLogo.png" alt="" />-->
				</a>
				
				<a href="standings.html#team4">
					<!--<img src="images/bcrushLogo.png" alt="" />-->
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
				<li><a href="#">Payment</a></li>
				<li class="nav-msgbrd-fix"><a href="/msgboard/">Message Boards</a></li>
			</ol>
		</div>
		
		<div id="content"><!--start -content-->
		
			<div id="spec-content">
		<div id="slider">
			<ul>	
			

			
			<!--First Spec slide-->			
				<li>
					<a href="/poll/" title="poll page for logo voting">
						<img src="images/spec-content-preview/Lakemary-wk2(voteing).jpg" alt="Voting options"/>
					</a>
				</li>
			
			<!--Second Spec slide-->
				<li>
					<a href="images/spec-content-full/Lakemary-spec-wk2(bcvswcbdfy).jpg" rel="lightbox[Game1]" title="Farrells effort helps pull the Bone Crushers to first place and beat the browns.">
					<img src="images/spec-content-preview/Lakemary-spec-wk2(bcvswcbdfy-prev).jpg" alt="Farrells effort helps pull the Bone Crushers to first place and beat the browns."/>
					</a>
				</li>			
			

				
			<!--Third Spec slide-->						
				<li>
					<a href="images/spec-content-full/lmhl-bcvschiefs-game1.jpg" rel="lightbox[Game1]" title="Bone Crushers crush Chiefs in a 8 to 7 OT victory">
						<img src="images/spec-content-preview/Lakemary-spec-wk1.jpg" alt="Game one bone crushers and Chiefs"/>
					</a>
				</li>
				
				
					
			</ul>
		</div>			
			

			</div>
			
			<div id="news-container"><!--start news-container-->
			<div id="news"><!--start news--->
			<h1><a href="login.php">News</a></h1>
			<!--
<ol>
				<li>Chiefs lose even after scoring first, 10 to 1</li>
				<li class="even">Bone Crushers beat WCBDFY 15 to 9</li>
				<li>
					<p>
						<a href="" class="cute-balloon gray"  
						tag="Message Boards are now up, and running, start talking smack - Kevin <br/><br/									><strong>click to close</strong>">
						Message Boards are now up, and running, start talking...
						</a>
					</p>
				</li>

				<li  class="even">
					<p>
						<a href="" class="cute-balloon gray"
						tag="Stats page team/player are now fully working, but colors are not 100%, if you find any 						problems please let me know via Facebook - Kevin <br/><br/><strong>click to close
						</strong>">
						Stats page team/player are now fully working, but colors...
						</a>
					</p>
				</li>
				
				<li>Bone Crushers beat Chiefs 8 to 7(OT)</li>
				<li  class="even">First Game 4/25/12 8pm</li>
				<li>
					<p>
						<a href="" class="cute-balloon gray" 
						tag="Website is currently under construction not all information is currently present it 							will be updated hopefully daily - Kevin <br/><br/><strong>click to close</strong>" >
						Website is currently under construction not all all informati...
						</a>
					</p>
				</li>
				


			</ol>
-->

				<div id="news-stories">
					<ol>			
							<?
							include("dbconnect.php");
							$getnews = mysql_query("select * from news ORDER BY id DESC");
							while($r=mysql_fetch_array($getnews)){
							extract($r);
							echo("<b>$title</b> on $date<BR>$news <Br/>");
							
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

	