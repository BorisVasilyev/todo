<?php
	if(isset($_POST['logout']))
	{
		setcookie("login", "", time() - 3600*24*30*12);
      	setcookie("password", "", time() - 3600*24*30*12);
		header("Location: index.php");
	}

	if (isset($_COOKIE['login']))
	{
		include $_SERVER['DOCUMENT_ROOT'].'/todo/db_man.php';

		$login = $_COOKIE['login'];
		$password = $_COOKIE['password'];

		if(check_login($login, $password))
		{
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

		<?php
		
			unset($add_task_err);
			unset($task_exists_err);

			if(isset($_POST['markAsDone']))
			{
				$j = 0;
				$task_count = $_POST['taskCount'];

				while($j < $task_count)
				{
					if (isset($_POST['checkTask' . $j ]))
					{
						$task_name = $_POST['checkTask' . $j ];
						
						mark_task_as_done($task_name, $login);
					}

					$j++;
				}
			}

			if(isset($_POST['delete']))
			{
				$j = 0;
				$task_count = $_POST['taskCount'];

				while($j < $task_count)
				{
					if (isset($_POST['checkTask' . $j ]))
					{
						$task_name = $_POST['checkTask' . $j ];
						
						delete_task($task_name, $login);
					}

					$j++;
				}
			}

			if(isset($_POST['addNewTask']))
			{
				$new_task_name = $_POST['newTaskName'];
				$new_task_description = $_POST['newTaskDescription'];

				if($new_task_name != '' and $new_task_description != '')
				{
					if(!check_task_exists($new_task_name, $login))
						add_task($login, $new_task_name, $new_task_description);
					else 
						$task_exists_err = true;
				}
				else
					$add_task_err = true;
			}
			
			echo '<div class="header"> <h2> Simple ToDo list </h2> </div>';
			echo '<div class="body"> <h3> Список задач пользователя ' . $login . '</h3>';

			$tasks = get_tasks($login);

			if(count($tasks) != 0)
			{
				echo '<table>
				<form action = "list.php" method="post">
				<tr><td><table border=1 cellpadding=3>
				<tr><td><b> Номер <b></td><td><b> Название задачи </b></td><td><b> Описание </b></td><td><b> Завершена </b></td><td></tr>';

				foreach($tasks as $i => $value)
				{
					echo '<tr><td>' . ($i + 1) . '</td>';
					echo '<td>' . $value->Name . '</td>';
					echo '<td>' . $value->Description . '</td>';
					echo '<td>' . ($value->IsDone ? 'Да' : 'Нет') . '</td>';
					echo '<td> <input type="checkbox" name="checkTask' . $i . '" value="' . $value->Name .'"/></tr>';
				}

				echo '</table></td></tr>
				<tr><td>
				<input type="submit" name="markAsDone" value="Отметить как завершенные"/>
				<input type="submit" name="delete" value="Удалить"/>
				<input type="hidden" name="taskCount" value="'. count($tasks) . '"/>
				</form>
				</td></tr>
				</table><br>';
			}
			else
			{
				echo '<b> Ваш список задач пуст! </b> <br><br>';
			}

			echo '<b> Добавить новую задачу: </b>
			<table>
			<form action = "list.php" method="post">
			<tr><td> Название: </td> <td> <input type="text" name="newTaskName" autocompete="off"> </td>
			<tr><td> Описание: </td> <td> <input type="text" name="newTaskDescription"> </td>
			<tr><td> <input type="submit" name="addNewTask" value="Добавить"/> </td>
			</form>
			</table>
			';
			
			if(isset($add_task_err)) 
				echo '<font color = #ff0000> Поля не должны быть пусты. </font>';
				
			if(isset($task_exists_err)) 
				echo '<font color = #ff0000> Задача с таким именем уже существует. </font>';

			echo '<br><form action = "list.php" method ="post"><input type="submit" name="logout" value="Выход"/></form>';
		}
		else
		{
			setcookie("login", "", time() - 3600*24*30*12);

        		setcookie("password", "", time() - 3600*24*30*12);

			echo 'Необходима авторизация!';
			?>

			</div>
			</body>
			</html>	

			<?php
		}
	}
	else
	{
		echo 'Необходима авторизация!';
	}

?>


