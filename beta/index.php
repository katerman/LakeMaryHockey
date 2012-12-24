<?php
session_start();

require_once "db.php";
require_once "AuthModel.php";
require_once "AuthView.php";


$model = new AuthModel($dsn, $db_user, $db_pass);
$view = new AuthView();

$username = empty($_POST['username']) ? '' : strtolower(trim($_POST['username']));
$password = empty($_POST['password']) ? '' : trim($_POST['password']);

$contentPage = 'form';
$user = $_SESSION['userInfo'];

if(!empty($_SESSION['userInfo'])){
	$contentPage = 'body';
	$_SESSION['userInfo'] = $user;
}

if (!empty($username) && !empty($password)){

	$user = $model->getUserByNamePass($username, $password);
	
	if(is_array($user)){
		$contentPage = 'body';
		session_start();
		$_SESSION['userInfo'] = $user;
	}
}


$view->show('header');
$view->show($contentPage, $user);
$view->show('footer');

?>
