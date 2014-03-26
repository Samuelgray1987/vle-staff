<?php

namespace Services\Auth\Session;

abstract class SessionLoader {

	public $params;

	public $upn;

	public $var;

	public $classes;

	public function __construct($params = null, $upn = null, \StaffClasses $classes)
	{	
		$this->upn = $upn;
		$this->params = $params;
		$this->classes = $classes;
	}

	public function addUpn($upn)
	{
		$this->upn = $upn;
		return true;
	}

	public function addToSession($key) 
	{
		\Session::put($key, $this->params);	
	}

}