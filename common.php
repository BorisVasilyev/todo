<?php

class task
{
	public $Name;
	public $Description;
	public $IsDone;

	function __construct($name, $description, $isDone)
	{
		$this->Name = $name;
		$this->Description = $description;
		$this->IsDone = $isDone;
	}
}

?>
