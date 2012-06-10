<html>
<head>
	<title> Simple todo list </title>
</head>
<body>

<?php

	include $_SERVER['DOCUMENT_ROOT'].'/todo/db_man.php';

	$login = $_POST['login'];
	$password = $_POST['password'];

	if(!$login or !$password)
	{
		echo 'Вы не ввели логин или пароль.';
	}
	else
	{
		if(check_login($login, $password))
		{
			// Отрисовка основной страницы

			echo '<p> <h2> Список заданий пользователя ' . $login . ': </h2> </p>';

			$tasks = get_tasks($login);

			foreach($tasks as $i => $value)
			{
				echo '<b>' . ($i + 1) . '. ' . $value->Name . '</b>';
				echo '<br>';
				echo 'Описание: ' . $value->Description;
				echo '<br>';
				echo 'Завершено: ' . ($value->IsDone ? 'Да' : 'Нет');
				echo '<br>';
			}
		}
		else
		{
			echo 'Неверный логин или пароль';
		}
	}

?>

</body>
</html>
