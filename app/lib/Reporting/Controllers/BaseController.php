<?php

namespace Reporting\Controllers;

class BaseController extends \Controller {

	protected function setupView()
	{
		\View::addNamespace('Reporting', __DIR__.'/../Views/');
	}

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}