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

		$hasError = false;

		/**
		 * Sending Error Message
		 */
		if("" == $form['sqlHost'] && "" == $form['sqlDatabase'] && "" == $form['sqlUsername'] && "" == $form['sqlPost'])
		{
			$hasError = true;
			$this->flashMessage('sqlError', "Some of the fields are required");
		}
		if($form['nosqlUsername'] && $form['nosqlPort'] && $form['nosqlHost'] && $form['nosqlDatabase'] == ""){
			$hasError = true;
			$this->flashMessage('noSqlError', "Some of the fields are required");
		}
		if($form['dataCounter'] ==""){
			$hasError = true;
			$this->flashMessage('dataCounter', "This field is required");
		}
		if($form['dataFetch'] == ""){
			$hasError = true;
			$this->flashMessage('dataFetch', "This field is required");
		}


		/**
		 * If there is an error
		 */
		if($hasError){
			$this->flashMessage('form', $form);
			header('location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
}