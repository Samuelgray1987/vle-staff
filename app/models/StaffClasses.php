<?php

class StaffClasses extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staff_classes';

	public static function findByClassOrFail($class, $columns = array('*')) {
        
        if ( ! is_null($class = static::whereClass($class)->first($columns))) {
        	$class->primaryKey = "class";
            return $class;
        }
   		$class = static::whereClass('')->first($columns);
       	$class->primaryKey = "class";
        return $class;
    }

	public function user() {

		return $this->belongsTo('User');
	
	}
	public function classdetails($class) {
		return DB::table($this->table)
							->leftJoin('student_class_list', 'student_class_list.class', '=', 'staff_classes.class')
							->leftJoin('student_users', 'student_class_list.upn', '=', 'student_users.upn')
							->leftJoin('staff_users', 'staff_classes.upn', '=', 'staff_users.upn')
							->select(DB::raw('staff_users.forename AS staff_forename, 
								staff_users.surname AS staff_surname,
								staff_users.upn AS staff_upn,
								student_users.upn AS student_upn, 
								student_class_list.class as class_id, 
								student_users.forename as student_forename, 
								student_users.surname as student_surname'
							  ))
							->where('student_class_list.class', '=', $class)
							->orderBy('student_users.surname');
	}
	
}