<?php

	if(isset($_POST['submit']))
	{
		include $_SERVER['DOCUMENT_ROOT'].'/todo/db_man.php';

		$login = $_POST['login'];
		$password = $_POST['password'];		

		if(check_login($login, $password))
		{
			setcookie("login", $login, time()+60*60*24*30);
			setcookie("password", $password, time()+60*60*24*30);

			header('Location: list.php');
		}
		else
		{
			$auth_error = true;
		}
	}
	else
		unset($auth_error);

?>

<html>
<head>
	<title> Simple todo list </title>
	<style type="text/css">
	.header { 
	    width: 50%; 
	    background: #94C2E0;
	    padding-left : 20px; 
	    border: none; 
	    float: left;
	    margin: 0 25% 0 25%;
	   }
	   .body { 
	    width: 50%; 
	    background: #ffffff;
	    padding-left : 20px; 
	    border: none; 
	    float: left;
	    margin: 0 25% 0 25%;
	    height:100%;
	   }
	  </style> 
</head>
<body>
	<div class="header"> <h2> Simple ToDo list </h2> </div>

	<div class="body"> <h3> Вход </h3>
	<table>
	<form action = "index.php" method="post">
	<tr> <td> Ваш логин: </td> <td> <input type="text" name="login"/> </td> </tr>
	<tr> <td> Ваш пароль: </td> <td> <input type="password" name="password" /> </td> </tr>
	<tr> <td> <input name="submit" type="submit" value="Вход"/> </td> </tr>
	</form>
	</table>
	
	<?php if (isset($auth_error)) echo '<font color=#ff0000> Неправильный логин или пароль </font>'; ?>

	<br/><a href="register.php"> Регистрация нового пользователя </a>
	</div>

</body>
</html>


