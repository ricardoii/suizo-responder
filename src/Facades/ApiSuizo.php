<?php

namespace Ricardo\ApiSuizoService\Facades;

use Illuminate\Support\Facades\Facade;

class ApiSuizo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'apisuizo';
    }
}
