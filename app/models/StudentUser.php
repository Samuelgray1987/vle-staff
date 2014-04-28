<?php

class StudentUser extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'student_users';

	protected $primaryKey = 'username';



	public function classes()
	{
	    return $this->belongsToMany("StudentClass");
	}

}