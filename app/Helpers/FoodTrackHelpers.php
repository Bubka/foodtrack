<?php

use Illuminate\Support\Carbon;

if ( !function_exists('getPrevCurrentNextDays')) {
    /**
     * Get yesterday, now and tomorrow relative dates
     *
     * @param  String|null $day [optional: a date to use as referential]
     * @return array           an array of dates
     */
    function getPrevCurrentNextDays(String $day = null)
    {
        if($day)
        {
            $days['intakeDate']= Carbon::createFromFormat('Y-m-d', $day);
            $days['prevDay'] = Carbon::createFromFormat('Y-m-d', $day)->subDays(1);
            $days['nextDay'] = Carbon::createFromFormat('Y-m-d', $day)->addDays(1);
        }
        else {
            $days['intakeDate'] = Carbon::now();
            $days['prevDay'] = Carbon::yesterday();
            $days['nextDay'] = Carbon::tomorrow();
        }

        $days['today'] = Carbon::now();

        return $days;
    }
 }

