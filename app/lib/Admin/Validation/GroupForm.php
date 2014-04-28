<?php

namespace Admin\Validation;

class GroupForm extends BaseForm
{
    public function isValidForAdd()
    {
        return $this->isValid([
            "name" => "required|max:100|min:2"
        ]);
    }

    public function isValidForEdit()
    {
        return $this->isValid([
            "id"   => "exists:group,id",
            "name" => "required",
            "subject_id" => "min:1|max:20"
        ]);
    }

    public function isValidForDelete()
    {
        return $this->isValid([
            "id" => "exists:group,id"
        ]);
    }
}