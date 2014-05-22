<?php

class AttainmentController extends BaseController {

	protected $user;

	protected $attainment;

	protected $attainmentLegend;

	protected $subjects;

	public function __construct(User $user, Attainment $attainment, AttainmentLegend $attainmentLegend, Subjects $subjects)
	{
		$this->user = $user;
		$this->attainment = $attainment; 
		$this->attainmentLegend = $attainmentLegend;
		$this->subjects = $subjects;
	}

	public function getEntries()
	{
		$upn = Input::get('upn');
		if (!$upn) $upn = "P391201205015";
		$entries = $this->attainment->studentEntries($upn);
		return Response::json($entries);
	}
	public function getEntriesstartyear()
	{
		$startyear = Input::get('startyear');
		if (!$startyear) $startyear = 2010;
		$entries = $this->attainment->startyearEntries($startyear);
		return Response::json($entries);
	}
	public function getResults()
	{
		//Retrieve data
		$limit = Input::get('limit');
		if (!$limit) $limit = 10000000;
		$upn = Input::get('upn');
		if (!$upn) $upn = "P391201205015";
		$entry = Input::get('entry');
		if (!$entry) $entry = "2013 December";

		//Process data for google charts.
		$myAttainment = $this->attainment->where('upn', '=', $upn)->where('date', $entry)->take($limit)->get();
		$attainmentLegend = $this->attainmentLegend->get();
		$subjects = $this->subjects->get();

		foreach ($myAttainment as &$myAttain) {
			foreach($attainmentLegend as $al)
			{
				if ( ($myAttain->target) == $al->id ) $myAttain->targetN = doubleval($al->points);
				if ( ($myAttain->current) == $al->id ) $myAttain->currentN = doubleval($al->points);
				if ( ($myAttain->predicted) == $al->id ) $myAttain->predictedN = doubleval($al->points);
			}
			foreach ($subjects as $s) {
				if ( (trim($myAttain->subject) == trim($s->code)) ) $myAttain->subject = $s->name;
			}
		}


		$column_options = array(
				array('id' => "", 'label' => 'Subject', 'pattern' => "", "type" =>'string'),
				array('id' => "", 'label' => 'Target', 'pattern' => "", "type" =>'number'),
				array('id' => "", 'label' => 'Current', 'pattern' => "", "type" =>'number'),
				array('id' => "", 'label' => 'Predicted', 'pattern' => "", "type" =>'number')
			);
		
		
		$rows = array();
		foreach ($myAttainment as $myAttain)
		{
			$temp = array();
			$temp[] = array('v' => $myAttain->subject, 'f' =>NULL);
			$temp[] = array('v' => $myAttain->targetN, 'f' => $myAttain->target);
			$temp[] = array('v' => $myAttain->currentN, 'f' => $myAttain->current);
			$temp[] = array('v' => $myAttain->predictedN, 'f' => $myAttain->predicted);
			$rows[] = array('c' => $temp);
		}

		$table = array();
		$table['data']['cols'] = $column_options;
		$table['data']['rows'] = $rows;

		return Response::json($table);
	}
	public function getResultstable()
	{	
		//Retrieve data
		$limit = Input::get('limit');
		if (!$limit) $limit = 10000000;
		$upn = Input::get('upn');
		if (!$upn) $upn = "P391201205015";
		$entry = Input::get('entry');
		if (!$entry) $entry = "2013 December";

		//Process data for google charts.
		$myAttainment = $this->attainment->where('upn', '=', $upn)->where('date', $entry)->take($limit)->get();
		$attainmentLegend = $this->attainmentLegend->get();
		$subjects = $this->subjects->get();

		foreach ($myAttainment as &$myAttain) {
			foreach($attainmentLegend as $al)
			{
				if ( ($myAttain->target) == $al->id ) $myAttain->targetN = doubleval($al->points);
				if ( ($myAttain->current) == $al->id ) $myAttain->currentN = doubleval($al->points);
				if ( ($myAttain->predicted) == $al->id ) $myAttain->predictedN = doubleval($al->points);
			}
			foreach ($subjects as $s) {
				if ( (trim($myAttain->subject) == trim($s->code)) ) $myAttain->subject = $s->name;
			}
		}


		$column_options = array(
				array('id' => "", 'label' => 'Subject', 'pattern' => "", "type" =>'string'),
				array('id' => "", 'label' => 'Target', 'pattern' => "", "type" =>'number'),
				array('id' => "", 'label' => 'Current', 'pattern' => "", "type" =>'number'),
				array('id' => "", 'label' => 'Predicted', 'pattern' => "", "type" =>'number'),
				array('id' => "", 'label' => 'Increased', 'pattern' => "", "type" =>'number'),
				array('id' => "", 'label' => 'On Track?', 'pattern' => "", "type" =>'string'),
			);
		
		
		$rows = array();
		foreach ($myAttainment as $myAttain)
		{
			$temp = array();
			$temp[] = array('v' => $myAttain->subject, 'f' =>NULL);
			$temp[] = array('v' => $myAttain->targetN, 'f' => $myAttain->target);
			$temp[] = array('v' => $myAttain->currentN, 'f' => $myAttain->current);
			$temp[] = array('v' => $myAttain->predictedN, 'f' => $myAttain->predicted);
			$temp[] = array('v' => $myAttain->increased, 'f' => $myAttain->increased);
			$temp[] = array('v' => $myAttain->track, 'f' => ucwords( strtolower($myAttain->track)));
			$rows[] = array('c' => $temp);
		}

		$table = array();
		$table['data']['cols'] = $column_options;
		$table['data']['rows'] = $rows;

		return Response::json($table);
	}
}