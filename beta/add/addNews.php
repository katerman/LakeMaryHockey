<?php
session_start();


require_once '../includes/filter-wrapper.php';
require_once '../db.php';

$errors = array();

//sanitize all the fields
$title = filter_input(INPUT_POST, 'title',FILTER_SANITIZE_STRING);

$news = filter_input(INPUT_POST, 'news',FILTER_SANITIZE_STRING);

$date = date("j F");


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//validate the form
	//if(empty($teamId))
	//	$errors['firstName']=true;

	if(empty($title))
		$errors['title']=true;

	//if there are no errors put data into database
	if(empty($errors))
	{
		$sqlTeam = $db->prepare('INSERT news SET title = :title,news = :news, date = :date');
		$sqlTeam->bindValue(':title', $title, PDO::PARAM_STR);
		$sqlTeam->bindValue(':news', $news, PDO::PARAM_STR);
		$sqlTeam->bindValue(':date', $date, PDO::PARAM_STR);
		


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


<title>Add News</title>
</head>
<body>

    <div id="content">
    <form action="addNews.php" method="post">
	    <h1>Add some News</h1>

        <div>
        	<label for="title">Title - Brief</label><br/>
            <?php if(isset($errors['title'])): ?>
            <label for "title"><p class="error">Error! Enter Team name</p></label>
            <?php endif; ?>
            <textarea  id="title" name="title"><?php echo $title; ?></textarea>
        </div>
        
        <div>
        	<label for="news">News - Long/Descriptive</label><br/>
            <?php if(isset($errors['news'])): ?>
            <label for "news"><p class="error">Error! Enter Team name</p></label>
            <?php endif; ?>
            <textarea rows="10" id="news" name="news"><?php echo $news; ?></textarea>
        </div>


        <div>
            <a href="../index.php">&lt;&lt;Back</a>
            <button type="submit">Save</button>
        </div>

    </form>
    </div>

</body>
</html>