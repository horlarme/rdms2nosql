<?php

namespace horlarme\rdms2nosql;

class Migrate extends ProcessForm
{

	/**
	 * The Input from the process age
	 * @var $form array
	 */
	protected $form;

	/**
	 * MySQL PDOObject
	 * @var $mysql PDOObject
	 */
	protected $mysql;

	/**
	 * Mongo Object
	 * @var $mongo Object
	 */
	protected $mongo;


	function __construct(){

		/**
		 * Getting the processed form from ProcessForm if available
		 * else from the session
		 */
		$this->form = parent::form() ? parent::form() : parent::get('form');

		/**
		 * Database
		 */
		$db = new Database($this->form);

		$this->mysql = $db->mysql();
		$this->mongo = $db->mongo();
	}

	/**
	 * Calculating the total number of items to migrate
	 * @return int
	 */
	function itemsToMigrate(){
		return ($this->mysql->query($this->form['dataCounter'])->num_rows);
	}

	/**
	 * Storing the infromtation frmm user to session
	 */
	function storeAsSession(){
		$form = $this->form;
		parent::flashMessage('form', $form);
	}

	function getRow($row){
		$query = str_replace("\\","", parent::get('form')['dataFetch']);

		//Removing ; if it is added to the query
		$query = str_replace(";", "", $query);
		//Limiting the query to only return one result
		$query .= " LIMIT 1";
		//Setting the offset for the query if it is not the first
		if($row != 1){
			$query .=  " OFFSET " . ($row - 1);
		}
		//Querying MYSQL
		$r = $this->mysql->query($query);
		//Return result as an array
		return $r->fetch_object();
	}

	function insertRow($row){

		$insertOneResult = $this->mongo->insertOne($row);

		return ($insertOneResult->getInsertedId());
	}

	function export($row){
		//Getting JSON format
		$json = $this->getRow($row);
		//Making Sure there's no error
		if($json){
			//Inserting into NoSQL
			$noSQL = $this->insertRow($json);
			if($noSQL){
				return [
					'success',
					'current' => $row
				];
			}else{
				return ['fail'];
			}
		}else{
			return $this->slightError();
		}
	}

	function slightError(){
		return ['fail'];
	}
}