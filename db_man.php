<?php

	include $_SERVER['DOCUMENT_ROOT'].'/todo/common.php';

	function check_login($login, $password)
	{
		$res = false;		

		$link = mysql_connect('localhost', 'root', '1234');
	
		if(!$link)
		{
			die('Ошибка соединения: ' . mysql_error());
		}
		else
		{
			$query = sprintf("select * from todo_db.users where login = '%s' and password = '%s'", 
						mysql_real_escape_string($login),
						mysql_real_escape_string($password));

			$result = mysql_query($query);

			if(!$result)
			{
				die('Query error: ' . mysql_error());
			}
			else if(mysql_num_rows($result))
			{
				$res = true;
			}

			mysql_free_result($result);
		}


		mysql_close($link);

		return $res;
	}

	function get_tasks($login)
	{	
		$link = mysql_connect('localhost', 'root', '1234');
	
		if(!$link)
		{
			die('Ошибка соединения: ' . mysql_error());
		}
		else
		{
			$query = sprintf("select * from todo_db.tasks where userLogin = '%s'", 
						mysql_real_escape_string($login));

			$result = mysql_query($query);

			if(!$result)
			{
				die('Query error: ' . mysql_error());
			}
			else 
			{
				while($row = mysql_fetch_assoc($result))
				{
					$t = new task($row['name'], $row['description'], $row['isDone']);

					$res[] = $t;
				}
			}

			mysql_free_result($result);
		}


		mysql_close($link);

		return $res;
	}

	function mark_task_as_done($task_name, $login)
	{	
		$res = false;
	
		$link = mysql_connect('localhost', 'root', '1234');
	
		if(!$link)
		{
			die('Ошибка соединения: ' . mysql_error());
		}
		else
		{
			$query = sprintf("update todo_db.tasks set isDone = true where name = '%s' and userLogin = '%s'", 
						mysql_real_escape_string($task_name),
						mysql_real_escape_string($login));

			$result = mysql_query($query);

			if(!$result)
			{
				die('Query error: ' . mysql_error());
			}
			else
				$res = true;

			mysql_free_result($result);
		}

		mysql_close($link);

		return $res;
	}

	function add_task($user_login, $name, $description)
	{	
		$res = false;
	
		$link = mysql_connect('localhost', 'root', '1234');
	
		if(!$link)
		{
			die('Ошибка соединения: ' . mysql_error());
		}
		else
		{
			$query = sprintf("insert into todo_db.tasks values('%s', '%s', '%s', false)", 
						mysql_real_escape_string($user_login),
						mysql_real_escape_string($name),
						mysql_real_escape_string($description));

			$result = mysql_query($query);

			if(!$result)
			{
				die('Query error: ' . mysql_error());
			}
			else
				$res = true;

			mysql_free_result($result);
		}

		mysql_close($link);

		return $res;
	}

	function delete_task($task_name, $login)
	{	
		$res = false;
	
		$link = mysql_connect('localhost', 'root', '1234');
	
		if(!$link)
		{
			die('Ошибка соединения: ' . mysql_error());
		}
		else
		{
			$query = sprintf("delete from todo_db.tasks where name = '%s' and userLogin = '%s'", 
						mysql_real_escape_string($task_name),
						mysql_real_escape_string($login));

			$result = mysql_query($query);

			if(!$result)
			{
				die('Query error: ' . mysql_error());
			}
			else
				$res = true;

			mysql_free_result($result);
		}

		mysql_close($link);

		return $res;
	}

	function add_user($login, $password)
	{	
		$res = false;
	
		$link = mysql_connect('localhost', 'root', '1234');
	
		if(!$link)
		{
			die('Ошибка соединения: ' . mysql_error());
		}
		else
		{
			$query = sprintf("insert into todo_db.users values('%s','%s')", 
						mysql_real_escape_string($login),
						mysql_real_escape_string($password));

			$result = mysql_query($query);

			if(!$result)
			{
				die('Query error: ' . mysql_error());
			}
			else 
				$res = true;

			mysql_free_result($result);
		}

		mysql_close($link);

		return $res;
	}		
	
	function check_login_exists($login)
	{			
		$res = false;
	
		$link = mysql_connect('localhost', 'root', '1234');
	
		if(!$link)
		{
			die('Ошибка соединения: ' . mysql_error());
		}
		else
		{
			$query = sprintf("select * from todo_db.users where login = '%s'", 
						mysql_real_escape_string($login));

			$result = mysql_query($query);

			if(!$result)
			{
				die('Query error: ' . mysql_error());
			}
			else if(mysql_num_rows($result))
			{
				$res = true;
			}

			mysql_free_result($result);
		}

		mysql_close($link);

		return $res;
	}
	
	function check_task_exists($name, $login)
	{	
		$res = false;
	
		$link = mysql_connect('localhost', 'root', '1234');
	
		if(!$link)
		{
			die('Ошибка соединения: ' . mysql_error());
		}
		else
		{
			$query = sprintf("select * from todo_db.tasks where userLogin = '%s' and name = '%s'", 
						mysql_real_escape_string($login),
						mysql_real_escape_string($name));

			$result = mysql_query($query);

			if(!$result)
			{
				die('Query error: ' . mysql_error());
			}
			else if(mysql_num_rows($result))
			{
				$res = true;
			}

			mysql_free_result($result);
		}

		mysql_close($link);

		return $res;
	}
?>
