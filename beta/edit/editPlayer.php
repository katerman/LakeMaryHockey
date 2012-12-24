<?php
session_start();

require_once '../includes/filter-wrapper.php';
require_once '../db.php';

//errors
$errors = array();

$playerId = filter_input(INPUT_GET, 'id',FILTER_SANITIZE_NUMBER_INT);
	//if there's no id redriect to the homepage
	if(empty($playerId))
	{
		header('location: ../index.php?'. SID);
		exit;
	}

//sanitize all the fields
$firstName = filter_input(INPUT_POST, 'firstName',FILTER_SANITIZE_STRING);

$lastName = filter_input(INPUT_POST, 'lastName',FILTER_SANITIZE_STRING);

$goals = filter_input(INPUT_POST, 'goals',FILTER_SANITIZE_STRING);

$assists = filter_input(INPUT_POST, 'assists',FILTER_SANITIZE_STRING);

$team = filter_input(INPUT_POST, 'teamId',FILTER_SANITIZE_NUMBER_INT);

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//validate the form
	if(empty($firstName))
		$errors['firstName']=true;

	if(empty($lastName))
		$errors['lastName']=true;

	if(empty($goals))
		//$errors['goals']=true;

	if(empty($assists))
		//$errors['assists']=true;

	if(empty($team))
		$errors['teamId']=true;	

	//if there are no errors put data into database
	if(empty($errors))
	{
		$sql = $db->prepare('UPDATE stats SET firstName = :firstName, lastName = :lastName, goals = :goals, assists = :assists,  teamId = :teamId WHERE playerId = :playerId');
		$sql->bindValue(':playerId', $playerId, PDO::PARAM_INT);
		$sql->bindValue(':firstName', $firstName, PDO::PARAM_STR);
		$sql->bindValue(':lastName', $lastName, PDO::PARAM_STR);
		$sql->bindValue(':goals', $goals, PDO::PARAM_STR);
		$sql->bindValue(':assists', $assists, PDO::PARAM_STR);
		$sql->bindValue(':teamId', $team, PDO::PARAM_INT);

		$sql->execute();
		header('location: ../index.php?' . SID);
		exit;
	}

}
else
{
	//display database information
	//shows the title in the value part
	$sql = $db->prepare('SELECT playerId, firstName, lastName, goals, assists, teamId FROM stats WHERE playerId = :playerId');
	$sql->bindValue(':playerId', $playerId, PDO::PARAM_INT);
	$sql->execute();
	$results = $sql->fetch(PDO::FETCH_OBJ);

	$firstName = $results->firstName;
	$lastName = $results->lastName;
	$goals = $results->goals;
	$assists = $results->assists;
	$team = $results->teamId;
	
}

?>
<html>
<head>
<title>Edit</title>
<style>
body {
	background-color: #CCCCFF;	
}

h1{
	margin:0;
	padding:2px;
}
#content {
	border-radius:10px;
	-moz-border-radius:10px; /* Old Firefox */
	
	background-color: rgba(0,0,0,0.3);
	width: 600px;
	margin: 0 auto;
	padding: 10px;
	border: 1px solid black;
	
div {
	margin-top: 10px;
}
</style>
</head>
<body>
	<div id="content">
    <form action="editPlayer.php?id=<?php echo $playerId; ?>" method="post">
	    <h1>Edit a player</h1>
	    <p> Team is number based</p>
	    
	    <?php
			//team restults
			$sqlTeam = $db->query('SELECT teamId,teamName FROM teams ORDER BY teamId ASC');
			
			$TeamResults = $sqlTeam->fetchAll(PDO::FETCH_OBJ);
			
			
	    ?>
	    
	    	<table style="table, th, td{border:1px solid #000;}">
		    	<thead>
		            <th>TeamID</th>
		            <th>Team Name</th>
		        </thead>
		        <tbody>
		        	<?php foreach($TeamResults as $entry): ?>
		            <tr>
		                <td><?php echo $entry->teamId; ?></td>
		                <td><?php echo $entry->teamName; ?></td>
		            </tr>
		            <?php endforeach; ?>
		        </tbody>
		    </table>
	    
        <div>
        	<label for="firstName">First Name</label><br/>
            <?php if(isset($errors['firstName'])): ?>
            <label for "firstName"><p class="error">Error! Enter first name</p></label>
            <?php endif; ?>
            <input id="firstName" name="firstName" value="<?php echo $firstName; ?>">
        </div>

        <div>
        	<label for="lastName">Last Name</label><br/>
            <?php if(isset($errors['lastName'])): ?>
            <label for "lastName"><p class="error">Error! Enter last name</p></label>
            <?php endif; ?>
            <input id="lastName" name="lastName" value="<?php echo $lastName; ?>">
        </div>
        
<!--
       <div>
        	<label for="gp">GP</label><br/>
            <?php if(isset($errors['gp'])): ?>
            <label for "gp"><p class="error">Error! Enter Games Played)</p></label>
            <?php endif; ?>
            <input id="gp" name="gp" value="<?php echo $gp; ?>">
        </div>
-->

        <div>
        	<label for="goals">Goals</label><br/>
            <?php if(isset($errors['goals'])): ?>
            <label for "goals"><p class="error">Error! Enter Goals</p></label>
            <?php endif; ?>
            <input id="goals" name="goals" value="<?php echo $goals; ?>">
        </div>

        <div>
        	<label for="assists">Assists</label><br/>
            <?php if(isset($errors['assists'])): ?>
            <label for "assists"><p class="error">Error! Enter assists</p></label>
            <?php endif; ?>
            <input id="assists" name="assists" value="<?php echo $assists; ?>">
        </div>

<!--
       <div>
        	<label for="pims">Pims</label><br/>
            <?php if(isset($errors['pims'])): ?>
            <label for "pims"><p class="error">Error! Enter Pims</p></label>
            <?php endif; ?>
            <input id="pims" name="pims" value="<?php echo $pims; ?>">
        </div>
-->

        <div>
        	<label for="teamId">Team</label><br/>
            <?php if(isset($errors['teamId'])): ?>
            <label for "teamId"><p class="error">Error! Enter team (Number based)</p></label>
            <?php endif; ?>
            <input id="teamId" name="teamId" value="<?php echo $team; ?>">
        </div>

        <div>
            <a href="../index.php">&lt;&lt;Back</a>
            <button type="submit">Save</button>
        </div>

    </form>
  </div>
</body>
</html>