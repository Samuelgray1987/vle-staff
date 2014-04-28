<?php

class StudentClass extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'student_class_list';

	public function classes()
	{
	    return $this->hasMany("StudentUser");
	}
	

}