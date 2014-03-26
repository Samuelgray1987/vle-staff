<?php

namespace Services\Auth\Session;

class StaffClasses extends SessionLoader {

	public function requestDetails()
	{
		$temp = array();
		$this->params = $this->classes->where('upn', '=', $this->upn)->get();
		
		if (count($this->params) == 0) return $this->params = "'None'";

		foreach ($this->params as $param)
		{
			$temp[] = $param->class;
		}
		$this->params = implode("','", $temp);
		$this->params = "'" . $this->params . "'";

		return $this->params;
	}

}