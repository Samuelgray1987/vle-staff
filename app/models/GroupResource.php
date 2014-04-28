<?php

class GroupResource extends Eloquent
{
    protected $table = "group_resource";

    protected $softDelete = true;

    protected $guarded = [
        "id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];
    
}