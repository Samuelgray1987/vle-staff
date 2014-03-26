<?php

class Group
extends Eloquent
{
    protected $table = "group";
 
    protected $softDelete = true;

    protected $guarded = [
        "id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function resources()
	{
	    return $this->belongsToMany("Resource")->withTimestamps();
	}

	public function users()
	{
        //To use this function use the following syntax:
        //$this->group->find(2)->users;
        //the(2) refers to the group_id inside the group_user table.
        //In order to use this with both a users username and group:
        //$groups = $this->group->find(1)->users()->where('user_id', '=', '54899')->get();
	    return $this->belongsToMany("User");
	}

}