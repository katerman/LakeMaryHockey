<?php
session_start();


require_once '../includes/filter-wrapper.php';
require_once '../db.php';

$errors = array();

//sanitize all the fields
$teamName = filter_input(INPUT_POST, 'teamName',FILTER_SANITIZE_STRING);



if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//validate the form
	//if(empty($teamId))
	//	$errors['firstName']=true;

	if(empty($teamName))
		$errors['teamName']=true;

	//if there are no errors put data into database
	if(empty($errors))
	{
		$sqlTeam = $db->prepare('INSERT teams SET teamName = :teamName');
		//$sql->bindValue(':firstName', $teamId, PDO::PARAM_STR);
		$sqlTeam->bindValue(':teamName', $teamName, PDO::PARAM_STR);


		$sqlTeam->execute();
		header('location: ../index.php');
		exit;
	}

}

?>
<!DOCTYPE html>
<html>
<head>
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
}

div {
	margin-top: 10px;
}
</style>


<title>Add</title>
</head>
<body>

    <div id="content">
    <form action="addTeam.php" method="post">
	    <h1>Add a Team, by name, id is viewable in the tab view.</h1>

        <div>
        	<label for="teamname">Team Name</label><br/>
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