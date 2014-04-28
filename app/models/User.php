<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staff_users';

	protected $primaryKey = 'username';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function groups()
	{
	    return $this->belongsToMany("Group")->withTimestamps();
	}

	public static function findByUpnOrFail($upn, $columns = array('*')) {
        
        if ( ! is_null($upn = static::whereUpn($upn)->first($columns))) {
        	$upn->primaryKey = "upn";
            return $upn;
        }
   		$upn = static::whereUpn('SGY')->first($columns);
       	$upn->primaryKey = "upn";
        return $upn;
    }

	public function classes()
	{
	    return $this->hasMany("StaffClasses", "upn");
	}
}