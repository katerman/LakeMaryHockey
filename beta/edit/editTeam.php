<?php
session_start();

require_once '../includes/filter-wrapper.php';
require_once '../db.php';

//errors
$errors = array();

$teamId = filter_input(INPUT_GET, 'id',FILTER_SANITIZE_NUMBER_INT);
	//if there's no id redriect to the homepage
	if(empty($teamId))
	{
		header('location: ../index.php?'. SID);
		exit;
	}

//sanitize all the fields
$teamName = filter_input(INPUT_POST, 'teamName',FILTER_SANITIZE_STRING);


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//validate the form
	if(empty($teamName))
		$errors['teamName']=true;


	//if there are no errors put data into database
	if(empty($errors))
	{
		$sql = $db->prepare('UPDATE teams SET teamName = :teamName WHERE teamId = :teamId');
		$sql->bindValue(':teamId', $teamId, PDO::PARAM_INT);
		$sql->bindValue(':teamName', $teamName, PDO::PARAM_STR);

		$sql->execute();
		header('location: ../index.php?' . SID);
		exit;

	}

}
else
{
	//display database information
	//shows the title in the value part
	$sql = $db->prepare('SELECT teamId, teamName FROM teams WHERE teamId = :teamId');
	$sql->bindValue(':teamId', $teamId, PDO::PARAM_INT);
	$sql->execute();
	$results = $sql->fetch(PDO::FETCH_OBJ);

	$teamName = $results->teamName;
	
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
    <form action="editTeam.php?id=<?php echo $teamId; ?>" method="post">
	    <h1>Edit this Team Name</h1>
	    
        <div>
        	<label for="teamName">Title - Brief</label><br/>
            <?php if(isset($errors['teamName'])): ?>
            <label for "teamName"><p class="error">Error! Enter Team name</p></label>
            <?php endif; ?>
            <input id="teamName" name="teamName" value="<?php echo $teamName; ?>">
        </div>

        <div>
            <a href="../index.php">&lt;&lt;Back</a>
            <button type="submit">Save</button>
        </div>

    </form>
  </div>
</body>
</html>