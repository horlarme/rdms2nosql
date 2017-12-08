<?php

namespace horlarme\rdms2nosql;

class Database
{

	/**
	 * Storing information from the user concerning the database
	 */
	protected $args;

	function __construct(array $arg)
	{
		$this->args = $arg;
	}
}