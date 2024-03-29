<?php

	if(isset($_POST['register']))
	{
		unset($reg_err);		
		unset($login_err);	
		
		$login = $_POST['login'];
		$password_1 = $_POST['password_1'];
		$password_2 = $_POST['password_2'];	

		if($login != '' and $password_1 != '' and $password_2 != '' and $password_1 == $password_2)
		{	
			include $_SERVER['DOCUMENT_ROOT'].'/todo/db_man.php';

			if(!check_login_exists($login))
			{
				add_user($login, $password_1);

				header('Location: index.php ');
			}
			else
				$login_err = true;
		}
		else
			$reg_err = true;
	}

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
	
	<div class="body">
	<h3> Регистрация нового пользователя </h3>
	<table>
	<form action = "register.php" method="post">
	<tr><td> Ваше имя: </td> <td> <input type = "text" name="login"/> </td></tr>
	<tr><td> Пароль: </td> <td> <input type = "password" name="password_1" /> </td></tr>
	<tr><td> Пароль еще раз: </td> <td> <input type = "password" name="password_2" /> </td></tr>
	<tr><td> <input type = "submit" name="register" value="Зарегистрироваться" /> </td></tr>
	</form>
	</table>

	<?php if(isset($reg_err)) echo '<font color=#ff0000> Все поля должны быть заполнены и пароли совпадать. </font>' ?>	
	<?php if(isset($login_err)) echo '<font color=#ff0000> Пользователь с таким именем уже существует. </font>' ?>
	
	<p><a href="index.php"> Возвратиться на главную страницу </a></p>
	</div>
	
</body>
</html>


