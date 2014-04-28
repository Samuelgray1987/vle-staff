<?php

namespace Reporting\Validation;

class ReportCardForm extends BaseForm
{
    public function isValidForAdd()
    {
        return $this->isValid([
            "report_comment" => "required|max:2000"
        ]);
    }
}