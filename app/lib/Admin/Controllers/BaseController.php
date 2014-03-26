<?php

namespace Admin\Controllers;

class BaseController extends \Controller {

	protected function setupView()
	{
		\View::addNamespace('Admin', __DIR__.'/../Views/');
	}

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}