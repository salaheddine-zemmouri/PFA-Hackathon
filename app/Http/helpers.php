<?php

use Illuminate\Support\Facades\Auth;

function get_guard(){
    if(Auth::guard('administrator')->check())
        {return "administrator";}
    elseif(Auth::guard('contestant')->check())
        {return "contestant";}
    elseif(Auth::guard('evaluator')->check())
        {return "evaluator";}
}
