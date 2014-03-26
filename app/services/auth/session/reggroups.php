<?php

namespace Services\Auth\Session;

class Reggroups extends SessionLoader {

	public function requestDetails()
	{
		$temp = array();
		$this->params = $this->reggroups->where('upn', '=', $this->upn)->get();
		foreach ($this->params as $param)
		{
			$temp[] = $param->reggroup;
		}
		$this->params = implode("','", $temp);
		$this->params = "'" . $this->params . "'";
	}

}