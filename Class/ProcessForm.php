<?php

namespace horlarme\rdms2nosql;

/**
* Procees The Inputs from User
*/
class ProcessForm
{
	
	public function __construct()
	{
	}

	function cleanFlash(){
		session_start();
		$_SESSION['flash'] = [];
	}

	/**
	 * Add Flash Message to Session
	 * @param $message string|array
	 */
	function flashMessage($message, $value){
		session_start();
		return $_SESSION['flash'][$message] = $value;
	}

	/**
	 * Get value from a session
	 * @param $message string|array
	 */
	function get($get = null){
		session_start();
		if(null == $get){
			return $_SESSION['flash'];
		}
		return $_SESSION['flash'][$get] ? $_SESSION['flash'][$get] : false;
	}

	/**
	 * The Form
	 * @return $array
	 */
	function form(){
		$form = [];
		foreach ($_POST as $key => $value) {
			$form[$key] = addslashes($value);
		}
		return $form;
	}

	/**
	 * Validate what is validateable in the form
	 */
	function middleware(){
		$form = $this->form();

		if($form['sqlHost'] || $form['nosqlHost'] ||
			$form['sqlUsername'] || $form['nosqlUsername'] || 
			$form['sqlPost'] || $form['nosqlPort'] ||
			$form['sqlDatabase'] || $form['nosqlDatabase'] == ""){
			/**
			 * Sending Error Message
			 */
			$this->flashMessage('noSqlError', "Some of the fields are required");
			$this->flashMessage('sqlError', "Some of the fields are required");
			$this->flashMessage('form', $form);
			header('location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
}