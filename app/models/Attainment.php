<?php

class Attainment
extends Eloquent
{
    protected $table = "attainment";
    
    public function studentEntries()
    {
        return DB::table($this->table)
                    ->select('date')
                    ->groupBy('date')
                    ->orderBy('date', 'DESC')
                    ->get();
    }
}