<?php

class Attainment
extends Eloquent
{
    protected $table = "attainment";
    
    public function studentEntries($upn)
    {
        return DB::table($this->table)
                    ->select('date')
                    ->groupBy('date')
                    ->orderBy('date', 'DESC')
                    ->get();
    }
    public function startyearEntries($startyear)
    {
        return DB::table($this->table)
                    ->select('date')
                    ->where('student_start_year', '=', $startyear)
                    ->groupBy('date')
                    ->orderBy('date', 'DESC')
                    ->get();
    }
}