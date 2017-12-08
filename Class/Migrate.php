<?php

namespace horlarme\rdms2nosql;

class Migrate extends ProcessForm
{

	use Database;

	/**
	 * The Input from the process age
	 * @var $form array
	 */
	protected $form;

	function __construct(){

		/**
		 * Getting the processed form from ProcessForm
		 */
		$this->form = $parent->form();
	}

	/**
	 * Calculating the total number of items to migrate
	 * @return int
	 */
	function itemsToMigrate(){
	}
}