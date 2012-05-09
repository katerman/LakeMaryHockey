<?php
    include_once ('db_connect.php');
	include_once ('functions.php');
    
    
    $id = (isset($_GET['id'])) ? intval($_GET['id']) : 1;

    if(!$row = get_poll($id)){
        exit('not found');
    }
    
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>LMHL Logo Poll</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script type="text/javascript" src="lib/awcore.polls.js"></script>
    <!-- delete this if you have the jquery ui -->
    <script type="text/javascript" src="lib/backgroundColor.js"></script>


    <link href="lib/polls.css" rel="stylesheet" type="text/css" />
    <link href="../css/global.css" rel="stylesheet" type="text/css" />

</head>

<body>
	<div id="container">
		<div id="header">
			<h1> Lake Mary Hockey</h1>
		</div>
	
		<div id="nav">
				<li><a href="../index.php">Home</a></li>
			 	<li><a href="../standings.html#stands">Teams</a></li>
			 	<li><a href="../playerstats.html#players">Players</a></li>
				<li><a href="http://www.facebook.com/groups/242140609216858/photos/">Pictures</a></li>
				<li><a href="../rules.html">Rules</a></li>
				<li><a href="../awards.html#awards">Awards</a></li>
				<li><a href="schedule.html">Schedule</a></li>
				<li><a href="#">Payment</a></li>
				<li class="nav-msgbrd-fix"><a href="../msgboard/">Message Boards</a></li>
		</div>
		
		<div id="content">

<div id="<?php echo $row['poll_id'];?>" class="polls">
    <h2><?php echo $row['title'];?></h2>
	<form <?php if(get_votes($row['poll_id'])){ echo 'class="closed"';}?> method="post">
    
        <?php
            foreach (poll_options($id) as $option) {
        ?>    
        	<p id="option_<?php echo $option['id'];?>" class="rounded dark_shadow">
        		<span class="option rounded dark_shadow" style="width:<?php echo $option['percent'];?>%;" title="<?php echo $option['percent'];?>"></span>
        		<input id="<?php echo $option['id'];?>" name="vote" value="<?php echo $option['id'];?>" type="radio" />
        		<label for="<?php echo $option['id'];?>"><?php echo $option['title'];?></label>
        		<em><?php echo $option['percent'];?>%</em>
        	</p>            
        <?php    	
            }	
        ?>    

	</form>
</div>

	<ol class="poll-lists">
		<li><img src="images/LMH-Logo1.png" alt="Logo One"/><h3>Logo One</h3></li>
		<li><img src="images/LMH-Logo2.png" alt="Logo Two"/><h3>Logo Two</h3></li>
		<li><img src="images/LMH-Logo3.png" alt="Logo Three"/><h3>Logo Three</h3></li>
		<li><img src="images/LMH-Logo4.png" alt="Logo Four"/><h3>Logo Four</h3></li>
	</ol>
	
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	
	<p class="text">
	All constructive criticism is welcome, if you have suggestions put them in the message boards. I can edit colors and what not, these are just examples.
	</p>
	
		</div>
	</div>
	
		<div id="footer"><!-- Start Footer -->

			<img class="footer" src="../images/badaslogo.png" alt="badas logo!"/>
			<a href="http://www.badasdesign.com">
				Badas Design 2012&copy;
			</a>

		</div><!-- End Footer -->	
	
	</body>
</html> 