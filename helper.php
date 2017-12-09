<?php

/**
 * Flash Message into Session
 * @param $message string|array
 */
function flash($message){
	$s = new horlarme\rdms2nosql\ProcessForm;
	$s->flashMessage($message);
}

function session($get){
	$s = new horlarme\rdms2nosql\ProcessForm;
	return $s->getSession($get);
}