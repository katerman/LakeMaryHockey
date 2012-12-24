<?php
session_start();

require_once '../includes/filter-wrapper.php';
require_once '../db.php';

//errors
$errors = array();

$newsId = filter_input(INPUT_GET, 'id',FILTER_SANITIZE_NUMBER_INT);
	//if there's no id redriect to the homepage
	if(empty($newsId))
	{
		header('location: ../index.php?'. SID);
		exit;
	}

//sanitize all the fields
$title = filter_input(INPUT_POST, 'title',FILTER_SANITIZE_STRING);

$news = filter_input(INPUT_POST, 'news',FILTER_SANITIZE_STRING);


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//validate the form
	if(empty($title))
		$errors['title']=true;
		
	if(empty($news))
		$errors['news']=true;

	//if there are no errors put data into database
	if(empty($errors))
	{
		$sql = $db->prepare('UPDATE news SET title = :title, news = :news WHERE id = :id');
		$sql->bindValue(':id', $newsId, PDO::PARAM_INT);
		$sql->bindValue(':title', $title, PDO::PARAM_STR);
		$sql->bindValue(':news', $news, PDO::PARAM_STR);

		$sql->execute();
		header('location: ../index.php?' . SID);
		exit;

	}

}
else
{
	//display database information
	//shows the title in the value part
	$sql = $db->prepare('SELECT id, news, title FROM news WHERE id = :id');
	$sql->bindValue(':id', $newsId, PDO::PARAM_INT);
	$sql->execute();
	$results = $sql->fetch(PDO::FETCH_OBJ);

	$title = $results->title;
	$news = $results->news;	
	
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
    <form action="editNews.php?id=<?php echo $newsId; ?>" method="post">
	<h1>Edit a player</h1>
	<h2> News Features </h2>
	<p>surround any word(s) with &lt;br&gt;words&lt;/br&gt; for <strong>bold</strong> text, and use &lt;em&gt;words&lt;/em&gt; for <em>italic</em>.</p>
	    
        <div>
        	<label for="title">Title - Brief</label><br/>
            <?php if(isset($errors['title'])): ?>
            <label for "title"><p class="error">Error! Enter Team name</p></label>
            <?php endif; ?>
            <input id="title" name="title" value="<?php echo $title; ?>">
        </div>
        
        <div>
        	<label for="news">News - Long/Descriptive</label><br/>
            <?php if(isset($errors['news'])): ?>
            <label for "news"><p class="error">Error! Enter Team name</p></label>
            <?php endif; ?>
            <input id="news" name="news" value="<?php echo $news; ?>">
        </div>
        

        <div>
            <a href="../index.php">&lt;&lt;Back</a>
            <button type="submit">Save</button>
        </div>

    </form>
  </div>
</body>
</html>