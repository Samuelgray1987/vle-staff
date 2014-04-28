<?php

class GroupUser extends Eloquent
{
    protected $table = "group_user";

    protected $softDelete = true;

    protected $guarded = [
        "id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

}