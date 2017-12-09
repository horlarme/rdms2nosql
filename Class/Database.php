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

	/**
	 * MySQL Connection
	 * @return PDOObject
	 */
	function mysql(){
		$arg = $this->args;

		/**
		 * Information
		 */
		define('Host', $arg['sqlHost']);
		define('User', $arg['sqlUsername']);
		define('Pass', $arg['sqlPassword']);
		define('Port', $arg['sqlPort']);
		define('DB', $arg['sqlDatabase']);

		try{
			return $m = new \mysqli(Host, User, Pass, DB, Port);
		}catch(\Exception $e){
			exit($e->getMessage());
		}
	}

	

	/**
	 * Mongo Connection
	 * @return PDOObject
	 */
	function mongo(){
		$arg = $this->args;

		/**
		 * Information
		 */
		define('MHost', $arg['nosqlHost']);
		define('MUser', $arg['nosqlUsername']);
		define('MPass', $arg['nosqlPassword']);
		define('MPort', $arg['nosqlPort']);
		define('MDB', $arg['nosqlDatabase']);

		try{

			if(MUser != "")
				$user = MUser . ':' . MPass . '@';
			else $user = "";

			$m = new \MongoDB\Client('mongodb://' . $user . MHost . ':' . MPort);
			return $m
				->{MDB}
				->{$arg['nosqlCollection']};
		}catch(\Exception $e){
			exit($e->getMessage());
		}
	}


}